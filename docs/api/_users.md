## /users

Get all Users Name, optional parameters term for search

<details> 
    <summary>Request Details</summary>

**URL** : `/users`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : Admin

**Data constraints** : `{?term => String }`

### Success Responses

**Code** : `200 OK`

**Content** : 
```json
[
  {
    "value": "xxxxxxx xxxxxxx",
    "id": 1
  }
]
```
</details> 
