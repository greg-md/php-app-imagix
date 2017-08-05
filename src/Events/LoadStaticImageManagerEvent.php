<?php

namespace Greg\AppStaticImage\Events;

use Greg\StaticImage\StaticImageManager;

class LoadStaticImageManagerEvent
{
    private $manager;

    public function __construct(StaticImageManager $manager)
    {
        $this->manager = $manager;
    }

    public function manager(): StaticImageManager
    {
        return $this->manager;
    }
}