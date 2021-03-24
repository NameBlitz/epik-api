<!-- omit in toc -->
# Whois Documentation

This library currently supports the following API based operations to manage domain Whois in to your Epik.com account:

- [Get Whois Details](#get-whois-details)
- [Set Whois Details](#set-whois-details)
- [Enable/Disable Whois Privacy](#enabledisable-whois-privacy)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Get Whois Details

This method allow you to get the current Whois details associated with a given domain in your account.

```php
\Epik\Whois::Get('example.com');
```

**NOTE:** Unless you use Whois Privacy on your domain, this information is made publicly available. However Epik's Whois Privacy is offered for free and can be enabled or disabled as described [below](#enabledisable-whois-privacy).

<!-- omit in toc -->
### Request details

This method expects one parameter, a *string* containing the domain name in your account for which you wish to view the current Whois details.

<!-- omit in toc -->
### Response details

Returns an *array* including basic domain details and the current owner (registrant), admin, tech, and billing contacts. 

```php
[
    'name' => (string),
    'crDate' => (string),
    'exDate' => (string),
    'upDate' => (string),
    'nses' => (string),
    'ownerContact' => [
        'organization' => (string),
        'name' => (string),
        'email' => (string),
        'address' => (string),
        'city' => (string),
        'state' => (string),
        'zip' => (string),
        'country' => (string),
        'phone' => (string)
    ],
    'adminContact' => [
        'organization' => (string),
        'name' => (string),
        'email' => (string),
        'address' => (string),
        'city' => (string),
        'state' => (string),
        'zip' => (string),
        'country' => (string),
        'phone' => (string)
    ],
    'techContact' => [
        'organization' => (string),
        'name' => (string),
        'email' => (string),
        'address' => (string),
        'city' => (string),
        'state' => (string),
        'zip' => (string),
        'country' => (string),
        'phone' => (string)
    ],
    'billContact' => [
        'organization' => (string),
        'name' => (string),
        'email' => (string),
        'address' => (string),
        'city' => (string),
        'state' => (string),
        'zip' => (string),
        'country' => (string),
        'phone' => (string)
    ]
]
```

## Set Whois Details

This method allow you to change the Whois contact details associated with a domain name.
```php
\Epik\Whois::Set('example.com'. [
    'allContacts' => [
        'organization' => 'Example, Inc.',
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'address' => '123 N Main St',
        'city' => 'Some City',
        'state' => 'ST',
        'zip' => '00000',
        'country' => 'USA',
        'country_code' => 'US'
        'phone' => '+1.0005551234'
    ]
]);
```

<!-- omit in toc -->
### Request details

There are two options for setting the Whois details. If you wish to use the same details for all 4 contact types owner/registrant, admin, technical, and billing; you may use the contact type "**allContacts**" and include the details only once. 

Otherwise you will need to include an all 4 contact types "**ownerContact**", "**adminContact**", "**techContact**", and "**billContact**", and nested within each type you will need the details for that contact type, see the response details for Get Whois Details above for an example (NOTE however when setting the contacts you also need to set the "country_code" as well which is not shown when getting current contact details).

For each contact type (or for "allContacts" if used) you must provide the following:

* **organization**: a *string* containing the name of the organization of the contact, if any.
* **name**: a *string* containing the name of the person acting as the contact (still required if organization is used).
* **email**: a *string* containing the email address of the contact.
* **address**: a *string* containing the address for the contact.
* **city**: a *string* containing the name of the city for the contact's address.
* **state**: a *string* containing the name of the state or providence for the contact's address.
* **zip**: a *string* containing the zip or postal code for the contact's address.
* **country**: a *string* containing the full name of the country of the contact.
* **country_code**: a *string* containing the country code that represent's the contact's country.
* **phone**: a *string* containing the phone number for the contact. Must be in the format of +(country code) then a **.** then the phone number including area code.

<!-- omit in toc -->
### Response details

Returns *true* if the request is completed without any errors.

## Enable/Disable Whois Privacy

This method allow you to specify whether or not you wish to use Epik's free Whois Privacy.

```php
\Epik\Whois::Privacy('example.com', true);
```

<!-- omit in toc -->
### Request details

This method has a two parameters, the first a *string* for the domain name that you are trying to set the privacy status for. The second a *Boolean* defining if you want to enable or disable privacy. Set to *true* to enable or *false* to disable. You can also omit this parameter and it will default to *true* to enable privacy.

<!-- omit in toc -->
### Response details

Returns *true* if the request is completed without any errors.  If the domain's privacy status was already set to what you try to change it to no change will occur and it will still return *true*.