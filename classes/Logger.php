<?php

class Logger
{
    public static function log( $message )
    {
        echo date( 'd.m.Y H:i:s' ) . " {$message}\n";
    }
}
