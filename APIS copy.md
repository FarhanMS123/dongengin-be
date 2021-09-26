# Restfull Application Programming Interface (Rest-API)

This documentation would explain how to interact with backend, including the routes, sign (headers), parameters, 
and response. You could see all interaction in the list below.

- `POST /api/auth/register`
- `POST /api/auth/login`
- `POST /api/auth/logout`
- `GET  /api/user`
- `POST /api/user`
- `GET  /api/users`
- `GET  /api/stories`
- `GET  /api/stories/recomendation`
- `GET  /api/story/{story_id}`

## Table of contents
- [Restfull Application Programming Interface (Rest-API)](#restfull-application-programming-interface-rest-api)
  - [Table of contents](#table-of-contents)
  - [`POST /api/auth/login`](#post-apiauthlogin)
  - [POST /api/auth/logout](#post-apiauthlogout)
  - [GET /api/user](#get-apiuser)
  - [POST /api/user](#post-apiuser)
  - [GET /api/users](#get-apiusers)
  - [GET /api/stories](#get-apistories)
  - [GET /api/stories/recomendation](#get-apistoriesrecomendation)
  - [GET /api/story/{story_id}](#get-apistorystory_id)

## `POST /api/auth/login`

Request  : `POST /api/auth/login`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                   | Value    | Description                                                                                     |
|-----------------------|----------|-------------------------------------------------------------------------------------------------|
| `username`            | (string) | This field only provided to authenticate child account                                          |
| `password`            | (string) | No description provided                                                                         |
| `as_child` (optional) | (string) | This field only provided to login as child for verified parent. Any field would not be required |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok"
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

## POST /api/auth/logout

Request  : `POST /api/auth/login`

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
    "message":"auth/logout"
}
```

## GET /api/user

Request  : `POST /api/user`

Headers  :

*All headers has been configured automatically*

Query    :

*Free of query*

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "username":"username123",
    "saved_story":[1, 3, 4],    // story id
    "poins": 200
}
```

## POST /api/user

Request  : `POST /api/user`

Headers  :

*All headers has been configured automatically*

Query    :

| Key     | Value            | Description             |
|---------|------------------|-------------------------|
| `type`  | `add_point`      | No description provided |
| `value` | (string|integer) | No description provided |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json

{
    "code":200,
    "status":"ok",
    "message":{
        ... query propertise ...
    }
}
```

## GET /api/users

Request  : `GET /api/users`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                        | Value                         | Description             |
|----------------------------|------------------------------ |-------------------------|
| `search` (optional)        | (string)                      | No description provided |
| `sort_by` (optional)       | `points` default: `points`    | No description provided |
| `sort_type` (optional)     | `asc`, `desc` default: `desc` | No description provided |
| `items_perpage` (optional) | (integer) default: `10`       | No description provided |
| `page` (optional)          | (integer) default: `1`        | No description provided |

Response :
```
HTTP/1.1 200 OK
Content-Type: text/json
[
    {
        "username":"username123",
        "points": 200
    }
]
```

## GET /api/stories

Request  : `GET /api/stories`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                        | Value                                                         | Description             |
|----------------------------|---------------------------------------------------------------|-------------------------|
| `search` (optional)        | (string)                                                      | No description provided |
| `sort_by` (optional)       | `stars`, `saved`, `publish_date`, `accessed` default: `stars` | No description provided |
| `sort_type` (optional)     | `asc`, `desc` default: `desc`                                 | No description provided |
| `items_perpage` (optional) | (integer) default: `9`                                        | No description provided |
| `page` (optional)          | (integer) default: `1`                                        | No description provided |

Response :
```
Content-Type: text/json

[
    {
        "id":1,
        "image": "https://",
        "title": "Story Title",
        "description":"Lorem ipsum dolor sit amet"
        "stars": 3.2,
        "saved": 123,
        "publish_date":"31/07/2021",
        "accessed": 120,
        "categories": []
    },
    ...
]
```

## GET /api/stories/recomendation

Request  : `GET /api/stories/recomendation`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                        | Value                  | Description             |
|----------------------------|------------------------|-------------------------|
| `items_perpage` (optional) | (integer) default: `9` | No description provided |
| `page` (optional)          | (integer) default: `1` | No description provided |

Response :
```
Content-Type: text/json

[
    {
        "id":1,
        "image": "https://",
        "title": "Story Title",
        "description":"Lorem ipsum dolor sit amet"
        "stars": 3.2,
        "saved": 123,
        "publish_date":"31/07/2021",
        "accessed": 120,
        "categories": []
    },
    ...
]
```

## GET /api/story/{story_id}

Request  : `GET /api/story/{story_id}`

Headers  :

*All headers has been configured automatically*

Query    :

| Key        | Value     | Description             |
|------------|-----------|-------------------------|
| `story_id` | (integer) | No description provided |

Response :
```
Content-Type: text/json

{
    "id":1,
    "image": "https://",
    "title": "Story Title",
    "description":"Lorem ipsum dolor sit amet"
    "stars": 3.2,
    "saved": 123,
    "publish_date":"31/07/2021",
    "accessed": 120,
    "categories": []
}
```
