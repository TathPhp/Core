<?php
declare(strict_types=1);

namespace Tath\Core\Classes;

use Doctrine\Common\Collections\ArrayCollection;

class Collection extends \Illuminate\Support\Collection
{
    public static function make($items = [])
    {
        if ($items instanceof ArrayCollection) {
            return parent::make($items->toArray());
        }
        return parent::make($items);
    }
}
