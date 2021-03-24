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
 * Epik Whois API Class
 */
class Whois extends Epik {

    public static function Get( $domain ) {

        $resp = HTTPclient::Get( 'domains/' . $domain . '/whois' );

        if ( !self::IsError( $resp ) ) {
            
            return $resp['data'];

        }

        return false;

    }

    public static function Set( $domain, $params ) {

        if ( isset( $params['allContacts'] ) ) {

            $data['update_whois_info_payload'] = [
                "RORGANIZATION" => $params['allContacts']['organization'],
                "RNAME" => $params['allContacts']['name'],
                "REMAIL" => $params['allContacts']['email'],
                "RADDRESS" => $params['allContacts']['address'],
                "RCITY" => $params['allContacts']['city'],
                "RSTATE" => $params['allContacts']['state'],
                "RZIP" => $params['allContacts']['zip'],
                "RCOUNTRY" => $params['allContacts']['country'],
                "RCOUNTRYCODE" => $params['allContacts']['country_code'],
                "RPHONE" => $params['allContacts']['phone'],
                "AORGANIZATION" => $params['allContacts']['organization'],
                "ANAME" => $params['allContacts']['name'],
                "AEMAIL" => $params['allContacts']['email'],
                "AADDRESS" => $params['allContacts']['address'],
                "ACITY" => $params['allContacts']['city'],
                "ASTATE" => $params['allContacts']['state'],
                "AZIP" => $params['allContacts']['zip'],
                "ACOUNTRY" => $params['allContacts']['country'],
                "ACOUNTRYCODE" => $params['allContacts']['country_code'],
                "APHONE" => $params['allContacts']['phone'],
                "TORGANIZATION" => $params['allContacts']['organization'],
                "TNAME" => $params['allContacts']['name'],
                "TEMAIL" => $params['allContacts']['email'],
                "TADDRESS" => $params['allContacts']['address'],
                "TCITY" => $params['allContacts']['city'],
                "TSTATE" => $params['allContacts']['state'],
                "TZIP" => $params['allContacts']['zip'],
                "TCOUNTRY" => $params['allContacts']['country'],
                "TCOUNTRYCODE" => $params['allContacts']['country_code'],
                "TPHONE" => $params['allContacts']['phone'],
                "BORGANIZATION" => $params['allContacts']['organization'],
                "BNAME" => $params['allContacts']['name'],
                "BEMAIL" => $params['allContacts']['email'],
                "BADDRESS" => $params['allContacts']['address'],
                "BCITY" => $params['allContacts']['city'],
                "BSTATE" => $params['allContacts']['state'],
                "BZIP" => $params['allContacts']['zip'],
                "BCOUNTRY" => $params['allContacts']['country'],
                "BCOUNTRYCODE" => $params['allContacts']['country_code'],
                "BPHONE" => $params['allContacts']['phone']
            ];

        }else{

            $data['update_whois_info_payload'] = [
                "RORGANIZATION" => $params['ownerContact']['organization'],
                "RNAME" => $params['ownerContact']['name'],
                "REMAIL" => $params['ownerContact']['email'],
                "RADDRESS" => $params['ownerContact']['address'],
                "RCITY" => $params['ownerContact']['city'],
                "RSTATE" => $params['ownerContact']['state'],
                "RZIP" => $params['ownerContact']['zip'],
                "RCOUNTRY" => $params['ownerContact']['country'],
                "RCOUNTRYCODE" => $params['ownerContact']['country_code'],
                "RPHONE" => $params['ownerContact']['phone'],
                "AORGANIZATION" => $params['adminContact']['organization'],
                "ANAME" => $params['adminContact']['name'],
                "AEMAIL" => $params['adminContact']['email'],
                "AADDRESS" => $params['adminContact']['address'],
                "ACITY" => $params['adminContact']['city'],
                "ASTATE" => $params['adminContact']['state'],
                "AZIP" => $params['adminContact']['zip'],
                "ACOUNTRY" => $params['adminContact']['country'],
                "ACOUNTRYCODE" => $params['adminContact']['country_code'],
                "APHONE" => $params['adminContact']['phone'],
                "TORGANIZATION" => $params['techContact']['organization'],
                "TNAME" => $params['techContact']['name'],
                "TEMAIL" => $params['techContact']['email'],
                "TADDRESS" => $params['techContact']['address'],
                "TCITY" => $params['techContact']['city'],
                "TSTATE" => $params['techContact']['state'],
                "TZIP" => $params['techContact']['zip'],
                "TCOUNTRY" => $params['techContact']['country'],
                "TCOUNTRYCODE" => $params['techContact']['country_code'],
                "TPHONE" => $params['techContact']['phone'],
                "BORGANIZATION" => $params['billContact']['organization'],
                "BNAME" => $params['billContact']['name'],
                "BEMAIL" => $params['billContact']['email'],
                "BADDRESS" => $params['billContact']['address'],
                "BCITY" => $params['billContact']['city'],
                "BSTATE" => $params['billContact']['state'],
                "BZIP" => $params['billContact']['zip'],
                "BCOUNTRY" => $params['billContact']['country'],
                "BCOUNTRYCODE" => $params['billContact']['country_code'],
                "BPHONE" => $params['billContact']['phone']
            ];
        
        }
        
        $resp = HTTPclient::Put( 'domains/' . $domain . '/whois', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {

            return true;

        }

        return false;

    }

    public static function Privacy( $domain, $on = true ) {

        $resp = HTTPclient::Put( 'domains/' . $domain . '/whois_privacy', '{ "whoisPrivacyState": "' . intval( $on ) . '" }' );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

}