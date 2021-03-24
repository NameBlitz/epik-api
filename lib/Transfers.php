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
 * Epik Transfers API Class
 */
class Transfers extends Epik {

    public static function Start( $domain, $params ) {

        if ( !isset( $params['assignuserid'] ) ) {
            $params['assignuserid'] = 0;
        }

        if ( !isset( $params['period'] ) ) {
            $params['period'] = 1;
        }

        $data = [
            'AUTHCODE' => $params['authcode'],
            'ASSIGNUSERID' => $params['assignuserid'],
            'PERIOD' => $params['period']
        ];

        $resp = HTTPclient::Post( 'domains/' . $domain . '/transfers_in', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function Restart( $domain, $params ) {

        if ( !isset( $params['assignuserid'] ) ) {
            $params['assignuserid'] = 0;
        }

        if ( !isset( $params['period'] ) ) {
            $params['period'] = 1;
        }

        $data = [
            'AUTHCODE' => $params['authcode'],
            'ASSIGNUSERID' => $params['assignuserid'],
            'PERIOD' => $params['period']
        ];

        $resp = HTTPclient::Put( 'domains/' . $domain . '/transfers_in', json_encode( $data ) );

        if ( !self::IsError( $resp ) ) {
            return true;
        }

        return false;

    }

    public static function Status( $domain ) {
        
        $resp = HTTPclient::Get( 'domains/' . $domain . '/transfers_in' );

        if ( !self::IsError( $resp ) ) {
            $status = [
                'domain' => $domain,
                'status' => $resp['data']['transfers']['transfer_status'],
                'states' => []
            ];

            switch ( $resp['data']['transfers']['transfer_states']['Older Than 60 Days'] ) {
                case 'Domain is older than 60 days old':
                    $status['states']['60_days'] = true;
                break;
                default:
                    $status['states']['60_days'] = false;
            }

            switch ( $resp['data']['transfers']['transfer_states']['Lock Status'] ) {
                case 'Unlocked':
                    $status['states']['unlocked'] = true;
                break;
                default:
                    $status['states']['unlocked'] = false;
            }

            switch ( $resp['data']['transfers']['transfer_states']['Registrar Approve'] ) {
                case 'Confirmed':
                    $status['states']['registrar_approved'] = true;
                break;
                default:
                    $status['states']['registrar_approved'] = false;
            }

            switch ( $resp['data']['transfers']['transfer_states']['Valid authcode'] ) {
                case 'Confirmed':
                    $status['states']['valid_authcode'] = true;
                break;
                default:
                    $status['states']['valid_authcode'] = false;
            }

            switch ( $resp['data']['transfers']['transfer_states']['Ownership Approve'] ) {
                case 'Confirmed':
                    $status['states']['ownership_approved'] = true;
                break;
                default:
                    $status['states']['ownership_approved'] = false;
            }

            return $status;
        }

        return false;

    }

}