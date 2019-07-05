
<?php

    session_start();

    if($_SESSION["auth"] === "logged"){
        
        echo "Page_test";

    } else {
        $_SESSION["errors"] = "Vous devez vous connecter pour accéder à cette page";
        header("location: connection.php");
    }
    if($_POST["deco"]){
        $_SESSION["auth"] = "deco";
        $_SESSION["errors"] = "Merci vous êtes deconnecté";
        header("location: connection.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="deco" id="deco" value="deconnect" hidden>
        <input type="submit" value="Se déconnecter">
    </form>
    <p><a href='index.php'>retour</a></p>
</body>
</html>
