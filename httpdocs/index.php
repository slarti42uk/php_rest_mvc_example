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

// I'm using mod_rewrite to deal with routing 
$routes = array('students' => array(
  '/\/(students)\/([0-9]+)\/(edit)/',
  '/\/(students)\/([0-9]+)/',
  '/\/(students)\/(create)/',
  '/\/(students)\/(new)/'
));


$model = false;
$resource = false;
$uri_parts = explode("/", substr($_SERVER['REQUEST_URI'],1));
// var_dump($uri_parts[0]);
switch($uri_parts[0])
{
  case (preg_match('/students(?:.*)/', $uri_parts[0]) ? true : false):
    // var_dump($matches);
    $resource = 'Students';
    $model = "Student";
    break;
  default:
    header("HTTP/1.0 404 Not Found");
  
}

// check for the json file type in the request
$response_type = "html";
preg_match('/(?:\.+)(.*)/', $_SERVER['REQUEST_URI'], $matches);
if (count($matches) > 1)
{
  $response_type = $matches[1];
}

if ($model === false || $resource === false)
{
  header("HTTP/1.0 404 Not Found");
  exit("Resource not found");
}

$model_file = "../app/models/" . strtolower($model) . ".php";
$view_path = "../app/views/" . strtolower($resource) . "/";
$controller_file = "../app/controllers/" . strtolower($resource) . ".php";
require_once ($model_file); // load in the model
require_once ($controller_file); // load in the controller

$controller = new $resource($view_path, $response_type);
$instance = new $model();


// now to see if its the index listing being called or there is an id set
// $uri_parts[1] should contain the id of one record or new
// var_dump($uri_parts[1]);

// *********************************
// this needs sorting out. There is an issue with the route /students/1.json falling through to the else. We need to sort out the is_numeric bit
// *********************************
foreach ($routes[strtolower($resource)] as $pattern) {
  $matches = array();
  $route = preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);
  var_dump($matches);
  if ($route)
  {
    $route = $matches[0];
    break;
  }
}
echo $route;

if (isset($uri_parts[1]) && $uri_parts[1] == "new")
{
  $controller->set_resource($instance);
}
else if (isset($uri_parts[1]) && $uri_parts[1] == "create" && $_SERVER["REQUEST_METHOD"] == "POST")
{
  // $controller->set_resource(NULL);
  // var_dump($_SERVER);
  $controller->set_resource($_POST);
  // exit("create called");
}
else if (isset($uri_parts[1]) && is_numeric($uri_parts[1]))
{
  $single = $instance->find($uri_parts[1]);
  $controller->set_resource($single);

}
else if (!isset($uri_parts[1]) || empty($uri_parts[1])) // if it's not set then this must be the index for the resource
{
  $collection = $instance->all();
  $controller->set_resource($collection);
}
else
{
  header("HTTP/1.0 404 Not Found");
  exit("Resource not found");
  
}
// *********************************

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