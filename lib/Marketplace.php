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
 * Epik Marketplace API Class
 */
class Marketplace extends Epik {

    public static function Get( $domain ) {

        $data = [
            'DOMAIN' => $domain
        ];

        $resp = HTTPclient::Get( 'domains/marketplace', $data );

        if ( !self::IsError( $resp ) ) {
            $resp['data']['sale_price'] = floatval( $resp['data']['sale_price'] );
            $resp['data']['offer_enabled'] = boolval( $resp['data']['offer_enabled'] );
            $resp['data']['min_offer'] = floatval( $resp['data']['min_offer'] );
            $resp['data']['rental_enabled'] = boolval( $resp['data']['rental_enabled'] );
            $resp['data']['rental_purchase'] = floatval( $resp['data']['rental_purchase'] );
            $resp['data']['rental_down_payment'] = floatval( $resp['data']['rental_down_payment'] );
            $resp['data']['rental_price'] = floatval( $resp['data']['rental_price'] );
            $resp['data']['rental_pcap'] = intval( $resp['data']['rental_pcap'] );
            $resp['data']['rental_annual_increase'] = floatval( $resp['data']['rental_annual_increase'] );
            $resp['data']['rental_percent_accrued'] = floatval( $resp['data']['rental_percent_accrued'] );
            $resp['data']['rental_installments'] = intval( $resp['data']['rental_installments'] );
            $resp['data']['rental_refund_period'] = intval( $resp['data']['rental_refund_period'] );
            $resp['data']['rental_grace_period'] = intval( $resp['data']['rental_grace_period'] );
            $resp['data']['mp_private'] = boolval( $resp['data']['mp_private'] );
            $resp['data']['mp_portal_enabled'] = boolval( $resp['data']['mp_portal_enabled'] );
            $resp['data']['mp_adv_layout'] = boolval( $resp['data']['mp_adv_layout'] );
            $resp['data']['mp_contact_enabled'] = boolval( $resp['data']['mp_contact_enabled'] );
            $resp['data']['mp_social_enabled'] = boolval( $resp['data']['mp_social_enabled'] );
            $resp['data']['mp_stats_enabled'] = boolval( $resp['data']['mp_stats_enabled'] );
            return $resp['data'];
        }

        return false;

    }

    public static function Offer( $params ) {

        $params['offer_enabled'] = intval( $params['offer_enabled'] );

        $data = '{ "data": [' . json_encode( $params ) . '] }';

        $resp = HTTPclient::Post( 'domains/marketplace', $data );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function Delete( $domain ) {

        $params = [
            'domain' => $domain,
            'sale_price' => 0,
            'offer_enabled' => false,
            'min_offer' => 0
        ];
      
        return self::Offer( $params );

    }

  }