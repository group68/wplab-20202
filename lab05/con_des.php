<?php
    class BaseClass 
    {
        protected $name = "BaseClass";
        function __construct() 
        {
            print("In " . $this->name . " constructor<br>");
        }
        function __destruct()
        {
            print("Destroying " . $this->name . "<br>");
        }
    }

    class SubClass extends BaseClass
    {
        function __construct()
        {
            $this->name = "SubClass";
            parent::__construct();
        }
        function __destruct()
        {
            parent::__destruct();
        }
    }

    # After constructing SubClass and BaseClass, constructors are called.
    $obj1 = new SubClass();         # In SubClass constructor
    $obj2 = new BaseClass();        # In BaseClass constructor

    # At the end of this scope, destructors are called
    # Objects' destructors are called in LIFO order
    #
    # Destroying BaseClass
    # Destroying SubClass
?>