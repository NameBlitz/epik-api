<?php

/**
 * Copyright (C) 2020 NameBlitz
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Epik;

Use Epik\HTTPclient;

/**
 * Epik Parking API Class
 */
class Parking extends Epik {

    public static function Set( $domain, $params ) {
        
        $data = array_merge( [ 'domain' => $domain ], $params );
        $resp = HTTPclient::Post( 'domains/parking', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            
            return true;

        }

        return false;

    }

    public static function Delete( $domain ) {
        
        $resp = HTTPclient::Delete( 'domains/parking', '{ "domain": "' . $domain . '" }' );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

}