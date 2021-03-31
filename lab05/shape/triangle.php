<?php namespace shape;
    require_once "polygon.php";

    class Triangle extends Polygon
    {
        public $base;
        public $height;

        public function getArea()
        {
            return ($this->base * $this->height) / 2;
        }

        public function getNumberOfSides()
        {
            return 3;
        }
    }
?>