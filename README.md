# Talk 2017-06-20 - Why TDD?

## Endpoint

Here are the enpoint to implement and its goal is respond if a given username
has valid format and if is available.

```
POST /check-username

{
  "username": "fefas"
}
```

Possible responses:

* Valid and available: `200`
* Field `username` missing: `422`
* Invalid format: `403`
* Unavailable: `409`
