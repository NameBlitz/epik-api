<!-- omit in toc -->
# NameServers Documentation

This library currently supports the following API based nameservers operations:

- [Get Child NameServers](#get-child-nameservers)
- [Set Child NameServers](#set-child-nameservers)
- [Update Child NameServers](#update-child-nameservers)
- [Delete Child NameServers](#delete-child-nameservers)
- [Get NameServers](#get-nameservers)
- [Set NameServers](#set-nameservers)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Get Child NameServers

This method allows you to get the Child NameServers (also known as Glue Records) for a specific domain.

```php
\Epik\NameServers::GetChild('example.com');
```

<!-- omit in toc -->
### Request details

The request consists of a single parameter, a *string* representing a domain in your account for which you wish to get the Child NameServers.

<!-- omit in toc -->
### Response details

This method returns an *associative array* containing the Child NameServers and their IPv4 and IPv6 addresses.

```php
[
    'ns' => (string),
    'ipv4' => => [
        (string)
    ],
    'ipv6' => [
        (string)
    ]
]
```

## Set Child NameServers

This method allows you to create the Child NameServers (also known as Glue Records) associated with one of your domains.

```php
\Epik\NameServers::SetChild('example.com', [
    'ns' => 'ns1',
    'ipv4' => => [
        '888.888.888.888',
        '999.999.999.999'
    ],
    'ipv6' => [
        'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
        'zzzz:zzzz:zzzz:zzzz:zzzz:zzzz:zzzz:zzzz'
    ]
]);
```

<!-- omit in toc -->
### Request details

This method has two parameters. the first which is a *string* representing the domain name you want to create the NameServers for. The second an *array* containing the hostname and IPs to use. 

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.

## Update Child NameServers

This method allows you to update the Child NameServers (also known as Glue Records) associated with one of your domains.

```php
\Epik\NameServers::UpdateChild('example.com', [
    'ns' => 'ns1',
    'ipv4' => => [
        '888.888.888.888',
        '999.999.999.999'
    ],
    'ipv6' => [
        'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
        'zzzz:zzzz:zzzz:zzzz:zzzz:zzzz:zzzz:zzzz'
    ]
]);
```

<!-- omit in toc -->
### Request details

This method has two parameters. the first which is a *string* representing the domain name you want to update the NameServers for. The second an *array* containing the hostname and IPs to use. 

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.

## Delete Child NameServers

This method allows you to delete the specified Child NameServer associated with one of your domains.

```php
\Epik\NameServers::DeleteChild('example.com', 'ns1');
```

<!-- omit in toc -->
### Request details

This method has two parameters. the first which is a *string* representing the domain name you want to update the NameServers for. The second a *string* for the hostname of the Child NameServer you wish to delete.

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.

## Get NameServers

This method allows you to get the NameServers for a specific domain.

```php
\Epik\NameServers::Get('example.com');
```

<!-- omit in toc -->
### Request details

The request consists of a single parameter, a *string* representing a domain in your account for which you wish to get the NameServers.

<!-- omit in toc -->
### Response details

This method returns an *associative array* containing the NameServers

```php
[
    'ns1' => (string),
    'ns2' => (string),
    'ns3' => (string),
    'ns4' => (string)
]
```

## Set NameServers

This method allows you to change the NameServers associated with one of your domains.

```php
\Epik\NameServers::Set('example.com', [
    'ns1' => 'ns3.epik.com',
    'ns2' => 'ns4.epik.com'
]);
```

<!-- omit in toc -->
### Request details

This method has two parameters. the first which is a *string* representing the domain name you want to set the NameServers for. The second an *array* of NameServers to use. 

**NOTE**: 'ns1' and 'ns2' are required. You can optionally add a third and fourth NameServer by also including 'ns3' and 'ns4' in the array.

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.