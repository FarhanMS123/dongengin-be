# Restfull Application Programming Interface (Rest-API)

This documentation would explain how to interact with backend, including the routes, sign (headers), parameters, 
and response. You could see all interaction in the list below.

Previous API could be look from [here](APIS_old.md).

## Table of contents
- [Restfull Application Programming Interface (Rest-API)](#restfull-application-programming-interface-rest-api)
  - [Table of contents](#table-of-contents)
  - [`POST /api/auth/register`](#post-apiauthregister)
  - [`POST /api/auth/login`](#post-apiauthlogin)
  - [`POST /api/auth/logout`](#post-apiauthlogout)
  - [`GET  /api/user`](#get--apiuser)
  - [`POST /api/user`](#post-apiuser)
  - [`GET  /api/users`](#get--apiusers)
  - [`GET  /api/stories`](#get--apistories)
  - [`GET  /api/stories/recomendation`](#get--apistoriesrecomendation)
  - [`GET  /api/story/{story_id}`](#get--apistorystory_id)
  - [`POST /api/story/{story_id}`](#post-apistorystory_id)

## `POST /api/auth/register`

Request: `POST /api/auth/register`

Headers:

*All headers has been configured automatically*

*Need not authenticated user to use this feature*

Query:

| Key         | Value    | Description                                            |
| ----------- | -------- | ------------------------------------------------------ |
| `fullname`  | (string) | This field only provided to authenticate child account |
| `username`  | (string) | No description provided                                |
| `birthdate` | (date)   | Format: `DD/MM/YYYY`. For examples: `31/10/2020`       |
| `password`  | (string) | No description provided                                |

Response:

**User registered**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"auth/registered"
}
```

**Missing required data**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message":"auth/data-invalid",
    "errors":{ ... errors descripted by Laravel Validator and Messagebag ... }
}
```

## `POST /api/auth/login`

Request  : `POST /api/auth/login`

Headers  :

*All headers has been configured automatically*

*Need not authenticated user to use this feature*

Query    :

| Key        | Value    | Description             |
| ---------- | -------- | ----------------------- |
| `username` | (string) | No description provided |
| `password` | (string) | No description provided |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"auth/credential-accepted"
}
```

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "error":"auth/credential-rejected"
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message":"auth/data-invalid",
    "errors":{ ... errors descripted by Laravel Validator and Messagebag ... }
}
```

## `POST /api/auth/logout`

Request  : `POST /api/auth/logout`

Headers  :

*All headers has been configured automatically*

*Need authenticated user to use this feature*

Query    :

*Free of query*

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"auth/loged-out"
}
```

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "error":"auth/no-credential"
}
```

## `GET  /api/user`

Request  : `GET  /api/user`

Headers  :

*All headers has been configured automatically*

*Need authenticated user to use this feature*

Query    :

*Free of query*

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "fullname":"User Name",
    "username":"username123",
    "birthdate":"31/10/2020",
    "favorites":[
        {
            "id":12,
            "title":"Malin Kundang",
            "thumbnail":"/assets/story/malin_kundang.png",
            "routes":"/story/malin_kundang",
            "description":"Lorem ipsum dolor sit amet",
            "categories":["Miangkabau", "dongeng"],
            "rate":2.5,
            "rated":4,
            "total_views":120,
            "total_favorites":23,
            "total_pages":8,
            "total":151
        },
        ...
    ],
    "cards":[1,3,6,7],
    "poins": 200,
    "coins": 100,
    "rank": 4
}
```
Data `saved_story.rated` is user's giving rating to the story.

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "error":"auth/no-credential"
}
```

## `POST /api/user`

Request  : `POST /api/user`

Headers  :

*All headers has been configured automatically*

*Need authenticated user to use this feature*

Query    :

| Key     | Value                  | Description             |
| ------- | ---------------------- | ----------------------- |
| `type`  | `add_poin`, `use_coin` | No description provided |
| `value` | (integer)              | No description provided |

Response :

**`type` = `add_poin`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"user/poin-gained",
    "data":{
        "before": [...poins..., ...coins...],
        "current": [...gained poins..., ...gained coins...],
        "poin_gained: ... `value` from query ...
    }
}
```

**`type` = `use_coin`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"user/coins-spent",
    "data":{
        "before": ...coins...,
        "current": ...spent coins...,
        "coin_spent": ... `value` from query ...
    }
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":"user/coins-insufficient",
    "data":{
        "current": ...coins...,
        "after_spent": ...spent coins...,
        "coin_would_spent": ... `value` from query ...
    }
}
```

**Default Errors**
```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message":"user/type-invalid"
}
```

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "error":"auth/no-credential"
}
```

## `GET  /api/users`

Request  : 
`GET  /api/users`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                        | Value                         | Description             |
| -------------------------- | ----------------------------- | ----------------------- |
| `search` (optional)        | (string)                      | No description provided |
| `sort_by` (optional)       | `poins` default: `poins`      | No description provided |
| `sort_type` (optional)     | `asc`, `desc` default: `desc` | No description provided |
| `items_perpage` (optional) | (integer) default: `10`       | No description provided |
| `page` (optional)          | (integer) default: `1`        | No description provided |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json
[
    {
        "fullname":"Full Name",
        "username":"username123",
        "poins": 200,
        "rank": 4
    },
    ...
]
```

## `GET  /api/stories`

Request  : `GET /api/stories`

Headers  :

*All headers has been configured automatically*

*Authenticated user is optional to use this feature*

Query    :

| Key                        | Value                                                                                                            | Description             |
| -------------------------- | ---------------------------------------------------------------------------------------------------------------- | ----------------------- |
| `search` (optional)        | (string)                                                                                                         | No description provided |
| `sort_by` (optional)       | `rating`, `total_views`, `total_favorites`, `total_pages`, `created_at`, `updated_at`, `total` default: `rating` | No description provided |
| `sort_type` (optional)     | `asc`, `desc` default: `desc`                                                                                    | No description provided |
| `items_perpage` (optional) | (integer) default: `9`                                                                                           | No description provided |
| `page` (optional)          | (integer) default: `1`                                                                                           | No description provided |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

[
    {
        "id":12,
        "title":"Malin Kundang",
        "thumbnail":"/assets/story/malin_kundang.png",
        "routes":"/story/malin_kundang",
        "description":"Lorem ipsum dolor sit amet",
        "categories":["Miangkabau", "dongeng"],
        "rating":2.5,
        "rated":4,
        "is_favorite":true
        "total_views":120,
        "total_favorites":23,
        "total_pages":8,
        "total":151
    },
    ...
]
```

## `GET  /api/stories/recomendation`

Request  : `GET /api/stories`

Headers  :

*All headers has been configured automatically*

*Authenticated user is optional to use this feature*

Query    :

| Key                        | Value                                                                                                           | Description             |
| -------------------------- | --------------------------------------------------------------------------------------------------------------- | ----------------------- |
| `sort_by` (optional)       | `rating`, `total_views`, `total_favorites`, `total_pages`, `created_at`, `updated_at`, `total` default: `total` | No description provided |
| `sort_type` (optional)     | `asc`, `desc` default: `desc`                                                                                   | No description provided |
| `items_perpage` (optional) | (integer) default: `5`                                                                                          | No description provided |
| `page` (optional)          | (integer) default: `1`                                                                                          | No description provided |

Response :

```
HTTP/1.1 200 OK
Content-Type: text/json

[
    {
        "id":12,
        "title":"Malin Kundang",
        "thumbnail":"/assets/story/malin_kundang.png",
        "routes":"/story/malin_kundang",
        "description":"Lorem ipsum dolor sit amet",
        "categories":["Minagkabau", "dongeng"],
        "rating":2.5,
        "rated":4,
        "is_favorite":true
        "total_views":120,
        "total_favorites":23,
        "total_pages":8,
        "total":151
    },
    ...
]
```

The `total` field is a sum of `total_views`, `total_favorites`, `total_pages`. This is a tricky algorithm for recommendation. Actually this can't be this.

## `GET  /api/story/{story_id}`

Request  : `GET /api/story/{story_id}`

Headers  :

*All headers has been configured automatically*

*Authenticated user is optional to use this feature*

Query    :

| Key        | Value     | Description             |
| ---------- | --------- | ----------------------- |
| `story_id` | (integer) | No description provided |

Response:
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "id":12,
    "title":"Malin Kundang",
    "thumbnail":"/assets/story/malin_kundang.png",
    "routes":"/story/malin_kundang",
    "description":"Lorem ipsum dolor sit amet",
    "categories":["Miangkabau", "dongeng"],
    "rating":2.5,
    "rated":4,
    "is_favorite":false
    "total_views":120,
    "total_favorites":23,
    "total_pages":8,
    "total":151
}
```

```
HTTP/1.1 404 Not Found
Content-Type: text/json

{
    "code":400,
    "status":"not found",
    "message":"story/not-found"
}
```

## `POST /api/story/{story_id}`

Request  : `POST /api/story/{story_id}`

Headers  :

*All headers has been configured automatically*

*Need authenticated user to use this feature*

Query    :

| Key                                 | Value                                                      | Description                                                                                                           |
| ----------------------------------- | ---------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `type`                              | `increase_views`, `set_favorite`, `set_rating`, `set_page` | No description provided                                                                                               |
| `value` (`type` = `increase_views`) | *NULL*                                                     | No description provided                                                                                               |
| `value` (`type` = `set_favorite`)   | (boolean)                                                  | No description provided                                                                                               |
| `value` (`type` = `set_rating`)     | (integer) between `1` and `5`                              | No description provided                                                                                               |
| `value` (`type` = `set_page`)       | (string) `finish` or `page_{index}`                        | For unfinished reading, value could be `page_` followed by current page number counted from 1. For examples: `page_6` |

Response :

**`type` = `increase_views`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "story" => "story/views-increased"
}
```

**`type` = `set_favorite`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message" => "story/favorite-updated",
    "data" => ... story ...
}
```

**`type` = `set_rating`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message" => "story/favorite-updated",
    "data" => ... story ...
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message" => "story/value-invalid",
    "description" => "value must between 1 and 5"
}
```

**`type` = `set_page`**

```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message" => "story/status-updated",
    "data" => ... story ...
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message" => "story/value-invalid",
    "description" => "value must be 'finish' or 'page_' followed by page number counted from 1"
}
```

**Default Errors**

```
HTTP/1.1 404 Not Found
Content-Type: text/json

{
    "code":400,
    "status":"not found",
    "message":"story/not-found"
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message":"story/type-invalid"
}
```

```
HTTP/1.1 400 Bad Request
Content-Type: text/json

{
    "code":400,
    "status":"bad request",
    "message":"story/data-invalid",
    "errors":{ ... errors descripted by Laravel Validator and Messagebag ... }
}
```

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "message":"story/need-aunthenticated-user"
}
```
