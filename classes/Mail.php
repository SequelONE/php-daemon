<?php

/**
 * Class Mail
 */
class Mail
{
    /** @var string  */
    private $emailTo = null;
    /** @var string */
    private $subject = null;
    /** @var string */
    private $message = null;

    /**
     * Mail constructor.
     * @param string $emailTo
     * @param string $subject
     * @param string $message
     */
    public function __construct( $emailTo, $subject, $message )
    {
        $this->emailTo = $emailTo;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function send()
    {
        $headers = "Content-type: text/html; charset= UTF-8 \r\n" .
            "From: {$this->emailTo}\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail( $this->emailTo, $this->subject, $this->message, $headers );
    }
}
