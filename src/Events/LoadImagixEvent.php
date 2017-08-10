<?php

namespace Greg\AppImagix\Events;

use Greg\Imagix\Imagix;

class LoadImagixEvent
{
    private $imagix;

    public function __construct(Imagix $imagix)
    {
        $this->imagix = $imagix;
    }

    public function imagix(): Imagix
    {
        return $this->imagix;
    }
}
