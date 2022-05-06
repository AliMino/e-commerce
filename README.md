# E-commerce

- [E-commerce](#e-commerce)
  - [Preparing the project](#preparing-the-project)
    - [Installing dependencies](#installing-dependencies)
    - [Migrating The Database](#migrating-the-database)
    - [Seeding The Database](#seeding-the-database)
  - [Response Structure](#response-structure)
  - [Available Requests](#available-requests)
  - [Known Issues](#known-issues)

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

### Migrating The Database

```bash
php artisan migrate
```

---

### Seeding The Database

```bash
php artisan db:seed
```

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

For full requests & response reference, see [schema](docs/schema.md).

---

---

## Available Requests

|                                 Request Group | Request Name                                                  | HTTP Method | URL                           | Allowed For    |
| --------------------------------------------: | :------------------------------------------------------------ | ----------: | :---------------------------- | :------------- |
| [Merchants](docs/schema.md#merchant-requests) | [Signup Merchant](docs/schema.md#sign-up-merchant)            |        POST | api/merchants/register        | World          |
| [Merchants](docs/schema.md#merchant-requests) | [Authenticate Merchant](docs/schema.md#authenticate-merchant) |        POST | api/merchants/login           | World          |
| [Consumers](docs/schema.md#consumer-requests) | [Signup Consumer](docs/schema.md#sign-up-consumer)            |        POST | api/consumers/register        | World          |
| [Consumers](docs/schema.md#consumer-requests) | [Authenticate Consumer](docs/schema.md#authenticate-consumer) |        POST | api/consumers/login           | World          |
|       [Stores](docs/schema.md#store-requests) | [Update Store](docs/schema.md#update-store)                   |         PUT | api/stores/{storeId}          | Merchant       |
|                                      Products | Get All Products                                              |         GET | api/stores/{storeId}/products | World [^req_1] |
|                                      Products | Create Product                                                |        POST | api/stores/{storeId}/products | Merchant       |
|                                      Products | Update Product                                                |         PUT | api/stores/{storeId}/products | Merchant       |

---

---

## Known Issues

- All tenants databases live on the same host.
- Stateful (Session) authentication is used.

[^firstparty]: First-party packages are most-likely to be pre-installed with laravel.
[^req_1]: Merchants allowed only for their stores.

---

---

[Top](#e-commerce) &emsp; - &emsp; [Response Structure](#response-structure) &emsp; - &emsp; [Available Requests](#available-requests)
