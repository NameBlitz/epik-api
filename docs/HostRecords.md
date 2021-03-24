<!-- omit in toc -->
# HostRecords Documentation

This library currently supports the following API based operations for HostRecords when using the official Epik NameServers:

- [Get current records](#get-current-records)
- [Create a record](#create-a-record)
- [Update an existing record](#update-an-existing-record)
- [Delete a record](#delete-a-record)

**NOTE**: The DNS records managed by these methods will NOT work UNLESS you set your domain's NameServers to "ns3.epik.com" and "ns4.epik.com".  You can do so with this library, for example if your domain was example.com you would call:

````php
\Epik\NameServers::Set('example.com', [
    'ns1' => 'ns3.epik.com',
    'ns2' => 'ns4.epik.com'
]);
````

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return.

## Get current records

This method allows you to get all the DNS host records for a domain name when using Epik's DNS.

```php
\Epik\HostRecords::Get('example.com');
```

<!-- omit in toc -->
### Request details

There is a single *string* parameter for the domain name for which you wish to get the DNS records.

<!-- omit in toc -->
### Response details

This method returns an *multidimensional array* containing the DNS records for the domain. Each record will be one indexed entry of an array and for each record the following will be returned as a sub-array:

```php
[
    'id' => (string),
    'host' => (string),
    'type' => (string),
    'data' => (string),
    'aux' => (string),
    'ttl' => (int)
]
```

## Create a record

This method allows you to create a new DNS host record for your domain.

```php
\Epik\HostRecords::Create('example.com', [
    'host' => (string),
    'type' => (string),
    'data' => (string),
    'aux' => (string),
    'ttl' => (int)
]);
```

<!-- omit in toc -->
### Request details

The request consists of 2 parts. The first is a *string* representing the domain name you want to create the record for, the second an *array* of the details for the record. The array should include: 

* **host**: a *string* representing the hostname for the record, For example if you wanted to set the record for "example.com" you would leave the host blank. If you wanted to set it for "test.example.com" you would set the host as "test". (*default: blank*)
* **type**: A *string* identifying the record type, may be any of the following: A, AAAA, CNAME, NS, MX, SRV, TXT, CAA, ALIAS, or URI.
* **data**: a *string* representing the value for the given record.
* **aux**: a *string* containing additional details required for the record, for example if setting an MX record the aux would be the priority for the record.
* **ttl**: an *integer* representing the time to live, which is the number of seconds a record may be cached for by other DNS servers before they should recheck with your NameServer to get the current value.

<!-- omit in toc -->
### Response details

This method returns *true* unless an error is encountered.

## Update an existing record

This method allows you to update an existing DNS host record for your domain.

```php
\Epik\HostRecords::Update('example.com', [
    'id' => (string),
    'host' => (string),
    'type' => (string),
    'data' => (string),
    'aux' => (string),
    'ttl' => (int)
]);
```

<!-- omit in toc -->
### Request details

The request consists of 2 parts. The first is a *string* representing the domain name you want to create the record for, the second an *array* of the details for the record. The array is the same as to create a record but also includes an "id" field which is a *string* and should be set to match the existing record you wish to override. You can get the ID using the Get method as described above.

<!-- omit in toc -->
### Response details

This method returns *true* unless an error is encountered.

## Delete a record

This method allows you to delete a DNS host record using it's ID.

```php
\Epik\HostRecords::Delete('example.com', 'EnterIdHere');
```

<!-- omit in toc -->
### Request details

There are two parameters, the first a *string* representing the domain you wish to perform the action against, the second a *string* containing the ID of the record which you wish to delete.  You can get the ID from the Get method.

<!-- omit in toc -->
### Response details

This method returns *true* unless an error is encountered.