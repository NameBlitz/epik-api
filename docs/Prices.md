<!-- omit in toc -->
# Prices Documentation

This library currently supports the following API based prices operations:

- [Get all prices](#get-all-prices)
- [Get prices for a specific TLD](#get-prices-for-a-specific-tld)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Get all prices

This method allows you to get all prices for all TLD's.

```php
\Epik\Prices::All();
```

<!-- omit in toc -->
### Request details

There are no request parameters for this method.

<!-- omit in toc -->
### Response details

This method returns a *multidimensional array* containing all supported TLD's and their pricing information which looks like this:

```php
[
    'TLD' => [
        'register' => (float),
        'renew' => (float),
        'transfer' => (float),
        'first_year' => (float),
        'forever_renew' => (float)
    ]
]
```

**NOTE:** *Any pricing not available for the TLD will be excluded, which will generally happen with first_year or forever_renew prices which may not be applicable to a TLD. It is therefore recommended that you check for the existence of that key to ensure that is a valid option.*

## Get prices for a specific TLD

This method allows you to get all prices for a specific TLD.

```php
\Epik\Prices::Tld('com');
```

<!-- omit in toc -->
### Request details

This method had one parameter which is a *string* representing the TLD (without the dot) for which you want the pricing data. For example, if you want pricing for .com you would pass in *'com'*.

<!-- omit in toc -->
### Response details

This method returns an *associative array* containing the pricing information for the selected TLD which looks like this:

```php
[
    'register' => (float),
    'renew' => (float),
    'transfer' => (float),
    'first_year' => (float),
    'forever_renew' => (float)
]
```

**NOTE:** *Any pricing not available for the TLD will be excluded, which will generally happen with first_year or forever_renew prices which may not be applicable to a TLD. It is therefore recommended that you check for the existence of that key to ensure that is a valid option.*