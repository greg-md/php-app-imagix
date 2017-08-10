<?php

namespace Greg\AppImagix\Decorators;

use Greg\Imagix\ImagixDecoratorStrategy;
use Greg\Support\Str;

class BaseDecorator implements ImagixDecoratorStrategy
{
    private $baseUri;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function output($url): string
    {
        return $this->baseUri . $url;
    }

    public function input($url): string
    {
        return Str::shift($url, $this->baseUri);
    }
}
