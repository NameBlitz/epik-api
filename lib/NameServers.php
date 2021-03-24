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
 * Epik NameServers API Class
 */
class NameServers extends Epik {

    public static function GetChild( $domain ) {

        $resp = HTTPclient::Get( 'domains/' . $domain . '/name_servers/child' );

        if ( !self::IsError( $resp ) ) {
            return $resp['data']['data'];
        }

        return false;

    }

    public static function SetChild( $domain, $data ) {

        $resp = HTTPclient::Post( 'domains/' . $domain . '/name_servers/child', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }
    
    public static function UpdateChild( $domain, $data ) {

        $resp = HTTPclient::Put( 'domains/' . $domain . '/name_servers/child', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function DeleteChild( $domain, $param ) {

        $resp = HTTPclient::Delete( 'domains/' . $domain . '/name_servers/child', '{ "hostname": "' . $param . '.' . $domain . '" }' );
        return $resp;
        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function Get( $domain ) {
        
        $resp = HTTPclient::Get( 'domains/' . $domain . '/name_servers' );

        if ( !self::IsError( $resp ) ) {
            
            $nameservers = explode( ',', $resp['data']['description'] );
            $result = [];
            for ($x = 0; $x < sizeof( $nameservers ); $x++) {
                $num = $x + 1;
                $key = 'ns' . $num;
                $result[$key] = $nameservers[$x];
            }

            return $result;

        }

        return false;

    }

    public static function Set( $domain, $params ) {

        $data = [];

        foreach ( $params as $key => $value ) {
            $data['nses'][$key] = $value;
        }
        
        $resp = HTTPclient::Put( 'domains/' . $domain . '/name_servers', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

}