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
 * Epik Domains API Class
 */
class Domains extends Epik {
    
    public static function Check( $domains ) {

        if ( is_array( $domains ) ){
            $data = [
                'DOMAINS' => implode( ',', $domains )
            ];
        }else{
            $data = [
                'DOMAINS' => $domains
            ];
        }

        $resp = HTTPclient::Get( 'domains/check', $data );

        if ( !self::IsError( $resp ) ) {
            $results = [];
            
            foreach ( $resp['data'] as $key => $value ) {    
                
                $results[$key] = [
                    'domain' => $value['domain'],
                    'supported' => boolval( $value['supported'] ),
                    'available' => boolval( $value['available'] ),
                    'premium' => boolval( $value['premium'] ),
                    'price' => floatval( $value['price'] ),
                    'marketplace_available' => boolval( $value['marketplace_available'] )
                ];
            }

            return $results;
        }

        return false;


    }

    public static function AutoRenew( $domain, $on = true ) {

        switch ( $on ) {

            case true:
                $resp = HTTPclient::Put( 'domains/' . $domain . '/auto_renew' );

            case false:
                $resp = HTTPclient::Delete( 'domains/' . $domain . '/auto_renew' );

        }

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function AuthCode( $domain ) {

        $resp = HTTPclient::Get( 'domains/' . $domain . '/authcode' );

        if ( !self::IsError( $resp ) ) {
            return $resp['data'];
        }

        return false;

    }

    public static function Info( $domain ) {

        $resp = HTTPclient::Get( 'domains/' . $domain . '/info' );

        if ( !self::IsError( $resp ) ) {
            $info = $resp['data'];
            $info['name_servers'] = explode( ' ', $resp['data']['name_servers'] );

            return $info;
        }

        return false;

    }

    public static function List( $params ) {

        $status = '';
        if ( $params['lock_status']['unlocked'] ) {
            $status .= 'unlocked,';
        }
        if ( $params['lock_status']['locked'] ) {
            $status .= 'locked,';
        }
        if ( $params['lock_status']['registrar_locked'] ) {
            $status .= 'registrar_locked,';
        }

        $data = [
            'current_page' => $params['current_page'],
            'per_page' => $params['per_page'],
            'lock_status' => substr( $status, 0, -1 ),
            'domain_like' => $params['domain_like']
        ];

        $resp = HTTPclient::Get( 'domains', $data, '&amp;' );

        if ( !self::IsError( $resp ) ) {
            return $resp;
        }

        return false;

    }

    public static function Lock( $domain, $on = true ) {

        switch ( $on ) {

            case true:
                $resp = HTTPclient::Put( 'domains/' . $domain . '/lock' );
            
            case false:
                $resp = HTTPclient::Put( 'domains/' . $domain . '/unlock' );

        }

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function MarketPurchase( $domain, $assign_user = 0 ) {
        
        $resp = HTTPclient::Post( 'domains/' . $domain . '/purchase', '{ "ASSIGNUSERID": "' . $assign_user . '" }' );

        if ( !self::IsError( $resp ) ) {
            $purchase = [
                'domain' => $domain,
                'payment_method' => $resp['data']['total']['method'],
                'payment_status' => $resp['data']['domain_name']['paymentStatus'],
                'payment_amount' => floatval( $resp['data']['domain_name']['paymentValue'] ),
                'assign_userid' => $assign_user
            ];

            return $purchase;
        }

        return false;
    }

    public static function Redeem( $domain ) {

        $resp = HTTPclient::Put( 'domains/' . $domain . '/redeem' );

        if ( !self::IsError( $resp ) ) {
            $redeem = [
                'domain' => $domain,
                'payment_method' => $resp['data']['total']['method'],
                'payment_status' => $resp['data']['domain']['paymentStatus'],
                'payment_amount' => floatval( $resp['data']['domain']['paymentValue'] ),
                'new_expiration_date' => $resp['data']['domain']['new_expiration_date']
            ];

            return $redeem;
        }

        return false;

    }

    public static function Register( $domain, $params ) {

        $data['PERIOD'] = $params['period'];
        $data['ASSIGNUSERID'] = $params['assignuserid'];
        
        foreach ( $params['contacts'] as $key => $value ) {
            $data['CONTACTS'][$key] = $value;
        }

        $resp = HTTPclient::Post( 'domains/'. $domain . '/create', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            $register = [
                'domain' => $domain,
                'payment_method' => $resp['data']['total']['method'],
                'payment_status' => $resp['data']['domain_name']['paymentStatus'],
                'payment_amount' => floatval( $resp['data']['domain_name']['paymentValue'] ),
                'price_per_year' => floatval( $resp['data']['domain_name']['pricePerPeriod'] ),
                'years_registered' => $resp['period']
            ];

            return $register;
        }

        return false;

    }

    public static function Renew( $domain, $period = 1 ) {

        $resp = HTTPclient::Put( 'domains/' . $domain . '/renew', '{ "PERIOD": "' . $period . '" }' );

        if ( !self::IsError( $resp ) ) {
            $renew = [
                'domain' => $domain,
                'payment_method' => $resp['data']['total']['method'],
                'payment_status' => $resp['data']['domain']['paymentStatus'],
                'payment_amount' => floatval( $resp['data']['domain']['paymentValue'] ),
                'price_per_year' => floatval( $resp['data']['domain']['pricePerPeriod'] ),
                'new_expiration_date' => $resp['data']['domain']['new_expiration_date']
            ];

            return $renew;
        }

        return false;

    }

}