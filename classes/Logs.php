<?php

$baseDir = dirname(dirname( __FILE__ )) . '/logs';
ini_set( 'error_log', $baseDir . '/error.log' );
fclose( STDIN );
fclose( STDOUT );
fclose( STDERR );
$STDIN = fopen( '/dev/null', 'r' );
$STDOUT = fopen( $baseDir . '/success.log', 'ab' );
$STDERR = fopen( $baseDir . '/daemon.log', 'ab' );