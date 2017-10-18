<?php
require_once __DIR__.'/vendor/autoload.php';

use Nfq\Weather\Location;
use Nfq\Weather\OpenWeatherMapWeatherProvider;
use Nfq\Weather\WundergroundWeatherProvider;
use Nfq\Weather\WeatherProviderInterface;
use Nfq\Weather\DelegatingWeatherProvider;
use Nfq\Weather\CachedWeatherProvider;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$openWeatherMapProvider = new OpenWeatherMapWeatherProvider();
$wundergroundWeatherProvider = new WundergroundWeatherProvider();
$delegatingWeatherProvider = new DelegatingWeatherProvider(
    [$openWeatherMapProvider, $wundergroundWeatherProvider]
);

$cache = new FilesystemAdapter();
$cachedWeatherProvider = new CachedWeatherProvider($delegatingWeatherProvider, $cache);

$vilnius = new Location(54.6872, 25.2797);

run($cachedWeatherProvider, $vilnius);
run($delegatingWeatherProvider, $vilnius);
run($openWeatherMapProvider, $vilnius);
run($wundergroundWeatherProvider, $vilnius);

function run(WeatherProviderInterface $provider, Location $location) {
    $weather = $provider->fetch($location);
    var_dump($weather);
}



