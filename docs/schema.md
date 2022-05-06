# E-commerce - Schema

- [E-commerce - Schema](#e-commerce---schema)
  - [Response Structure](#response-structure)
  - [Authentication Request](#authentication-request)
  - [Consumer Requests](#consumer-requests)
    - [Sign-up Consumer](#sign-up-consumer)
    - [Authenticate Consumer](#authenticate-consumer)
  - [Merchant Requests](#merchant-requests)
    - [Sign-up Merchant](#sign-up-merchant)
    - [Authenticate Merchant](#authenticate-merchant)
  - [Store Requests](#store-requests)
    - [Update Store](#update-store)

---
---

## Response Structure

All responses returned from the documented API are following the same following schema

```json
{
  "status": "boolean",
  "data": "any",
  "error": "Error|null"
}
```

the value of the `data` field differs according to the requested resource, while the value of the `error` field is either `null` - in case of success, or an `Error` object as described below

```json
{
  "message": "string",
  "code": "integer",
  "details": "array"
}
```

the `details` field holds an extra details about the error - optionally provided at development - and will only be visible if the debug is enabled.

---

## Authentication Request

Allowed For: `World`.

The authentication URL differs in case of authenticating a consumer than that when authenticating a merchant, however, both authentication requests obeys the same schema as instructed below...

|    Input | Required | Type   |
| -------: | :------: | :----- |
|    email |    ✅     | string |
| password |    ✅     | string |

The successful response on such a request is the authentication token, returned in the following format...

```json
{
    "status": "boolean",
    "data": "string",
    "error": "Error|null"
}
```

---

## Consumer Requests

### Sign-up Consumer

Allowed For: `World`.

|                    URL | HTTP Method |
| ---------------------: | :---------- |
| api/consumers/register | POST        |

|                 Input | Required | Type   | Notes            |
| --------------------: | :------: | :----- | :--------------- |
|                  name |    ✅     | string |                  |
|                 email |    ✅     | string | unique           |
|              password |    ✅     | string |                  |
| password_confirmation |    ✅     | string | same as password |

A successful response for this request would be something like...

```json
{
    "status": true,
    "data": {
        "name": "user3",
        "email": "user3@consumers",
        "role_id": 2,
        "updated_at": "2022-05-06T06:57:31.000000Z",
        "created_at": "2022-05-06T06:57:31.000000Z",
        "id": 4,
        "role": {
            "id": 2,
            "name": "consumer"
        }
    },
    "error": null
}
```

---

### Authenticate Consumer

Allowed For: `World`.

|                 URL | HTTP Method |
| ------------------: | :---------- |
| api/consumers/login | POST        |

For request inputs see [Authentication Request](#authentication-request).

---

---

## Merchant Requests

### Sign-up Merchant

Allowed For: `World`.

|                    URL | HTTP Method |
| ---------------------: | :---------- |
| api/merchants/register | POST        |

In addition to all the inputs specified in the [Sign-up Consumer](#sign-up-consumer) request, the following inputs are defined for merchant creation...

|                Input | Required | Type   | Default | Notes                             |
| -------------------: | :------: | :----- | :------ | :-------------------------------- |
|           store_name |    ✅     | string | -       | unique                            |
| store_vat_percentage |          | float  | 0       | nullable between 0 & 1 inclusive. |

A normal response for this request would be...

```json
{
    "status": true,
    "data": {
        "name": "Ali",
        "email": "user2@merchants",
        "role_id": 1,
        "updated_at": "2022-05-06T07:31:09.000000Z",
        "created_at": "2022-05-06T07:31:09.000000Z",
        "id": 5,
        "role": {
            "id": 1,
            "name": "merchant"
        },
        "stores": [
            {
                "id": 3,
                "name": "store_2",
                "merchant_id": 5,
                "created_at": "2022-05-06T07:31:09.000000Z",
                "updated_at": "2022-05-06T07:31:09.000000Z",
                "vat_percentage": 0.14
            }
        ]
    },
    "error": null
}
```

---

### Authenticate Merchant

Allowed For: `World`.

|                 URL | HTTP Method |
| ------------------: | :---------- |
| api/merchants/login | POST        |

For request inputs see [Authentication Request](#authentication-request).

---

---

## Store Requests

### Update Store

Allowed For: `Merchant`.

|                  URL | HTTP Method |
| -------------------: | :---------- |
| api/stores/{storeId} | PUT         |

Only two attributes of a store are available for update, those are listed below...

|          Input | Type   | Notes         |
| -------------: | :----- | :------------ |
|       new_name | string |               |
| vat_percentage | float  | between 0 & 1 |

After updating a store successfuly, the updated version of the store is returned as following.

```json
{
    "status": true,
    "data": {
        "id": 2,
        "name": "store_1",
        "merchant_id": 3,
        "created_at": "2022-05-06T05:05:39.000000Z",
        "updated_at": "2022-05-06T08:17:23.000000Z",
        "vat_percentage": 1
    },
    "error": null
}
```

---

---

[Top](#e-commerce---schema) &emsp; - &emsp; [Home](../README.md)
