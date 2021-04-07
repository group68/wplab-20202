<?php
    require_once "./random_color_content_page.php";

    $randomColorContentPage = new RandomColorContentPage("Random Color", 2021, "Web Programming");

    $pets = array("Cat", "Dog", "Bird", "Rabbit", "Fish");

    foreach ($pets as $pet)
    {
        $randomColorContentPage->addContent($pet);
    }

    echo $randomColorContentPage->get();
?>