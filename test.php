<?php

require_once __DIR__ . '/classes/Include.php';

Console::off();
require_once __DIR__ . '/classes/Logs.php';

$object = new Daemon();

if ( $object->get() ) {
    $message = Encrypt::encode( $object->getMessage(), $object->getKey() );

    while ( true ) {
        if ( $object->update( $message ) && $object->isSuccess() ) {
            Logger::log( 'Success' );
        } else {
            Logger::log( "Error #{$object->getErrorCode()}, message {$object->getErrorMessage()}" );
            
            $mail = new Mail(
                Daemon::EMAIL_ERROR,
                'Демон остановлен',
                "При работе демона возникла ошибка {$object->getErrorCode()}, сообщение {$object->getErrorMessage()}."
            );
            $mail->send();

            Logger::log( 'Работа демона завершена' );
            exit();
        }

        sleep( 3600 ); // Ограничение в 1 запрос каждый час
    }
}
