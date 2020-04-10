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
    $configDist = __DIR__ . "/../app/dist-my-config.php";
    spl_autoload_register("App::loadClass");
    Install::setup($configDist, $configFile);
}

