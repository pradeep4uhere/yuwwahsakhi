<?php 
namespace App\Utilities;

use Carbon\Carbon;

class CustomCarbon extends Carbon
{
    public static function createFromTimestamp(int|float $timestamp, ?string $tz = null): static
    {
        return parent::createFromTimestamp($timestamp, $tz);
    }
}
