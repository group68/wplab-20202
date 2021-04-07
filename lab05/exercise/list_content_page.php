<?php
    require_once "./page.php";

    class ListContentPage extends Page
    {
        public function addContent($content)
        {
            $content = explode("\n", $content);
            foreach ($content as $line)
            {
                parent::addContent("<li>$line</li>\n");
            }
        }

        public function get()
        {
            $this->page = "<ul>{$this->page}</ul>";

            return parent::get();
        }
    }
?>