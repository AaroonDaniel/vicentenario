<?php

namespace App\Helpers;

class VideoHelper
{
    public static function getYoutubeId($url)
    {
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([^\&\?\/]+)/', $url, $matches);
        return $matches[1] ?? null;
    }
}
