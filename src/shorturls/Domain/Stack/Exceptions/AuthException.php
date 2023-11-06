<?php

namespace ShortUrls\Domain\Stack\Exceptions;
use Exception;

class AuthException extends Exception
{
    const MESSAGE = 'Auth Failure';
    
    public function __construct(){
        parent::__construct(static::MESSAGE);
    }
}