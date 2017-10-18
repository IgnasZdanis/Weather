<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.10.18
 * Time: 21.13
 */

namespace Nfq\Weather;


class WeatherMath
{
    public function kelvinToCelsius(float $temperature):float{
        return $temperature-273.15;
    }

    public function kphToMps(float $speed):float {
        return $speed*1000/3600;
    }
}