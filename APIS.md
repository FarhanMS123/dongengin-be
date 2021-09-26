# Restfull Application Programming Interface (Rest-API)

This documentation would explain how to interact with backend, including the routes, sign (headers), parameters, 
and response. You could see all interaction in the list below.

Previous API could be look from [here](APIS_old.md).

- `GET  /api/stories`
- `GET  /api/stories/recomendation`
- `GET  /api/story/{story_id}`

## Table of contents
- [Restfull Application Programming Interface (Rest-API)](#restfull-application-programming-interface-rest-api)
  - [Table of contents](#table-of-contents)
  - [`POST /api/auth/register`](#post-apiauthregister)
  - [`POST /api/auth/login`](#post-apiauthlogin)
  - [`POST /api/auth/logout`](#post-apiauthlogout)
  - [`GET  /api/user`](#get--apiuser)
  - [`POST /api/user`](#post-apiuser)
  - [GET /api/users](#get-apiusers)

## `POST /api/auth/register`

Request: `POST /api/auth/register`

Headers:

*All headers has been configured automatically*

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
    "saved_story":[
        {
            "id":12,
            "title":"Malin Kundang",
            "thumbnail":"/assets/story/malin_kundang.png",
            "routes":"/story/malin_kundang",
            "description":"Lorem ipsum dolor sit amet",
            "categories":["Miangkabau", "dongeng"],
            "rate":2.5,
            "rated":4,
            "total_views":"",
            "total_favorites":"",
            "total_pages":""
        },
        ...
    ],
    "poins": 200,
    "coins": 100
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

Query    :

| Key     | Value       | Description             |
| ------- | ----------- | ----------------------- |
| `type`  | `add_point` | No description provided |
| `value` | (string     | integer)                | No description provided |

Response :
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

## GET /api/users

Request  : `GET /api/users`

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
        "poins": 200
    }
]
```
