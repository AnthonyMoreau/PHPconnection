<?php 

    $_SESSION["errors"] = null;
    $_SESSION["auth"] = null;
        
    if(!empty($_POST["pseudo"]) and !empty($_POST["email"])){

        $pseudo = $_POST["pseudo"];
        $email = $_POST["email"];
        
        require "app/pdo/pdo.php";

        $req = $pdo->prepare("SELECT * FROM users WHERE pseudo= ? and email= ?");
        $req->execute([$pseudo, $email]);
        $result = $req->fetchAll();
        var_dump($result);

        if($result[0]->pseudo === $pseudo && $result[0]->email === $email){    

            session_start();
            $_SESSION["errors"] = "Vous êtes bien connecté !";
            var_dump($_SESSION["errors"]);

        } else {

            $_SESSION["errors"] = "Votre pseudo ou votre email ne semble pas valide";

        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
</head>
<body>
    <div class="container">
    <h2>se Connecter</h2>
        <form action="#" method="post">
            <p>
                <label for="pseudo">Pseudo</label>
            </p>
            <p>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" style="width: 250px;">
            </p>
            <p>
                <label for="email">Email</label>
            </p>
            <p>
                <input type="email" name="email" id="email" placeholder="Email" style="width: 250px;">    
            </p>
            <p>
                <input type="submit" value="Envoyer">
            </p>
        </form>
        <p>
            <!-- affichages des erreurs client -->
            <?php 
                echo $_SESSION["errors"];
            ?>
        </p>
    </div>
    <a href="index.php">retour</a>
</body>
</html>