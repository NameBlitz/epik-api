<?php

/**
 * Copyright (C) 2020 NameBlitz
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Epik;

/**
 * Private methods to make CURL request to API Endpoints
 */
class HTTPclient extends Epik{

    public static function Get( $path, $data = [], $conc = '&', $useMPsig = false ) {

        $signature = self::$UserSignature;
        if ($useMPsig) {
            $signature = self::$MarketplaceSignature;
        }

        $query = array_merge( ['SIGNATURE' => $signature], $data );
        $url = self::$BaseURL . '/' . $path . '?'. http_build_query( $query, '', $conc );
        return self::HTTPrequest( $url, '', 'GET' );

    }

    public static function Post( $path, $data = null, $query_string = null, $useMPsig = false ) {

        $signature = self::$UserSignature;
        if ($useMPsig) {
            $signature = self::$MarketplaceSignature;
        }

        $url = self::$BaseURL . '/' . $path . '?SIGNATURE=' . $signature . '&' . $query_string;
        return self::HTTPrequest( $url, $data , 'POST' );
        
    }

    public static function Put( $path, $data = null ) {
        
        $signature = self::$UserSignature;
        $url = self::$BaseURL . '/' . $path . '?SIGNATURE=' . $signature;
        return self::HTTPrequest( $url, $data, 'PUT' );

    }

    public static function Patch( $path, $data = null ) {
        
        $signature = self::$UserSignature;
        $url = self::$BaseURL . '/' . $path . '?SIGNATURE=' . $signature;
        return self::HTTPrequest( $url, $data, 'PATCH' );

    }

    public static function Delete( $path, $data = [], $conc = '&', $useMPsig = false ) {

        $signature = self::$UserSignature;
        $body = null;
        
        if ($useMPsig) {
            $signature = self::$MarketplaceSignature;
        }

        if( !is_array( $data ) ){
            $body = $data;
            $data = [];
        }

        $query = array_merge( ['SIGNATURE' => $signature], $data );
        $url = self::$BaseURL . '/' . $path . '?'. http_build_query( $query, '', $conc );
        return self::HTTPrequest( $url, $body, 'DELETE' );

    }

    private static function HTTPrequest( $url, $data = null, $method ) {

        $headers = array( 'Content-Type: application/json' );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, $method );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
        $response = curl_exec( $curl );
        curl_close( $curl );
        return json_decode( $response, true );

    }
}