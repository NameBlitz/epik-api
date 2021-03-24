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
 * Epik HostRecords API Class
 */
class HostRecords extends Epik {

    public static function Get( $domain ) {
        
        $resp = HTTPclient::Get( 'domains/' . $domain . '/records' );

        if ( !self::IsError( $resp ) ) {
            return $resp['data']['records'];
        }

        return false;

    }

    public static function Create( $domain, $params ) {

        $data['create_host_records_payload']['HOST'] = $params['host'];
        $data['create_host_records_payload']['TYPE'] = $params['type'];
        $data['create_host_records_payload']['DATA'] = $params['data'];
        $data['create_host_records_payload']['AUX'] = $params['aux'];
        $data['create_host_records_payload']['TTL'] = $params['ttl'];
        
        $resp = HTTPclient::Post( 'domains/' . $domain . '/records', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function Update( $domain, $params ) {

        $data['update_host_records_payload']['ID'] = $params['id'];
        $data['update_host_records_payload']['HOST'] = $params['host'];
        $data['update_host_records_payload']['TYPE'] = $params['type'];
        $data['update_host_records_payload']['DATA'] = $params['data'];
        $data['update_host_records_payload']['AUX'] = $params['aux'];
        $data['update_host_records_payload']['TTL'] = $params['ttl'];

        $resp = HTTPclient::Patch( 'domains/' . $domain . '/records', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;
        
    }

    public static function Delete( $domain, $id ) {

        $resp = HTTPclient::Delete( 'domains/' . $domain . '/records', ['ID' => $id] );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;
        
    }

}