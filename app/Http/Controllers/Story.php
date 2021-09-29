<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Story as StoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Story extends Controller
{
    public function story($id, Request $request){
        $s = StoryModel::find($id);

        if($s == null){
            return response()->json([
                "code" => 404,
                "status" => "not found",
                "message" => "story/not-found"
            ], 401);
        }

        return response()->json($s, 200);
    }

    public function storyAction($id, Request $request){
        $u = Auth::check() ? $request->user() : false;
        $s = StoryModel::find($id);

        if($s == null){
            return response()->json([
                "code" => 404,
                "status" => "not found",
                "message" => "story/not-found"
            ], 401);
        }

        $val = Validator::make($request->all(), [
            'type' => ['required'],
            'value' => ['required_unless:type,increase_views']
        ]);

        if ($val->fails()) {
            return response()->json([
                "code" => 400,
                "status" => "bad request",
                "message" => "story/data-invalid",
                "errors" => $val->errors()->toArray()
            ], 400);
        }

        $p = null;

        if($u){
            $p = Preference::where("user_id", '=', $u->id)
                            ->where("story_id", '=', $s->id);

            if($p == null)
                $p = Preference::create([
                    "user_id" => $u->id,
                    "story_id" => $s->id
                ]);
        }

        switch($request->type){
            case "increase_views":
                return $this->storyAction_increaseViews($request, $u, $s, $p);
                break;

            case "set_favorite":
                if($p == null) return $this->storyNeedAuth();
                return $this->storyAction_setFavorite($request, $u, $s, $p);
                break;

            case "set_rating":
                if($p == null) return $this->storyNeedAuth();
                return $this->storyAction_setRating($request, $u, $s, $p);
                break;

            case "set_page":
                if($p == null) return $this->storyNeedAuth();
                return $this->storyAction_setPage($request, $u, $s, $p);
                break;
        }

        return response()->json([
            "code" => 400,
            "status" => "bad request",
            "message" => "story/type-invalid"
        ], 400);
    }

    public function storyNeedAuth(){
        return response()->json([
            "code" => 401,
            "status" => "unauthorized",
            "message" => "story/need-aunthenticated-user"
        ], 401);
    }

    public function storyAction_increaseViews(Request $request, $user, $story, $preference){
        if($user != null){
            $preference->accessed_at = now();
            $preference->save();
        }

        $story->total_views += 1;
        $story->save();

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "story" => "story/views-increased"
        ], 200);
    }

    public function storyAction_setFavorite(Request $request, $user, $story, $preference){
        $val = $request->value == "true" ? true : false;

        $curr = $preference->is_favorite;

        $preference->is_favorite = $val;
        $preference->save();

        // $story->total_favorites = Preference::where('story_id', '=', $story->id)->where('is_favorite', '=', true)->count();
        $story->total_favorites += (($curr == false && $val == true) ? 1 : (($curr == true && $val == false) ? -1 : 0));
        $story->save();

        $story->refresh();

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "story" => "story/favorite-updated",
            "data" => $story
        ], 200);
    }

    public function storyAction_setRating(Request $request, $user, $story, $preference){
        $val = ($request->value >= 1 || $request->value <= 5) ? $request->value : null;

        if($val == null){
            return response()->json([
                "code" => 400,
                "status" => "bad request",
                "message" => "story/value-invalid",
                "description" => "value must between 1 and 5"
            ], 400);
        }

        $preference->rate = $request->value;
        $preference->save();

        $story->rating = Preference::where('story_id', '=', $story->id)->avg('rate');
        $story->save();

        $story->refresh();

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "story" => "story/rating-updated",
            "data" => $story
        ], 200);
    }

    public function storyAction_setPage(Request $request, $user, $story, $preference){
        $val = Validator::make($request->all(), [
            "value" => ["regex:/^(finish|page_\d+)$/"]
        ]);

        if($val->fails()){
            return response()->json([
                "code" => 400,
                "status" => "bad request",
                "message" => "story/value-invalid",
                "description" => "value must be 'finish' or 'page_' followed by page number counted from 1"
            ], 400);
        }

        $preference->status = $request->value;
        $preference->save();

        $story->refresh();

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "story" => "story/status-updated",
            "data" => $story
        ], 200);
    }

    public function stories(Request $request){
        $search = $request->search ?? "";
        $sort_by = $request->sort_by ?? "rating";
        $sort_type = $request->sort_type ?? "asc";
        $items_perpage = $request->items_perpage ?? 10;
        $page = $request->page ?? 1;

        $skip = ($page - 1) * $items_perpage;

        // rating, total_views, total_favorites, total_pages
        // field above should be put in the search query,
        // but i can't.

        return response()
            ->toJson(
                StoryModel::where("title", "like", "%$search%")
                    ->orWhere("description", "like", "%$search%")
                    ->orWhere("categories", "like", "%$search%")
                    ->orderBy($sort_by, $sort_type)
                    ->limit($items_perpage)->skip($skip)->get()
            );
    }

    public function recomended_story(Request $request){
        $sort_by = $request->sort_by ?? "total";
        $sort_type = $request->sort_type ?? "desc";
        $items_perpage = $request->items_perpage ?? 5;
        $page = $request->page ?? 1;

        $skip = ($page - 1) * $items_perpage;

        return response()
            ->toJson(
                StoryModel::orderBy($sort_by, $sort_type)
                    ->limit($items_perpage)->skip($skip)->get()
            );
    }
}
