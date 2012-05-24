<?php
/**
* Model
*
* This model class is intended to be used to inherit from for the simple model layer I'm using. 
* This is only intended to show a very simplified MVC pattern in the absence of a framework
*/
class Model
{
  private $db;
  
  function __construct()
  {
    $this->db = Database::connect();
  }
  
  public function __set($attribute, $value)
  {
    $method = "set_{$attribute}";
    if (property_exists($this, $attribute))
    {
      $this->$attribute = $value;
    }
  }
  
  public function find($id)
  {
    $id = mysql_real_escape_string($id);
    $sql = sprintf("SELECT * FROM %s WHERE id=%d", $this->get_table_name(), $id);
    // echo $sql;
    $rows = $this->select($sql);
    if ($rows != NULL)
    {
      $row = $rows[0];
      foreach ($row as $field => $value)
      {
        $this->$field = $value;
      }
      return $this;
    }
    else
    {
      return false;
    }
  }
  
  public function all()
  {
    $collection = array();
    $sql = sprintf("SELECT * FROM %s", $this->get_table_name());
    $rows = $this->select($sql);
    foreach ($rows as $row)
    {
      $class = get_class($this);
      $instance = new $class();
      foreach ($row as $field => $value)
      {
        $instance->$field = $value;
      }
      
      $collection[] = $instance;
    }
    // var_dump( $collection);
    return $collection;
  }
  
  public function save()
  {
    $sql = sprintf("INSERT INTO %s SET ", $this->get_table_name());
    $sep = '';
    foreach ($this as $key => $value) {
      if (is_string($key) && is_string($value))
      {
        $sql .= sprintf("{$sep}`%s` = '%s'", mysql_real_escape_string($key), mysql_real_escape_string($value));
        $sep = ', ';
      }
    }
    echo $sql;
    return $this->insert($sql);
  }
  
  private function get_table_name()
  {
    return strtolower(Helper::pluralise(get_class($this)));
  }
  
  private function insert($sql)
  {
    try {
      $result = mysql_query($sql);
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }
    return $result;
  }
  
  private function select($sql)
  {
    try {
      $result = mysql_query($sql);
      if (!$result)
      {
        throw new Exception("Error running query: ".$sql."");
      }
      else if (mysql_num_rows($result) == 0)
      {
        throw new Exception("No Record Found");
      }
      else
      {

        $rows = array();
        while ($row = mysql_fetch_assoc($result))
        {
          $rows[] = $row;
        }
        return $rows;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }
}