<?php

namespace ShortUrls\Domain\Stack\Exceptions;
use Exception;

class InvalidParenthesisStackFormatException extends Exception
{
    const MESSAGE = 'String not valid: Chars allowed (,[,{,},],)';
    
    public function __construct(){
        parent::__construct(static::MESSAGE);
    }
}