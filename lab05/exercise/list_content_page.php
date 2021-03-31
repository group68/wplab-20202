<?php
    require_once "./page.php";

    class ListContentPage extends Page
    {
        public function addContent($content)
        {
            parent::addContent("<li>$content</li>\n");
        }

        public function get()
        {
            $this->page = "<ul>{$this->page}</ul>";

            return parent::get();
        }
    }
?>