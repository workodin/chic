<?php

$configFile = __DIR__ . "/../app/my-config.php";

require_once __DIR__ . "/../php/class/App.php";

if (is_file($configFile))
{
    require_once $configFile;
    App::start();
}
else
{
    spl_autoload_register("App::loadClass");

    $configDist = __DIR__ . "/../app/dist-my-config.php";
    require_once $configDist;

    Install::setup();

    // https://www.php.net/manual/fr/function.copy
    copy($configDist, $configFile);
}

