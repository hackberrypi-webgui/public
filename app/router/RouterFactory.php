<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

class RouterFactory {

    use Nette\StaticClass;

    /**
     * @return Nette\Application\IRouter
     */
    public static function createRouter() {
        $router = new RouteList;
        // definování konstant
        define('__APPDIR__',__DIR__."/../");
        define('__WWWDIR__',__DIR__."/../../www");


        $project = new RouteList('Wifi');
        $project [] = new Route('wifi/<presenter>/<action>[/<id>]', 'WifiList:default');
        $router[] = $project ;
        
        $project = new RouteList('Codegenerator');
        $project [] = new Route('codegenerator/<presenter>/<action>[/<id>]', 'Homepage:default');
        $router[] = $project ;

        $homepage = new RouteList('Homepage');
        $homepage[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
        $router[] = $homepage;

        return $router;
    }

}
