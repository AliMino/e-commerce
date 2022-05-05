# E-commerce

- [E-commerce](#e-commerce)
  - [Preparing the project](#preparing-the-project)
    - [Installing dependencies](#installing-dependencies)
  - [Response Structure](#response-structure)
  - [Available Requests](#available-requests)
  - [Notes](#notes)

---

---

## Preparing the project

### Installing dependencies

This project utilizes a set of first-party [^firstparty] & third-party laravel packages, those packages are listed below corresponding to thier installation commands.

|    Package Name |                           URL                           | Installation Command               | First-Party | Third-Party |
| --------------: | :-----------------------------------------------------: | :--------------------------------- | :---------: | :---------: |
|  Stancl/Tenancy |  [Tenancy for laravel](https://tenancyforlaravel.com/)  | `composer require stancl/tenancy`  |             |      ✅      |
| Laravel/Sanctum | [Laravel sanctum](https://laravel.com/docs/9.x/sanctum) | `composer require laravel/sanctum` |      ✅      |             |

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

---

## Available Requests

|    Request Name |          URL           | Allowed For |
| --------------: | :--------------------: | :---------- |
| Signup Merchant | api/merchants/register | World       |
| Signup Consumer | api/consumers/register | World       |

---

---

## Notes

[^firstparty]: First-party packages are most-likely to be pre-installed with laravel.

---

---

[Top](#e-commerce)
