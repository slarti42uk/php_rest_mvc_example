<?php 
/**
* Helpr class to use in the views
*/
class Helper
{
  static function humanise($value)
  {
    $str = str_replace('_', ' ', $value);
    $str = ucfirst($str);
    return $str;
  }
  
  
  static function pluralise($str)
  {
    # Very simple pluralisations
    if (substr($str, -1) == "s")
    {
      return $str;
    }
    else
    {
      return $str . "s";
    }
  }
}
