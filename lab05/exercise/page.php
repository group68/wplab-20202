<?php
    class Page
    {
        protected $page;
        protected $title;
        protected $year;
        protected $copyright;

        function __construct($title, $year, $copyright)
        {
            $this->page = "";
            $this->title = $title;
            $this->year = $year;
            $this->copyright = $copyright;
        }

        public function addContent($content)
        {
            $this->page = $this->page . $content;
        }

        public function get()
        {
            return
            "<!DOCTYPE html>
            <html lang=\"en\">
            <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js\"></script>

    <link rel=\"stylesheet\" href=\"main.css\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title> $this->title</title>
            </head>
            <body>
            <div class=\"container-fluid mt-20 h-100\">
        <div class=\"intro row\">
            <div class=\"bg-image h-100\">
                <div class=\"mask d-flex vertical-center align-items-center justify-content-center h-100\"
                    >
                    <div class=\"container mw-60 auto-margin \">
                        <div class=\"card mask-custom p-4 align-items-center justify-content-center\">
                            <div class=\"card-body auto-padding d-flex horizontal-center\">
            <header>
                <h1>{$this->title}</h1>
            </header>
                {$this->page}
            <footer>
                <p>{$this->copyright} © {$this->year} All Rights Reserved</p>
            </footer>
            </body>
            </html>";
        }     
    }
?>