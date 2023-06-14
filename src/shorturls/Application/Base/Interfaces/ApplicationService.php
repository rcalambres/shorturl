<?php

namespace ShortUrls\Application\Base\Interfaces;

interface ApplicationService
{
    public function execute(ApplicationRequest $request) : ApplicationResponse;
}
