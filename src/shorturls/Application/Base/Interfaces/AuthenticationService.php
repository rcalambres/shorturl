<?php

namespace ShortUrls\Application\Base\Interfaces;

interface AuthenticationService
{
    public function auth(string|null $bearer): bool;
}