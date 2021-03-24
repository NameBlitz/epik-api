<!-- omit in toc -->
# Marketplace Documentation

This library currently supports the following API based operations on the Epik.com marketplace:

- [Get marketplace listing details](#get-marketplace-listing-details)
- [Add/Change marketplace listing](#addchange-marketplace-listing)
- [Delete marketplace listing](#delete-marketplace-listing)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return.

## Get marketplace listing details

This method allows you to get the marketplace listing details for a domain name. It can be accessed using:

```php
\Epik\Marketplace::Get('example.com');
```

<!-- omit in toc -->
### Request details

There is a single *string* parameter for the domain name for which you wish to get the marketplace listing details.

<!-- omit in toc -->
### Response details

This method returns an *associative array* containing the listing details for the requested domain, which looks like this:

```php
[
    'domain' => (string),
    'sale_price' => (float),
    'offer_enabled' => (bool),
    'min_offer' => (float),
    'rental_enabled' => (bool),
    'rental_purchase' => (float),
    'rental_down_payment' => (float),
    'rental_price' => (float),
    'rental_pcap' => (int),
    'rental_annual_increase' => (float),
    'rental_percent_accrued' => (float),
    'rental_installments' => (int),
    'rental_refund_period' => (int),
    'rental_grace_period' => (int),
    'mp_private' => (bool),
    'mp_portal_enabled' => (bool),
    'mp_tabs' => (string),
    'mp_categories' => (string),
    'mp_adv_layout' => (bool),
    'mp_contact_enabled' => (bool),
    'mp_social_enabled' => (bool),
    'mp_stats_enabled' => (bool)
]
```

## Add/Change marketplace listing

This method allows you to create or update the marketplace listing for a domain name. It can be accessed using:

```php
\Epik\Marketplace::Offer([
    'domain' => (string),
    'sale_price' => (float),
    'offer_enabled' => (bool),
    'min_offer' => (float)
]);
```

<!-- omit in toc -->
### Request details

There is a single *associative array* parameter containing the following values: 

* **domain**: a *string* representing the domain you wish to offer on the marketplace.
* **sale_price**: a *float* representing the sale or buy it now price.
* **offer_enabled**: a *Boolean* representing if you are accepting offers on the domain.
* **min_offer**: a *float* representing the lowest offer you want to receive.

<!-- omit in toc -->
### Response details

This method returns *true* unless an error is encountered.

## Delete marketplace listing

This method allows you to delete the marketplace listing for a domain name. It can be accessed using:

```php
\Epik\Marketplace::Delete('example.com');
```

<!-- omit in toc -->
### Request details

There is a single parameter, a *string* representing the domain which you wish to delete.

<!-- omit in toc -->
### Response details

This method returns *true* unless an error is encountered.