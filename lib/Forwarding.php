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
 * Epik Forwarding API Class
 */
class Forwarding extends Epik {

    public static function Get( $domain ) {
        
        $resp = HTTPclient::Get( 'domains/' . $domain . '/domain_forwarding' );

        if ( !self::IsError( $resp ) ) {
            
            return $resp['data'];

        }

        return false;

    }

    public static function Set( $domain, $params ) {
        
        $resp = HTTPclient::Put( 'domains/' . $domain . '/domain_forwarding', json_encode( $params ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

    public static function Delete( $domain ) {

        $params = [
            'enable' => 0,
            'typeForward' => 1,
            'status' => 303,
            'destination' => '',
            'maskingDesc' => '',
            'maskingKeywords' => '',
            'maskingTitle' => ''
        ];
        
        return self::Set( $domain, $params );

    }

}