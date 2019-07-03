<?php

    if(session_start()){
        
        echo "Page_test";

    } else {
        $_SESSION["errors"][] = "Veuillez vous connectez pour acceder a cette page !";
        header("location: connection.php");
    }

    echo "<p><a href='index.php'>retour</a><p/>";