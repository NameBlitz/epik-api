<!-- omit in toc -->
# Escrow Documentation

This library currently supports the following API based escrow operations:

- [Create Bulk Transaction](#create-bulk-transaction)
- [Create Transaction](#create-transaction)

Please refer to the **README** file in the root directory of this project for more details on how to incorporate this library into your project and how to get started with Authenticating to the API and for error handling. In this documentation we will show how to format requests for each of the operations listed above and what data you should expect in return. 

## Create Bulk Transaction

This method allows you to start a bulk escrow transaction.

```php
\Epik\Escrow::BulkTransaction([
    'escrow_fee' => 'buyer',
    'message' => '',
    'buyer_email' => 'buyer@epik.com',
    'seller_email' => 'seller@epik.com',
    'broker_email' => 'broker@epik.com',
    'seller_currency_payment' => 'USD',
    'buyer_currency_payment' => 'USD',
    'total_currency' => 'USD',
    'total' => 10000,
    'items' => [
        'domain' => 'example.com'
    ]
]);
```

<!-- omit in toc -->
### Request details

This method requires an *array* containing the details of the bulk transaction. The array contains the following:

* **escrow_fee**: A *string* identifying the party of the transaction whom is required to pay the escrow fee.
* **message**: A *string* containing a message to be associated with the transaction.
* **buyer_email**: A *string* identifying the email address of the buyer.
* **seller_email**: A *string* identifying the email address of the seller.
* **broker_email**: A *string* identifying the email address of the broker, if any.
* **seller_currency_payment**: A *string* identifying the seller's currency. 
* **buyer_currency_payment**: A *string* identifying the buyer's currency. 
* **total_currency**: A *string* identifying the currency used to express the total.
* **total**: A *float* identifying the total dollar amount of the escrow transaction.
* **items**: An *array* containing all the items involved in the transaction.

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.

## Create Transaction
This method requires an *array* containing the details of the transaction. The array contains the following:

```php
\Epik\Escrow::BulkTransaction([
    'escrow_fee' => 'buyer',
    'message' => '',
    'buyer_email' => 'buyer@epik.com',
    'seller_email' => 'seller@epik.com',
    'broker_email' => 'broker@epik.com',
    'seller_currency_payment' => 'USD',
    'buyer_currency_payment' => 'USD',
    'items' => [
        'domain' => 'example.com',
        'currency' => 'USD',
        'price' => 10000
    ]
]);
```

<!-- omit in toc -->
### Request details

This method requires an *array* containing the details of the transaction. The array contains the following:

* **escrow_fee**: A *string* identifying the party of the transaction whom is required to pay the escrow fee.
* **message**: A *string* containing a message to be associated with the transaction.
* **buyer_email**: A *string* identifying the email address of the buyer.
* **seller_email**: A *string* identifying the email address of the seller.
* **broker_email**: A *string* identifying the email address of the broker, if any.
* **seller_currency_payment**: A *string* identifying the seller's currency. 
* **buyer_currency_payment**: A *string* identifying the buyer's currency. 
* **items**: An *array* containing the details of the transactions.

The items array contains the following:

* **domain**: A *string* identifying the domain name for the transaction.
* **currency**: A *string* identifying the currency for the price. 
* **price**: A *float* identifying the amount to be paid by the buyer. 

<!-- omit in toc -->
### Response details

This method returns *true* if it is successful.