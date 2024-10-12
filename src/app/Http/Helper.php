<?php

namespace App\Http;


class Helper {
    
    public static function intervalIntersect($start1, $end1, $start2, $end2)
    {
        return max($start1, $start2) < min($end1, $end2);
    }
}

  