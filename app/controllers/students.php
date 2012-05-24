<?php
/**
* 
*/
class Students extends Controller
{
  
  function __construct($view_path, $response_type)
  {
    parent::__construct($view_path, $response_type);
    $this->attr_accessible = array( 'first_name', 
                                    'last_name', 
                                    'dob', 
                                    'gender', 
                                    'address_line_1', 
                                    'address_line_2', 
                                    'address_line_3', 
                                    'town_city', 
                                    'county', 
                                    'postcode', 
                                    'email', 
                                    'current_year_group'
                                  );
  }
  
  public function set_resource($resource)
  {
    parent::set_resource($resource);
    
    if ($this->action == "create" || $this->action == "update") //Then this is the POST data
    {
      // need to sanitise the input here
      $student = new Student();
      if ($this->action == "update")
      {
        $student->find($_POST['id']);
      }
      foreach ($resource as $key => $value) {
        // check the key is safe for a start
        try{
          if (!in_array($key, $this->attr_accessible))
          {
            throw new Exception("Cannot set field");
          }
          $student->$key = $value;
        }
        catch (Exception $e) {
          $e->getMessage();
        }
      }
      $student->save();
      // now redirect
      header("Location: /students");
    }
  }
}