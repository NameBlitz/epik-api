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
 * Epik Users API Class
 */
class Users extends Epik {

    public static function Get( $email ) {

        $resp = HTTPclient::Get( 'users', [ 'EMAIL' => $email ] );

        if ( !self::IsError( $resp ) ) {
            
            return $resp['user'];

        }

        return false;

    }

    public static function Create( $params ) {

        $data['USER'] = $params;

        $resp = HTTPclient::Post( 'users', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;
        
    }

    public static function Update( $id, $params ) {
        
        $data['USER'] = $params;
        $data['USERID'] = $id;

        $resp = HTTPclient::Put( 'users', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;
    }

}