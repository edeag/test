<?php

use AppRouterRoute;
use srcControllerEntertainmentEntertainmentListController;
use srcControllerEntertainmentEntertainmentGetController;
use srcControllerAdminEntertainmentEntertainmentCreateController;
use srcControllerAdminEntertainmentEntertainmentUpdateController;
use srcControllerAdminEntertainmentEntertainmentDeleteController;

$routes = [];

// Public Routes
$routes[] = new Route('GET', '/entertainments', EntertainmentListController::class, 'start');
$routes[] = new Route('GET', '/entertainments/{id}', EntertainmentGetController::class, 'start');

// Admin Routes
$routes[] = new Route('GET', '/admin/entertainments', srcControllerAdminEntertainmentEntertainmentListController::class, 'start');
$routes[] = new Route('GET', '/admin/entertainments/create', EntertainmentCreateController::class, 'start');
$routes[] = new Route('POST', '/admin/entertainments/create', EntertainmentCreateController::class, 'start');
$routes[] = new Route('GET', '/admin/entertainments/edit/{id}', EntertainmentUpdateController::class, 'start');
$routes[] = new Route('POST', '/admin/entertainments/edit/{id}', EntertainmentUpdateController::class, 'start');
$routes[] = new Route('POST', '/admin/entertainments/delete/{id}', EntertainmentDeleteController::class, 'start');

return $routes;
<?php 

include_once "Route.php";
include_once "Router.php";

function startRouter(): Router 
{
    $routes = [];

    include_once "Routes/DomainRoutes.php";
    $routes = array_merge($routes, DomainRoutes::getRoutes());

    include_once "Routes/EntertainmentRoutes.php";
    $routes = array_merge($routes, EntertainmentRoutes::getRoutes());

    include_once "Routes/AdminRoutes.php";
    $routes = array_merge($routes, AdminRoutes::getRoutes());

    $routesClass = [];
    foreach ($routes as $route) {
        $routesClass[] = Route::fromArray($route);
    }

    return new Router($routesClass);
}