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
 * Epik EmailForwarding API Class
 */
class EmailForwarding extends Epik {

    public static function Get( $domain ) {
        
        $resp = HTTPclient::Get( 'domains/' . $domain . '/email_forwarding' );

        if ( !self::IsError( $resp ) ) {
            
            return $resp['data'];

        }

        return false;

    }

    public static function Set( $domain, $params ) {

        $data['enableRedirect'] = strval( $params['enableRedirect'] );

        if ( isset( $params['redirects'] ) ) {

            $data['redirects'] = $params['redirects'];

        } else {

            $data['redirects'] = [];

        }

        $data['enableCatchAll'] = strval( $params['enableCatchAll'] );
        $data['allEmailsForwardTo'] = $params['allEmailsForwardTo'];
        
        $resp = HTTPclient::Put( 'domains/' . $domain . '/email_forwarding', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

    public static function Delete( $domain ) {

        $params = [
            'enableRedirect' => 0,
            'redirects' => [
                'recipient' => '',
                'forwardTo' => ''
            ],
            'enableCatchAll' => 0,
            'allEmailsForwardTo' => ''
        ];

        return self::Set( $domain, $params );

    }

}