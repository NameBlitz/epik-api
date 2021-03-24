<?php

/**
 * Copyright (C) 2020 NameBlitz
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Epik;

/**
 * Epik Class 
 */

class Epik {

    /** @var string your Epik API User Signature */
    protected static $UserSignature;

    /** @var string your Epik API Marketplace Signature */
    protected static $MarketplaceSignature;

    /** @var string the base URL for the Epik API  */
    public static $BaseURL = 'https://usersapiv2.epik.com/v2';

    protected static function IsError( $resp ) {

        if ( !isset( $resp['errors'] ) ) {

            return false;

        }

        foreach ( $resp['errors'] as $error ) {

            throw new \Exception( $error['description'], $error['code'] );

        }
  
        return true;

    }

}

/**
 * Epik API Auth Class
 */
class Auth extends Epik {

    public static function SetSignature( $sig ) {
        self::$UserSignature = $sig;
    }

    public static function SetMarketplaceSignature( $sig ) {
        self::$MarketplaceSignature = $sig;
    }

}

/**
 * Load in the rest of the library
 */
require 'Domains.php';
require 'EmailForwarding.php';
require 'Forwarding.php';
require 'HostRecords.php';
require 'HTTPclient.php';
require 'Liquidate.php';
require 'Marketplace.php';
require 'NameServers.php';
require 'Parking.php';
require 'Prices.php';
require 'Transfers.php';