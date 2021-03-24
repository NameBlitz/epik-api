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
 * Epik Escrow API Class
 */
class Escrow extends Epik {

    public static function BulkTransaction( $params ) {

        $params['total'] = strval($params['total']);

        $resp = HTTPclient::Post( '/marketplace/escrow-bulk-domains-transaction', json_encode( $params ) );

        if ( !self::IsError( $resp ) ) {
            
            return true;

        }

        return false;

    }

    public static function Transaction( $params ) {

        $params['items']['price'] = strval($params['items']['price']);
        
        $resp = HTTPclient::Post( '/marketplace/escrow-transaction', json_encode( $params ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

}