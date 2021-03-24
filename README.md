<!-- omit in toc -->
# Epik API Library

This library is for using version 2 of the Epik.com REST API with your PHP application.  It has been developed by NameBlitz for its own use and is made avalible to the public under the MIT License, see the LICENSE file for more detials.

- [Installation](#installation)
  - [Requirements](#requirements)
- [Usage](#usage)
  - [Authenticating](#authenticating)
  - [Error Handling](#error-handling)
  - [Documentation](#documentation)
- [Semantic Versioning](#semantic-versioning)
- [Support](#support)

## Installation

To install the library, it is highly recommended that you use [Composer](http://getcomposer.org/) in your project. If you aren't using Composer yet, it's really simple! 

Here's how to install composer:

```bash
curl -sS https://getcomposer.org/installer | php
```

Once composer is installed all you have to do is run this: 

```bash
composer require nameblitz/epik-api "^2.0"
```

If you opt not to use composer, you can still manually download and load this library, see [Usage](#usage) below.

### Requirements

This library requires PHP 5.6 or greater with the CURL, JSON, and MBSTRING extensions.

## Usage

You should use the Composer autoloader in your application to automatically load
your dependencies. Make sure to include the following at the start of your script:

```php
require 'vendor/autoload.php';
use Epik\Epik;
```

If you aren't using composer, and *you really should*, you can also manually load this library using:

```php
require 'path/to/lib/EpikAPI.php';
use Epik\Epik;
```

### Authenticating

Next, before making your first API call you have to provide your API user signature by calling:

```php
\Epik\Auth::setSignature('YourSignatureHere');
\Epik\Auth::setMarketplaceSignature('YourMarketplaceSignatureHere');
```

Login to your Epik.com account API setting at https://registrar.epik.com/account/api-settings/ 
to generate and see your signature and add the IP(s) you will be using to connect to the API. You will use the signature listed under "User API Settings" for your user signature and the signature listed under "Marketplace API Settings" as your marketplace signature. 

Most calls authenticate using your userSignature however the Liquidate API calls use your marketplaceSignature. Therefore it is safe to only provide your userSignature if you are NOT using Liquidate methods or only provide your marketplaceSignature if you are only calling liquidate methods. If you are unsure just set both and this library will make sure to use the correct one for each call.

### Error Handling

If the Epik API returns an error, this library will throw it as a PHP Exception. Therefore, when attempting to make an API call, be sure to use a try/catch block to gracefully handle any errors that occur.

All error codes and error messages shown are the exact codes and messages returned by the Epik API.

For example:

```php
try {
    $domain = \Epik\Domains::Info('example.com');
    // Do Something with $Domain
} Catch ( Exception $e ) {
    echo 'The following error has occured: (' . $e->getCode() . ') ' . $e->getMessage();
}
```

### Documentation

For specific usage details, check out the [/docs](https://github.com/NameBlitz/epik-api/tree/master/docs) folder for detailed documentation for each method currently supported by this library.

## Semantic Versioning

This library makes use of [semantic versioning](https://semver.org/). This means the version number will be represented as: MAJOR **.** MINOR **.** PATCH

The **Major Version** will reflect the version of the Epik API the library is designed to work with (**This library starts at version 2 as it DOES NOT SUPPORT version 1 of the Epik API in any way**). The **Minor Version** represents supporting newer features later added to the same version of the Epik API. And the **Patch Version** represents bug and/or security fixes to the major/minor version identified as needed.

By using this you can make better use of Composer to update this library with new patches or even adding new features while preventing breaking changes from being introduced.  For example if you want to get all updates via composer for version 2 of the Epik API you can use:

```bash
composer require nameblitz/epik-api "^2.0"
```

Or if you don't want new features when using *composer update* you can still get bug and security patches by using:

```bash
composer require nameblitz/epik-api "~2.0"
```

## Support

NameBlitz uses and is actively supporting [this library](https://github.com/NameBlitz/epik-api). Issues and pull requests for this project are welcomed and encouraged.