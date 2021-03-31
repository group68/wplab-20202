<?php
    require_once "./list_content_page.php";

    $listContentPage = new ListContentPage("Pets", 2021, "Web Programming");

    $pets = array("Cat", "Dog", "Bird", "Rabbit", "Fish");

    foreach ($pets as $pet)
    {
        $listContentPage->addContent($pet);
    }

    echo $listContentPage->get();
?>