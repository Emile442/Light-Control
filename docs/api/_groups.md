## /groups

Get all Groups Name, optional parameters term for search

<details> 
    <summary>Request Details</summary>

**URL** : `/groups`

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
    "value": "xxxxxxx"
  }
]
```
</details> 

## /groups/:id/state/:state

Set state to lights of a group

<details> 
    <summary>Request Details</summary>

**URL** : `/groups/:id/state/:state`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : Admin

**Data constraints** : `{:id => Int, :state => Int(0|1)}`

### Success Responses

**Code** : `200 OK`

**Content** : 
```json
{
  "success": true,
  "errors": []
}
```

### Error Responses

**Code** : `404 Not Found` || `504 Gateway Timeout`

**Content** : 

```json
{
  "success": false,
  "errors": [
    "..."
  ]
}
```
</details> 

## /groups/:id/state/:state/:period

Set state to a group for a specific Time in minutes

<details> 
    <summary>Request Details</summary>

**URL** : `/groups/:id/state/:state/:period`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : Admin

**Data constraints** : `{:id => Int, :state => Int(0|1), :period => Int}`

### Success Responses

**Code** : `200 OK`

**Content** : 
```json
{
  "success": true,
  "errors": []
}
```

### Error Responses

**Code** : `404 Not Found` || `504 Gateway Timeout`

**Content** : 

```json
{
  "success": false,
  "errors": [
    "..."
  ]
}
```
</details> 
