# Restfull Application Programming Interface (Rest-API)

This documentation would explain how to interact with backend, including the routes, sign (headers), parameters, and response. You could see all interaction in the list below.

- `POST /api/auth/login`
- `POST /api/auth/logout`
- `GET  /api/stories`
- `GET  /api/users`

## GET /api/stories

Request  : `GET /api/stories`

Headers  :
*All headers has been configured automatically*

Query    :
| Key             | Value                                  | Description             |
|-----------------|----------------------------------------|--------------------------
| `type`          | `favorite`, `search`, `recomendation`  | No description provided |
| `query`         | (string)                               | No description provided |
| `items_perpage` | (integer) default: 9                   | No description provided |
| `page`          | (integer) default: 1                   | No description provided |

Response :
```
```
