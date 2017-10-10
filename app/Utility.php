<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    /**
     * @param $is_https
     * @param $host
     * @param $port
     * @return string
     */
    public static function buildUrl($is_https, $host, $port) {
        if ($is_https) {
            $protocol = "https";
        } else {
            $protocol = "http";
        }

        if (isset($port)) {
            $url = $protocol . "://" . $host. ":" . $port;
        } else {
            $url = $protocol . "://" . $host;
        }

        return $url;
    }
}
