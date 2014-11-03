<?php

class MyClass
{
  public static $count=0;
  public $prop1 = "I'm a class property!";
 
  public function __construct()
  {
      echo 'The class "', __CLASS__, '" was initiated!<br />';
  }
 
  public function __destruct()
  {
      echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }
 
  public function __toString()
  {
      echo "Using the toString method: ";
      return $this->getProperty();
  }
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  protected function getProperty()
  {
      return $this->prop1 . "inside getProperty() <br />";
  }
    public static function plusOne() {
        echo "The count is " . ++self::$count . ".<br />";
}
}
 
class MyOtherClass extends MyClass
{
  public function __construct()
  {
      parent::__construct();
echo "A new constructor in " . __CLASS__ . ".<br />";
  }
 
  public function newMethod()
  {
      echo "From a new method in " . __CLASS__ . ".<br />";
  }
    public function callProtectedMethod()
    {
        return $this->getProperty();
    }
}
 
// Create a new object
$newobj = new MyOtherClass;
 
// Attempt to call a protected method
echo $newobj->callProtectedMethod();

do {
     MyClass::plusOne();
} while (MyClass::$count <10);
?>