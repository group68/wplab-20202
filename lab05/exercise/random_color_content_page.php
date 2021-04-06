<?php
    require_once "./page.php";

    class RandomColorContentPage extends Page
    {
        private function randomColor()
        {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        public function addContent($content)
        {
            $rColor = $this->randomColor();

            parent::addContent("<p style=\"background-color:$rColor\">$content</p>\n");
        }
    }
?>