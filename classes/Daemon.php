<?php

/**
 * Class Daemon
 */
class Daemon
{
    const URL = 'https://syn.su/testwork.php';
    const EMAIL_ERROR = 'admin@sequel.one';

    /** @var resource */
    private $ch = null;
    /** @var string */
    private $message = null;
    /** @var string */
    private $key = null;
    /** @var object */
    private $response = null;

    /**
     * Daemon constructor.
     */
    public function __construct( )
    {
        $this->init();
    }

    /**
     * Daemon destructor.
     */
    public function __destruct()
    {
        curl_close( $this->ch );
    }

    /**
     * @return bool - true успешно, false иначе
     */
    public function get()
    {
        $data = [ 'method' => 'get' ];
        $response = $this->send( $data );

        if ( isset( $response->response->message, $response->response->key ) ) {
            $this->message = $response->response->message;
            $this->key = $response->response->key;

            return true;
        }

        return false;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function update( $message )
    {
        $data = [
            'method' => 'update',
            'message' => $message
        ];
        $response = $this->send( $data );

        if ( $response !== null ) {
            $this->response = $response;
            return true;
        }

        return false;
    }

    /**
     * @return bool - true все хорошо, false иначе
     */
    public function isSuccess()
    {
        return isset( $this->response->response ) && $this->response->response === 'Success';
    }

    /**
     * @return null|string
     */
    public function getErrorCode()
    {
        return ( isset( $this->response->errorCode ) ? $this->response->errorCode : null );
    }

    /**
     * @return null|string
     */
    public function getErrorMessage()
    {
        return ( isset( $this->response->errorMessage ) ? $this->response->errorMessage : null );
    }

    /**
     * @return null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return null
     */
    public function getKey()
    {
        return $this->key;
    }

    private function init()
    {
        $this->ch = curl_init( self::URL );
    }

    /**
     * @param array $data
     * @return object|null
     */
    private function send( array $data )
    {
        curl_setopt( $this->ch, CURLOPT_POST, true );
        curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $this->ch, CURLOPT_POSTFIELDS, $data );

        $result = json_decode( curl_exec( $this->ch ) );
        if ( json_last_error() === JSON_ERROR_NONE ) {
            return $result;
        }

        return null;
    }
}
