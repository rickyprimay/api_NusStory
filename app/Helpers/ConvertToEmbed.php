<?php

namespace App\Helpers;

class ConvertToEmbed
{
    public static function youtube($url)
    {
        $videoId = null;
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }
        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : $url;
    }
}
