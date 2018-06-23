<?php

class ServiceException extends Exception
{
    public function __construct($message)
    {
        if (is_null($message)) {
            return;
        }

        $this->message = $message;
    }
}