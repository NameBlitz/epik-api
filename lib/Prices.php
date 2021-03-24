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
 * Epik Prices API Class
 */
class Prices extends Epik {

    public static function All() {

        $resp = HTTPclient::Get( 'availabletlds' );

        if ( !self::IsError( $resp ) ) {
            foreach ( $resp['data'] as $tld => $vals ) {
                $resp['data'][$tld] = array_map( 'floatval', $resp['data'][$tld] );
            }

            return $resp['data'];
        }

        return false;

    }

    public static function Tld( $tld ) {

        $data = [
            'tld' => $tld
        ];
        
        $resp = HTTPclient::Get( 'tldprices', $data  );

        if ( !self::IsError( $resp ) ) {
            return array_map( 'floatval', $resp['data'] );
        }

        return false;

    }

}