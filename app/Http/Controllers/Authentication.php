<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPublic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authentication extends Controller
{
    public function register(Request $request){
        $val = Validator::make($request->all(), [
            'fullname' => ['required'],
            'username' => ['required'],
            'birthdate' => ['required'],
            'password' => ['required']
        ]);

        if ($val->fails()) {
            return response()->json([
                "code" => 400,
                "status" => "bad request",
                "message" => "auth/data-invalidat",
                "errors" => $val->errors()->toArray()
            ], 400);
        }

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "message" => "auth/registered"
        ], 200);
    }

    public function login(Request $request){
        $val = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($val->fails()) {
            return response()->json([
                "code" => 400,
                "status" => "bad request",
                "message" => "auth/data-invalid",
                "errors" => $val->errors()->toArray()
            ], 400);
        }

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return response()->json([
                "code" => 200,
                "status" => "ok",
                "message" => "auth/credential-accepted"
            ], 200);
        }

        return response()->json([
            "code" => 401,
            "status" => "unauthorized",
            "message" => "auth/credential-rejected"
        ], 401);
    }

    public function logout(Request $request){
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                "code" => 200,
                "status" => "ok",
                "message" => "auth/loged-out"
            ], 200);
        }

        return response()->json([
            "code" => 401,
            "status" => "unauthorized",
            "message" => "auth/no-credential"
        ], 401);
    }

    public function user(Request $request){
        if(Auth::check()){
            $user = $request->user()->toArray();

            // add favorites

            return response()->toJson($user);
        }

        return response()->json([
            "code" => 401,
            "status" => "unauthorized",
            "message" => "auth/no-credential"
        ], 401);
    }

    public function userAction(Request $request){
        if(Auth::check()){
            $user = $request->user();

            $val = Validator::make($request->all(), [
                'type' => ['required'],
                'value' => ['required']
            ]);

            if ($val->fails()) {
                return response()->json([
                    "code" => 400,
                    "status" => "bad request",
                    "message" => "user/data-invalid",
                    "errors" => $val->errors()->toArray()
                ], 400);
            }

            switch($request->type){
                case "add_poin":
                    return $this->userAction_addPoin($request, $user);
                    break;

                default:
                    return response()->json([
                        "code" => 400,
                        "status" => "bad request",
                        "message" => "user/type-invalid"
                    ], 400);
            }
        }

        return response()->json([
            "code" => 401,
            "status" => "unauthorized",
            "message" => "auth/no-credential"
        ], 401);
    }

    public function userAction_addPoin(Request $request, $user){
        $bef = [$user->poins, $user->coins];
        $user->poins = $bef[0] + $request->value;
        $user->coins = $bef[1] + $request->value;
        $user->save();

        return response()->json([
            "code" => 200,
            "status" => "ok",
            "message" => "user/poins-gained",
            "data" => [
                "before" => $bef,
                "current" => [$user->poins, $user->coins],
                "poin_gained" => $request->value
            ]
        ], 200);
    }

    public function users(Request $request){
        $search = $request->search ?? "";
        $sort_by = $request->sort_by ?? "poins";
        $sort_type = $request->sort_type ?? "desc";
        $items_perpage = $request->items_perpage ?? 10;
        $page = $request->page ?? 1;

        $skip = ($page - 1) * $items_perpage;

        return response()
            ->toJson(
                UserPublic::where("fullname", "like", "%$search%")
                    ->orWhere("username", "like", "%$search%")
                    ->orWhere("poins", "like", "%$search%")
                    ->orderBy($sort_by, $sort_type)
                    ->limit($items_perpage)->skip($skip)->get()
            );
    }
}
