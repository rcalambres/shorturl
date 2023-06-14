<?php

namespace ShortUrls\Application\Auth;

use ShortUrls\Application\Base\Interfaces\AuthenticationService;
use ShortUrls\Application\Domain\Stack\ParenthesisStack;
use ShortUrls\Domain\Stack\Exceptions\InvalidParenthesisStackFormatException;

class AuthService implements AuthenticationService
{
    public function auth(string|null $bearer): bool
    {
        try{
            $parenthesisStack = new ParenthesisStack($bearer);
            return $parenthesisStack->validate();
        }catch(InvalidParenthesisStackFormatException $invalidException){
            return false;
        }catch(\Throwable $t){
            return false;
        }
    }
}
