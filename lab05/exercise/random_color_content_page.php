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
            $content = explode("\n", $content);
            foreach ($content as $line)
            {
                $rColor = $this->randomColor();
                parent::addContent("<p style=\"background-color:$rColor\">$line</p>\n");
            }
        }
    }
?>