<?php

// get configuration
function config($path) {
    $keys = explode('.', $path);

    if (! file_exists($filename = ROOT . '/config/' . array_shift($keys) . '.php')) {
        return null;
    }

    $configs = require($filename);

    foreach ($keys as $key) {
        if (! isset($configs[$key])) {
            return null;
        }

        $configs = $configs[$key];
    }

    return $configs;
}

// random string
function randStr($len=5) {
    $str = '';

    for ($i=0; $i < $len; $i++) { 
        $str = $str . chr(rand(0, 255));
    }

    return $str;
}
