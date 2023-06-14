<?php

namespace ShortUrls\Domain\Stack;

use ShortUrls\Domain\Stack\Exceptions\InvalidParenthesisStackFormatException;

class ParenthesisStack
{
    private array $stack = [];

    const VALID_CHARS = ['(' => ')'
                            , '{' => '}'
                            , '[' => ']'
                        ];
    public function __construct (
        private string $string = ''
    )
    {
        foreach(str_split($string) as $char){
            if (in_array($char, array_merge(array_keys(static::VALID_CHARS), array_values(static::VALID_CHARS)))){
                $this->stack[] = $char;
            }else{
                throw new InvalidParenthesisStackFormatException();
            }
        }
    }

    public function validate()
    {
        $openingCharsStack = [];

        $openingChars = array_keys(static::VALID_CHARS);
        $closingChars = array_values(static::VALID_CHARS);

        foreach($this->stack as $char){
            if (in_array($char, $openingChars)){
                $openingCharsStack[] = $char;
            }elseif (in_array($char, $closingChars)){
                if (count($openingCharsStack) == 0){
            		return false; // first element of closing
            	}
                if (static::VALID_CHARS[array_pop($openingCharsStack)] !== $char){
                    return false; // wrong order
                }
            }

        }

        return $openingCharsStack === [];
    }
}
