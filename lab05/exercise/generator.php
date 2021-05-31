<?php
    require_once "./page.php";
    require_once "./list_content_page.php";
    require_once "./random_color_content_page.php";

    $title = $_POST["title"];
    $year = $_POST["year"];
    $copyright = $_POST["copyright"];
    $content = $_POST["content"];

    $page_type = $_POST["page_type"];

    $page = NULL;

    switch ($page_type)
    {
        case "plain":
            $page = new Page($title, $year, $copyright);
            break;
        case "list":
            $page = new ListContentPage($title, $year, $copyright);

            break;
        case "color":
            $page = new RandomColorContentPage($title, $year, $copyright);
            break;
        default:
            die("Invalid page type!");
            break;
    }

    $page->addContent($content);
    echo $page->get();
?>