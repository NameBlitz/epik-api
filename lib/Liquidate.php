<?php

/**
 * Copyright (C) 2020 NameBlitz
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Epik;

use Epik\HTTPclient;

/**
 * Epik Liquidate API Class
 */
class Liquidate extends Epik {

    public static function Get() {

        $resp = HTTPclient::Get( 'liquidate/get-list', [], '&', true );

        if ( !self::IsError( $resp ) ) {

            return $resp['data'];

        }

        return false;

    }

    public static function Offer( $domain, $params = [] ) {

        $data = array_merge([ 'domain' => $domain ], $params);
        $resp = HTTPclient::Post( 'liquidate/add-domain', '', '&' . http_build_query( $data ), true );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

    public static function Delete( $domain ) {

        $resp = HTTPclient::Delete( 'liquidate/delete-domain', [ 'domain' => $domain ], '&', true );

        if ( !self::IsError( $resp ) ) {

            return true;
            
        }

        return false;

    }

  }