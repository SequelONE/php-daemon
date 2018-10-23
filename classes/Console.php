<?php

/**
 * Class Console
 */
class Console {

    public function off() {
        
        $child_pid = pcntl_fork();
        if ( $child_pid ) {
            exit();
        }
        posix_setsid();
        
    }

}