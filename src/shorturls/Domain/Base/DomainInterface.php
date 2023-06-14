<?php

namespace BeersSeller\Domain\Base;

interface DomainInterface
{
    public function search(array $filters): array;

    public function save(array $filters): array;
    
}
