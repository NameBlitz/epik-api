<!-- omit in toc -->
# Domains Documentation

This library currently supports the following API based operations on your domains in your Epik.com account:

- [Checking availability of a domain](#checking-availability-of-a-domain)
- [Enabling and disabling AutoRenew](#enabling-and-disabling-autorenew)
- [Obtaining the AuthCode to transfer a domain out of Epik](#obtaining-the-authcode-to-transfer-a-domain-out-of-epik)
- [Showing the details of a domain name](#showing-the-details-of-a-domain-name)
- [Listing the domain names in your account](#listing-the-domain-names-in-your-account)
- [Locking and unlocking a domain](#locking-and-unlocking-a-domain)
- [Purchase from the Epik Marketplace](#purchase-from-the-epik-marketplace)
- [Redeem a domain](#redeem-a-domain)
- [Register a new domain](#register-a-new-domain)
- [Renewing a domain](#renewing-a-domain)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Checking availability of a domain

This method allows you to check the availability of a domain using Epik's API. This can be invoked by calling:

```php
$check = \Epik\Domains::Check('example.com');
```

<!-- omit in toc -->
### Request details

The request consists of one parameter in the form of either a *string* or an *array* of one or more domains you wish to check. If checking multiple domains using a string use a comma but no spaces to separate them, for example:

```php
$check = \Epik\Domains::Check('example1.com,example2.com');
```

<!-- omit in toc -->
### Response details

This method returns an *multidimensional array*.  Each domain searched will be returned as a key with the associated value being a *nested array* of details for that domain. For example:

```php
[
    'example1.com' => [],
    'example2.com' => []
]
```

with each of the nested arrays consisting of the following:

```php
[
    'domain' => (string),
    'supported' => (bool),
    'available' => (bool),
    'premium' => (bool),
    'price' => (float),
    'marketplace_availible' => (bool)
]
```

## Enabling and disabling AutoRenew

This method allows you to enable or disable auto renew on any of your domains. This can be invoked by calling:

```php
\Epik\Domains::AutoRenew('example.com', True);
```

<!-- omit in toc -->
### Request details

The request consists of two parameters, the first is a *string* representing the domain you wish to change. The second is a *Boolean* (True or False) which represents if you want auto renew on or off, use True for on and False for off.

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful. If the domain already has the auto renew status you specify when calling this method but does not run into any error it will still return true, though obviously no change will have occurred since the domain already had the requested auto renew status.

## Obtaining the AuthCode to transfer a domain out of Epik
This method allows you to obtain the AuthCode for any of your domains which is used to authorize the transfer of the domain to a new registrar. This can be invoked by calling:

```php
\Epik\Domains::AuthCode('example.com');
```

<!-- omit in toc -->
### Request details

The request consists of a single parameter, a *string* representing a domain in your account for which you wish to obtain the AuthCode.

<!-- omit in toc -->
### Response details

This method returns a simple *associative array* containing the domain name and the AuthCode, such as this:

```php
[
    'domain' => (string),
    'auth_code' => (string)
]
```

## Showing the details of a domain name

This method allows you to obtain details about any domain in your account. This can be invoked by calling:

```php
\Epik\Domains::Info('example.com');
```

<!-- omit in toc -->
### Request details

The request consists of a single parameter, a *string* representing a domain in your account for which you wish to obtain the info.

<!-- omit in toc -->
### Response details

This method returns a simple *multidimensional array* containing the details of the domain. This array looks like this:

```php
[
    'domain' => (string),
    'auto_renew' => (bool),
    'locked' => (bool),
    'registration_date' => (string "YYYY-MM-DD HH:MM:SS"),
    'expiration_date' => (string "YYYY-MM-DD HH:MM:SS"),
    'name_servers' => ['ns1', 'ns2']
]
```

## Listing the domain names in your account

This method allow you to obtain details about any domain in your account. This can be invoked by calling:

```php
\Epik\Domains::List([
    'current_page' => 1,
    'per_page' => 30,
    'lock_status' => [
        'unlocked' => true,
        'locked' => true,
        'registrar_locked' = > true
    ],
    'domain_like' => ''
]);
```

<!-- omit in toc -->
### Request details

The request consists of a single parameter, an *array* representing various optional parameters to limit the results of the listing.

* **current_page**: on which page you wish to start the list. *(default: 1)*
* **per_page**: how many results you wish to have on one page. *(default: 30)*
* **lock_status/unlocked**: include domains which are unlocked? *(default: true)*
* **lock_status/locked**: include domains which are locked? *(default: true)*
* **lock_status/registrar_locked**: include domains which are registrar locked? *(default: true)*
* **domain_like**: a string representing a filter for your list *(default: none)*

All of these parameters are optional,  you can use this method without any parameters to get an unfiltered list of the first 30 domains in your account, like this:

```php
\Epik\Domains::List();
```

<!-- omit in toc -->
### Response details

This method returns an *multidimensional array* with a detailed listing of all the domain names that match the parameters provided (or the first 30 domains if no parameters are provided.)

The base array contains a *meta* key and a *data* key with nested arrays. The *meta* key contains some basic details about your domains and the list to help you keep track and looks like this:

```php
[
    'current_page' => (int),
    'per_page' => (int),
    'total_entries' => (int),
    'total_pages' => (int)
]
```

The *data* key contains a *indexed array* with an entry for each domain itself containing *multidimensional array* of data under it that looks like this:

```php
[
    'domain' => (string),
    'auto_renew' => (bool),
    'locked' => (bool),
    'registrar_lock' => (bool),
    'registration_date' => (string "YYYY-MM-DD HH:MM:SS"),
    'expiration_date' => (string "YYYY-MM-DD HH:MM:SS"),
    'name_servers' => ['ns1', 'ns2'],
    'forSale' => (bool),
    'forLease' => (bool),
    'forOffer' => (bool),
    'revenue' => (float),
    'visits' => (int),
    'whoisCount' => (int),
    'comment' => (string),
    'deletion_date' => (string "YYYY-MM-DD HH:MM:SS")
]
```

## Locking and unlocking a domain

This method allows you to lock or unlock any of your domains to prevent or allow transfers accordingly. This can be invoked by calling:

```php
\Epik\Domains::Lock('example.com', True);
```

<!-- omit in toc -->
### Request details

Like the AutoRenew method this request consists of two parameters, the first is a *string* representing the domain you wish to change. The second is a *Boolean* (True or False) which represents if you want the lock on or off, use True for on and False for off.

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful. If the domain already has the lock status you specify when calling this method but does not run into any error it will still return true, though obviously no change will have occurred since the domain already had the requested lock status.

## Purchase from the Epik Marketplace

This method allows you to purchase a domain that is for sale though the Epik Marketplace.

```php
\Epik\Domains::MarketPurchase('example.com', 0);
```

<!-- omit in toc -->
### Request details

This method this request consists of two parameters, the first is a *string* representing the domain on the Epik Marketplace you wish to purchase. The second is a *Integer* which the sub user id to assign the domain to. You can also exclude this second parameter and it will default to 0, or no sub-user.

<!-- omit in toc -->
### Response details

This method returns an *array* with the following details:

```php
[
    'domain' => (string),
    'payment_method' => (string),
    'payment_status' => (string),
    'payment_amount' => (float),
    'assign_userid' => (int)
]
```

## Redeem a domain

This method allows you to redeem a domain that is currently in the Redemption Grace Period, thus extending its expiration date. Please note, the fee to redeem a domain is generally higher than a standard renewal. This method can be invoked by calling:

```php
\Epik\Domains::Redeem('example.com');
```

<!-- omit in toc -->
### Request details

This method this request consists of a single parameter, a *string* representing the domain you wish to redeem. This will add one year to the previous expiration date.

<!-- omit in toc -->
### Response details

This method returns an *array* with the following details:

```php
[
    'domain' => (string),
    'payment_method' => (string),
    'payment_status' => (string),
    'payment_amount' => (float),
    'new_expiration_date' => (string "YYYY-MM-DD HH:MM:SS")
]
```

## Register a new domain 

This method allows you to register a new available domain name. You should use the Check method first to ensure the domain is available for registration. If available, you can register the domain using the following:

```php
\Epik\Domains::Register('example.com', [
    'period' => 1,
    'assignuserid' => 0,
    'contacts' => [
        'name' => 'string',
        'companyname' => 'string',
        'email' => 'string',
        'address1' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zipcode' => 'string',
        'country' => 'string',
        'phonenumber' => 'string'
	]
]);
```

<!-- omit in toc -->
### Request details

This method this request consists of two parameters, the first is a *string* representing the domain you wish to register. The second is an *array* containing additional data required to process your request.

The array contains the following:

* **period**: An *integer* representing how many years you wish to register the domain for. *(default: 1)*
* **assignuserid**: An *integer* representing the sub-user ID to assign the domain to. Use 0 for no sub-user. *(default: 0)*
* **contacts**: An *array* containing the contact details to associate with the new domain.

The '*contacts*' sub array should contain the following:

* **name**: the first and last name of the domain owner.
* **companyname**: the company name that owns the domain, if any.
* **email**: the email address of the owner.
* **address1**: the address of the owner, excluding city, state, zip, country.
* **city**: the city of the owner.
* **state**: the state or providence of the domain owner.
* **zipcode**: the zip or postal code for the owner.
* **country**: the country of the domain owner.
* **phonenumber**: the phone number of the owner in the following format: +(country code).(number)

<!-- omit in toc -->
### Response details

This method returns an *array* with the following details:

```php
[
    'domain' => (string),
    'payment_method' => (string),
    'payment_status' => (string),
    'payment_amount' => (float),
    'price_per_year' => (float).
    'years_registered' => (int)
]
```

## Renewing a domain 

This method allows you to renew a domain, thus extending its expiration date. This can be invoked by calling:

```php
\Epik\Domains::Renew('example.com', 1);
```

<!-- omit in toc -->
### Request details

This method this request consists of two parameters, the first is a *string* representing the domain you wish to renew. The second is a *Integer* which represents how many years you wish to add. You can also exclude this second parameter and it will default to 1 year.

<!-- omit in toc -->
### Response details

This method returns an *array* with the following details:

```php
[
    'domain' => (string),
    'payment_method' => (string),
    'payment_status' => (string),
    'payment_amount' => (float),
    'price_per_year' => (float).
    'new_expiration_date' => (string "YYYY-MM-DD HH:MM:SS")
]
```

