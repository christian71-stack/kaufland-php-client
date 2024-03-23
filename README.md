![stability-wip](https://img.shields.io/badge/stability-work_in_progress-lightgrey.svg) ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/productflowbv/kaufland-php-client?include_prereleases) [![MIT License](https://img.shields.io/github/license/productflowbv/kaufland-php-client)](https://github.com/productflowbv/kaufland-php-client/blob/master/LICENSE) [![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)

# STILL WORK IN PROGRESS

Fork of the ProductFlows

# kaufland-php-client

An unofficial client for the Kaufland/Real.de API.

## Installation
This project can easily be installed through Composer.

```
composer require christian71-stack/kaufland-php-client
```

## Set-up connection
Prepare the client for connecting to Kaufland with your client key and secret key.
```php
$kaufland = new \ProductFlow\KauflandPhpClient\Kaufland(
    $clientkey,
    $secretkey,
    (new Locale())->set(Locale::CS_CZ),         // optional
    (new Storefront())->set(Storefront::CZ))    // optional
    new Client(...)                             // optional
);
```

## Get all order-units
Returns an array of order-units
```php
$order_lists = $kaufland->orderUnit()->list();
```

## Supported endpoints (still being added)

:white_check_mark: = Done, and tested<br />
:ballot_box_with_check: = Done, but not yet tested<br />
:x: = Not yet developed<br />
:heavy_exclamation_mark: = deprecated/not supported <br />

| Endpoint                                                                             | Status                   |
|--------------------------------------------------------------------------------------|--------------------------|
| [attributes](https://sellerapi.kaufland.com/?page=endpoints#/Attributes)             | :ballot_box_with_check:  |
| [carriers](https://sellerapi.kaufland.com/?page=endpoints#/Carriers)                 | :x:                      |
| [categories](https://sellerapi.kaufland.com/?page=endpoints#/Categories)             | :white_check_mark:       |
| [import-files](https://sellerapi.kaufland.com/?page=endpoints#/Import%20Files)       | :ballot_box_with_check:  |
| [infos](https://sellerapi.kaufland.com/?page=endpoints#/Info)                        | :white_check_mark:       |
| items                                                                                | :ballot_box_with_check:  |
| [product-data](https://sellerapi.kaufland.com/?page=endpoints#/Product%20Data)       | :white_check_mark:       |
| [orders](https://sellerapi.kaufland.com/?page=endpoints#/Orders)                     | :white_check_mark:       |
| [order-invoices](https://sellerapi.kaufland.com/?page=endpoints#/Order%20Invoices)   | :ballot_box_with_check:  |
| [order-units](https://sellerapi.kaufland.com/?page=endpoints#/Order%20Units)         | :white_check_mark:       |
| [products](https://sellerapi.kaufland.com/?page=endpoints#/Products)                 | :x:                      |
| [shipments](https://sellerapi.kaufland.com/?page=endpoints#/Shipments)               | :ballot_box_with_check:  |
| [reports](https://sellerapi.kaufland.com/?page=endpoints#/Reports)                   | :ballot_box_with_check:  |
| [returns](https://sellerapi.kaufland.com/?page=endpoints#/Returns)                   | :ballot_box_with_check:  |
| [return-units](https://sellerapi.kaufland.com/?page=endpoints#/Return%20Units)       | :ballot_box_with_check:  |
| [shipping-groups](https://sellerapi.kaufland.com/?page=endpoints#/Shipping%20Groups) | :ballot_box_with_check:  |
| [status](https://sellerapi.kaufland.com/?page=endpoints#/Status)                     | :white_check_mark:       |
| [subscriptions](https://sellerapi.kaufland.com/?page=endpoints#/Subscriptions)       | :ballot_box_with_check:  |
| ticket-messages                                                                      | :ballot_box_with_check:  |
| [tickets](https://sellerapi.kaufland.com/?page=endpoints#/Tickets)                   | :ballot_box_with_check:  |
| [warehouses](https://sellerapi.kaufland.com/?page=endpoints#/Warehouses)             | :ballot_box_with_check:  |
| [units](https://sellerapi.kaufland.com/?page=endpoints#/Units)                       | :white_check_mark:       |

