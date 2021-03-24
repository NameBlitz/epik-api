<!-- omit in toc -->
# Transfers Documentation

This library currently supports the following API based operations to transfer domains in to your Epik.com account:

- [Initiate a transfer into Epik](#initiate-a-transfer-into-epik)
- [Restart a transfer into Epik](#restart-a-transfer-into-epik)
- [Get the status of a transfer in](#get-the-status-of-a-transfer-in)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Initiate a transfer into Epik

This method allow you to begin transferring a name at another registrar into Epik. You can do so like this:

```php
\Epik\Transfers::Start('example.com'. [
    'authcode' => (string),
    'assigniserid' => (int),
    'period' => (int)
]);
```

<!-- omit in toc -->
### Request details

There are two parameters to start a transfer. The first is a *string* for the domain name to transfer in, the second is a single *associative array* parameter containing the following values: 

* **authcode**: a *string* containing the authcode from the current registrar used to authenticate the transfer request.
* **assignuserid**: an *integer* representing the id of the subuser* to assign the domain to. *(default: 0)*
* **period**: an *integer* representing the number of years to add with the transfer. *(default: 1)*

***NOTE:** The *assignuserid* property is for a part of the Epik API not yet implemented in this library however for those who are using it with other integrations we are supporting it here for completeness, if you are unsure what is should be, leave it at its default 0.

<!-- omit in toc -->
### Response details

Returns *true* if the request is completed without any errors.

## Restart a transfer into Epik

This method allow you to restart a transfer that has not completed into Epik, It is similar to starting a transfer, and can be used like this:

```php
\Epik\Transfers::Restart('example.com'. [
    'authcode' => (string),
    'assigniserid' => (int),
    'period' => (int)
]);
```

<!-- omit in toc -->
### Request details

There are two parameters to restart a transfer. The first is a *string* for the domain name to transfer in, the second is a single *associative array* parameter containing the following values: 

* **authcode**: a *string* containing the authcode from the current registrar used to authenticate the transfer request.
* **assignuserid**: an *integer* representing the id of the subuser* to assign the domain to. *(default: 0)*
* **period**: an *integer* representing the number of years to add with the transfer. *(default: 1)*

***NOTE:** The *assignuserid* property is for a part of the Epik API not yet implemented in this library however for those who are using it with other integrations we are supporting it here for completeness, if you are unsure what is should be, leave it at its default 0.

<!-- omit in toc -->
### Response details

Returns *true* if the request is completed without any errors.

## Get the status of a transfer in

This method allow you to get the status of a transfer into Epik. You can do so like this:

```php
\Epik\Transfers::Status('example.com');
```

<!-- omit in toc -->
### Request details

This method has a single *string* parameter for the domain name that you are trying to get the status of.

<!-- omit in toc -->
### Response details

This method returns a *multidimensional array* like this:

```php
[
    'domain' => (string),
    'status' => (string),
    'states' => [
        '60-days' => (bool),
        'unlocked' => (bool),
        'registrar_approved' => (bool),
        'valid_authcode' => (bool),
        'ownership_approved' => (bool)
    ]
]
```

All 5 states should show *true* for the transfer to be able to complete. If any are *false* it will prevent the transfer from completing.

