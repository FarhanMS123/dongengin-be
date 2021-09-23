# Restfull Application Programming Interface (Rest-API)

This documentation would explain how to interact with backend, including the routes, sign (headers), parameters, 
and response. You could see all interaction in the list below.

- `POST /api/auth/login`
- `POST /api/auth/logout`
- `GET  /api/user`
- `GET  /api/user/children`
- `GET  /api/user/child/{username}`
- `POST /api/user`
- `GET  /api/stories`
- `GET  /api/stories/recomendation`
- `GET  /api/story/{story_id}`
- `GET  /api/users`

## POST /api/auth/login

Request  : `POST /api/auth/login`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                   | Value    | Description                                                                                     |
|-----------------------|----------|-------------------------------------------------------------------------------------------------|
| `username`            | (string) | This field only provided to authenticate child account                                          |
| `email`               | (string) | This field only provided to authenticate parent account                                         |
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

```
HTTP/1.1 401 Unauthorized
Content-Type: text/json

{
    "code":401,
    "status":"unauthorized",
    "message":"auth/credential-error"
}
```

## GET /api/stories

Request  : `GET /api/stories`

Headers  :

*All headers has been configured automatically*

Query    :

| Key                 | Value                                                | Description             |
|---------------------|------------------------------------------------------|-------------------------|
| `search` (optional) | (string)                                             | No description provided |
| `sort_by`           | `stars`, `publish_date`, `accessed` default: `stars` | No description provided |
| `sort_type`         | `asc`, `desc` default: `desc`                        | No description provided |
| `items_perpage`     | (integer) default: `9`                               | No description provided |
| `page`              | (integer) default: `1`                               | No description provided |

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
        "publish_date":"31/07/2021",
        "accessed": 120
    },
    ...
]
```
