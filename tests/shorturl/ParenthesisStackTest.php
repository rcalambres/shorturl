<?php

namespace ShortUrls\Tests\ShortUrl;
use PHPUnit\Framework\TestCase;
use ShortUrls\Domain\Stack\ParenthesisStack;

class ParenthesisStackTest extends TestCase
{
    public function testParenthesisStack(): void
    {
        /**
            - `{}` - `true`
            - `{}[]()` - `true`
            - `{([])}` - `true`
            - `{)` - `false`
            - `[{]}` - `false`
            - `(((((((()` - `false`
         */

        // Valids tokens
        $token = new ParenthesisStack('{}');
        $this->assertTrue($token->validate());

        $token = new ParenthesisStack('{}[]()');
        $this->assertTrue($token->validate());

        $token = new ParenthesisStack('{([])}');
        $this->assertTrue($token->validate());

        // invalid tokens
        $token = new ParenthesisStack('{)');
        $this->assertFalse($token->validate());

        $token = new ParenthesisStack('[{]}');
        $this->assertFalse($token->validate());

        $token = new ParenthesisStack('(((((((()');
        $this->assertFalse($token->validate());

    }
}
