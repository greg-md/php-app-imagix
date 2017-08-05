<?php

namespace Greg\AppStaticImage\Decorators;

use Greg\StaticImage\ImageDecoratorStrategy;
use Greg\Support\Str;

class BaseDecorator implements ImageDecoratorStrategy
{
    private $uriPath;

    public function __construct(string $uriPath)
    {
        $this->uriPath = $uriPath;
    }

    public function output($url)
    {
        return $this->uriPath . $url;
    }

    public function input($url)
    {
        return Str::shift($url, $this->uriPath);
    }
}