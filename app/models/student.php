<?php
/**
* Student Class
*/
class Student extends Model
{
  public $id;
  public $first_name;
  public $last_name;
  public $dob;
  public $gender;
  public $address_line_1;
  public $address_line_2;
  public $address_line_3;
  public $town_city;
  public $county;
  public $postcode;
  public $email;
  public $current_year_group;
  
  function __construct()
  {
    parent::__construct();
  }
  

}