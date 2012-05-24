<?php
/**
* Request
*/
class Request
{

  private $resource_name = false;
  private $model_name = false;
  private $routes;
  private $route = array('action' => false, 'data' => false);
  
  public function __construct($routes)
  {
    $this->set_resource();
    $this->routes = $routes;
    $this->set_route();
    if ($this->model_name === false || $this->resource_name === false)
    {
      header("HTTP/1.0 404 Not Found");
      exit("Resource not found");
    }
  }
  
  public function set_method($method)
  {
    $this->method = $method;
  }
  

  
  public function set_resource()
  {
    $uri_parts = explode("/", substr($_SERVER['REQUEST_URI'],1));
    // var_dump($uri_parts);
    switch($uri_parts[0])
    {
      case (preg_match('/students(?:.*)/', $uri_parts[0]) ? true : false):
        $this->resource_name = 'Students';
        // echo $this->resource_name;
        $this->set_model(Helper::singular($this->resource_name));
        return $this->resource_name;
        break;
      default:
        return false;
    }
  }
  
  public function set_model($model)
  {
    $this->model_name = $model;
  }
  
  public function get_resource()
  {
    return $this->resource_name;
  }
  
  public function get_model()
  {
    return $this->model_name;
  }
  
  public function get_response_type()
  {
    // check for the json file type in the request
    $response_type = "html";
    preg_match('/(?:\.+)(.*)/', $_SERVER['REQUEST_URI'], $matches);
    if (count($matches) > 1)
    {
      $response_type = $matches[1];
    }
    return $response_type;
  }
  
  
  public function set_available_routes($routes)
  {
    $this->routes = $routes;
  }
  
  public function set_route()
  {
    var_dump($this->routes[strtolower($this->resource_name)]);
    foreach ($this->routes[strtolower($this->resource_name)] as $pattern) {
      $route = preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);
      if ($route)
      {
        // var_dump($matches);
        $route = $matches[0];
        break;
      }
    }
    // echo $route;
  
    switch(true) {
      case (isset($matches[2]) && $matches[2] == "new"):
        $this->route['action'] = "new";
        break;
      case (isset($matches[2]) && $matches[2] == "create" && strtolower($_SERVER["REQUEST_METHOD"]) == "post"):
        $this->route['action'] = "create";
        break;
      case (isset($matches[2]) && is_numeric($matches[2]) && isset($matches[3] ) && $matches[3] == 'edit'):  
        $this->route['action'] = "edit";
        $this->route['data'] = (int) $matches[2];
        break;
      case (isset($matches[2]) && is_numeric($matches[2]) && isset($matches[3] ) && $matches[3] == 'update'):  
        $this->route['action'] = "update";
        $this->route['data'] = (int) $matches[2];
        break;
      case (isset($matches[2]) && is_numeric($matches[2])):  
        $this->route['action'] = "read";
        $this->route['data'] = (int) $matches[2];
        break;
      default:
        $this->route['action'] = "index";
    }    
  }
  
  public function get_route()
  {
    return $this->route;
  }
  
  static function handle_request()
  {
    # code...
  }
  
  
}
