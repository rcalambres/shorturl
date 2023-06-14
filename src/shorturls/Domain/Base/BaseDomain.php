<?php

namespace ShortUrls\Domain\Base;

use ReflectionClass;

abstract class BaseDomain
{

    public function getElement(): array
    {
        $element = [];
        $reflector = new ReflectionClass($this);
        $properties = $reflector->getProperties();

        $index = null;
        $values = [];
        //Now go through the $properties array and populate each property
        foreach($properties as $property)
        {
            if ('id' === $property->getName()){
                $index = $this->{$property->getName()};
            }else{
                $values[$property->getName()] = $this->{$property->getName()};
            }
            
        }
        $element[$index] = $values;

        return $element;
    }
}