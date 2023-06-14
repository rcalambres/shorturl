<?php

namespace ShortUrls\Application\Base;

use ShortUrls\Application\Base\Interfaces\ApplicationService;
use ShortUrls\Application\Base\Interfaces\ApplicationResponse;
use ShortUrls\Application\Base\Interfaces\ApplicationRequest;

abstract class AbstractApplicationService implements ApplicationService
{
    abstract public function execute(ApplicationRequest $request) : ApplicationResponse;
}

