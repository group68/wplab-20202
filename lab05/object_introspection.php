<?php
    function get_methods($object)
    {
        $methods = get_class_methods(get_class($object));

        $parent_class = get_parent_class($object);
        if ($parent_class)
        {
            $parent_methods = get_class_methods($parent_class);
            $methods = array_diff($methods, $parent_methods);
        }

        return $methods;
    }

    function get_inherited_methods($object)
    {
        $methods = get_class_methods(get_class($object));

        $parent_class = get_parent_class($object);
        if ($parent_class)
        {
            $parent_methods = get_class_methods($parent_class);
            $methods = array_intersect($methods, $parent_methods);
        }

        return $methods;
    }

    function get_lineage($object)
    {
        $lineage = array();

        $parent_class = get_parent_class($object);
        if ($parent_class)
        {
            $parent_object = new $parent_class;

            $lineage = get_lineage($parent_object);
        }

        $lineage[] = get_class($object);

        return $lineage;
    }

    function get_child_classes($object)
    {
        $inspected_class = get_class($object);
        $classes = get_declared_classes();

        $children = array();

        foreach ($classes as $class)
        {
            if (substr($class, 0, 2) == '__')
            {
                continue;
            }

            if (get_parent_class($class) == $inspected_class)
            {
                $children[] = $class;
            }
        }

        return $children;
    }

    function print_object_info($object)
    {
        $class = get_class($object);
        echo "<h2>Class</h2>";
        echo "<p>$class</p>";

        echo "<h2>Inheritance</h2>";

        echo "<h3>Parents</h3>";
        $lineage = get_lineage($object);

        array_pop($lineage);

        echo count($lineage) ? ("<p>" . join(' -&gt; ', $lineage) . "</p>")
                             : "<i>None</i>";

        echo "<h3>Children</h3>";
        $children = get_child_classes($object);
        echo "<p>" . (count($children) ? join(", ", $children)
                                       : "<i>None</i>") . "</p>";

        echo "<h2>Methods</h2>";
        $methods = get_class_methods($class);
        $object_methods = get_methods($object);

        if (count($methods) == 0)
        {
            echo "<i>None</i><br/>";
        }
        else
        {
            echo "<p>Inherited methods are in <i>italics</i>.</p>";

            foreach ($methods as $method)
            {
                echo in_array($method, $object_methods) ? "<b>$method</b>(); <br/>"
                                                       : "<i>$method</i>(); <br/>";
            }
        }

        echo "<h2>Properties</h2>";
        $properties = get_class_vars($class);

        if (count($properties) == 0)
        {
            echo "<i>None</i>";
        }
        else
        {
            foreach (array_keys($properties) as $property)
            {
                echo "<b>\$$property</b> = " . $object->$property . "<br/>";
            }
        }

        echo "<br/>";
    }

    class A
    {
        var $foo = 'foo';
        var $bar = 'bar';
        var $baz = 17.0;

        function first_function() {}
        function second_function() {}
    }
    
    class B extends A
    {
        var $quux = false;

        function third_function() {}
    }

    class C extends B {}
    
    $a = new A;
    $a->foo = "sylvie";
    $a->bar = 23;

    $b = new B;
    $b->foo = "bruno";
    $b->quux = true;

    $c = new C;

    print_object_info($a);
    print_object_info($b);
    print_object_info($c);
?>