<?php

/**
 * Class Encrypt
 */
class Encrypt
{
    /**
     * @param string $string
     * @param string $key
     * @return string
     */
    public static function encode( $string, $key )
    {
        $string = self::xor( $string, $key );
        $string = base64_encode( $string );

        return $string;
    }

    /**
     * @param string $string
     * @param string $key
     * @return string
     */
    public static function decode( $string, $key )
    {
        $string = base64_decode( $string );
        $string = self::xor( $string, $key );

        return $string;
    }

    /**
     * @param string $string
     * @param string $key
     * @return string
     */
    private static function xor( $string, $key )
    {
        for ( $i = 0; $i < strlen( $string ); $i++ ) {
            $string[ $i ] = ( $string[ $i ] ^ $key[ $i % strlen( $key ) ] );
        }

        return $string;
    }
}
