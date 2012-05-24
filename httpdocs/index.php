<?php
/**
 * This is intended to be the bootstrap file for a very simple MVC pattern implementation
 * This should provide a simple REST api and respond to GET, POST, PUT and DELETE. 
 * It should also optionally detect and serve JSON for the resource.
 *
 * @author Steve Kingsley
 */
ini_set("display_errors", true);
// var_dump($_SERVER);

include ("../app/config.php");
include ("../app/lib/db.php");
include ("../app/lib/model.php");
include ("../app/lib/controller.php");
include ("../app/lib/helper.php");
include ("../app/lib/request.php");

// I'm using mod_rewrite to deal with routing and this array gives the allowed routes in the form of regex
$routes = array('students' => array(
  '/\/(students)\/([0-9]+)\/(edit)/',
  '/\/(students)\/([0-9]+)\/(update)/',
  '/\/(students)\/([0-9]+)/',
  '/\/(students)\/(create)/',
  '/\/(students)\/(new)/'
));

$request = new Request($routes);
$resource = $request->get_resource();
$model = $request->get_model();

$response_type = $request->get_response_type();

require_once ("../app/models/" . strtolower($model) . ".php"); // load in the model
require_once ("../app/controllers/" . strtolower($resource) . ".php"); // load in the controller

$controller = new $resource("../app/views/" . strtolower($resource) . "/", $response_type);
$instance = new $model();

$route = $request->get_route();
// echo $route['action'];
$controller->set_action($route['action']);
switch($route['action']){
  case 'index':
    $collection = $instance->all();
    $controller->set_resource($collection);
    break;
  case 'new':
    $controller->set_resource($instance);
    break;
  case 'create':
    $controller->set_resource($_POST);
    break;
  case 'read':
    $single = $instance->find($route['data']);
    $controller->set_resource($single);
    break;
  case 'edit':
    $single = $instance->find($route['data']);
    $controller->set_resource($single);
    break;
  case 'update':
    $controller->set_resource($_POST);
    break;
  case 'delete':
    break;
  default:
    header("HTTP/1.0 404 Not Found");
    exit("Resource not found");
    
}

switch ($response_type)
{
  case 'html':
    $body = $controller->render();
    require_once("../app/views/layouts/application.php");
    break;
  case 'json':
    echo $controller->renderJson();
    break;
}

?>