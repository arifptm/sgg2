<?php

namespace App\Imagecache;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Tiny implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(40, 40);
    }
}