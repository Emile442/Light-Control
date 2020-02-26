## /lights

Get all Lights Name, optional parameters term for search

<details> 
    <summary>Request Details</summary>

**URL** : `/lights`

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

## /lights/:id

Get a ZigbeeInfo about a light

<details> 
    <summary>Request Details</summary>

**URL** : `/lights/:id`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : Admin

**Data constraints** : `{:id => Int}`

### Success Responses

**Code** : `200 OK`

**Content** : 
```json
{
  "state": {
    "on": false,
    "bri": 254,
    "hue": 64261,
    "sat": 189,
    "effect": "none",
    "xy": [
      0.5842,
      0.3124
    ],
    "ct": 153,
    "alert": "select",
    "colormode": "xy",
    "mode": "homeautomation",
    "reachable": true
  },
  "swupdate": {
    "state": "noupdates",
    "lastinstall": "2018-12-04T23:35:41"
  },
  "type": "Extended color light",
  "name": "Hue color lamp 1",
  "modelid": "LCT015",
  "manufacturername": "Signify Netherlands B.V.",
  "productname": "Hue color lamp",
  "capabilities": {
    "certified": true,
    "control": {
      "mindimlevel": 1000,
      "maxlumen": 806,
      "colorgamuttype": "C",
      "colorgamut": [
        [
          0.6915,
          0.3083
        ],
        [
          0.17,
          0.7
        ],
        [
          0.1532,
          0.0475
        ]
      ],
      "ct": {
        "min": 153,
        "max": 500
      }
    },
    "streaming": {
      "renderer": true,
      "proxy": true
    }
  },
  "config": {
    "archetype": "sultanbulb",
    "function": "mixed",
    "direction": "omnidirectional",
    "startup": {
      "mode": "safety",
      "configured": true
    }
  },
  "uniqueid": "00:17:88:01:04:85:1d:35-0b",
  "swversion": "1.46.13_r26312",
  "swconfigid": "52E3234B",
  "productid": "Philips-LCT015-1-A19ECLv5"
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

## /lights/:id/state/:mode

Set state to light

<details> 
    <summary>Request Details</summary>

**URL** : `/lights/:id/state/:mode`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : Admin

**Data constraints** : `{:id => Int, :mode => Int(0|1)}`

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
