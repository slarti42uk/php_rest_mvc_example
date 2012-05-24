<?php
/**
* This is the basis for the controllers
*/
class Controller
{
  public $view_path;
  
  function __construct($view_path, $response_type)
  {
    $this->request_method = strtolower($_SERVER["REQUEST_METHOD"]);
    $this->view_path = $view_path;
    $this->response_type = $response_type;
  }
  
  public function set_resource($resource)
  {
    $this->resource = $resource;
  }
  
  public function set_action($action)
  {
    $this->action = $action;
  }
  
  
  public function render()
  {
    $resource = $this->resource;
    ob_start();
    switch ($this->action)
    {
      case "new": // then it's new
        require_once($this->view_path . "/new.php");
        break;
      case "index": // then it's the listing for all records
        require_once($this->view_path . "/index.php");
        break;
      case "read":
        require_once($this->view_path . "/show.php"); 
        break;
      case "edit":
        require_once($this->view_path . "/edit.php"); 
        break;
    }
    $output =  ob_get_contents();
    ob_end_clean();
    return $output;
  }
  
  public function renderJson()
  {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
    header('Content-type: application/json');
    ob_start();
    return json_encode($this->resource);
    $output =  ob_get_contents();
    ob_end_clean();
    return $output;
  }
}
