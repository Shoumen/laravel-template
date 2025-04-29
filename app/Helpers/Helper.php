<?php

namespace App\Helpers;

use Illuminate\Routing\Route;

class Helper
{
    //get all route list
    function get_route_list()
    {
        //get all routes
        $routes = Route::getRoutes();
        $routeList = [];
        foreach ($routes as $route) {
            $routeName = explode('.', $route->getName());
            if (isset($routeName[1])) {
                $routeList[$routeName[0]][] = $routeName[1];
            }
        }
        //remove duplicate routes
        foreach ($routeList as $key => $value) {
            $routeList[$key] = array_unique($value);
        }
        // return response()->json($routeList);

        //remove unnecessary routes
        unset($routeList['login']);
        unset($routeList['logout']);
        unset($routeList['register']);
        unset($routeList['password']);
        unset($routeList['verification']);
        unset($routeList['password']);
        unset($routeList['user-profile-information']);
        unset($routeList['user-password']);
        unset($routeList['two-factor']);
        unset($routeList['profile']);
        unset($routeList['sanctum']);
        unset($routeList['livewire']);
        unset($routeList['ignition']);
        unset($routeList['store']);
        unset($routeList['get']);
        unset($routeList['expense-category']);
        unset($routeList['user-role']);

        //sort ascending
        ksort($routeList);

        //set all routes to false
        foreach ($routeList as $key => $value) {
            $routeList[$key] = array_fill_keys($value, false);
        }

        return $routeList;
    }
}