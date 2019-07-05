<?php
    $pattern_pseudo = '/[a-zéèàêûîôëöïüçâA-Z0-9]+/';
    $_SESSION["error"] = null;
    if(!empty($_POST)){
        session_start();
        if(!empty($_POST["pseudo"]) and !empty($_POST["email"])){

            $pseudo = $_POST["pseudo"];
            $email = $_POST["email"];
            
            preg_match($pattern_pseudo, $_POST["pseudo"], $match);
            $verif_mail = filter_var($email, FILTER_VALIDATE_EMAIL);
            
            if($match[0] === $pseudo && $verif_mail === $email){

                require_once "app/pdo/pdo.php";
                
                //VERIFICATION EMAIL----------
                $verif = $pdo->prepare("SELECT * FROM users WHERE email= ?");
                $test = $verif->execute([$email]);
                $verif_email = $verif->fetchAll();
                if($verif_email[0]->email != null){

                    $_SESSION["errors"] = "Dsl, cet email est déjà inscrit, Veuillez utiliser une autre adresse mail !";

                } else {
                    //INSCRIPTION----------
                    $req = $pdo->prepare("INSERT INTO users SET pseudo= ?, email= ?");
                    $req->execute([$pseudo, $email]);
                    $_SESSION["errors"] = "Merci pour votre inscription !";
                }

            } else {
                $_SESSION["errors"] = "Votre pseudo ou votre email ne semble pas valide !";
            }
        } else {

            $_SESSION["errors"] = "Pour vous inscrire, veuillez remplir tous les champs !";
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
    <h2>S'inscrire</h2>
        <form action="#" method="post">
            <p>
                <label for="pseudo">Pseudo</label>
            </p>
            <p>
                <input type="text" name="pseudo" id="pseudo" placeholder="exemple: Jean12" style="width: 250px;">
            </p>
            <p>
                <label for="email">Email</label>
            </p>
            <p>
                <input type="email" name="email" id="email" placeholder="exemple: bernard@gmail.com" style="width: 250px;">    
            </p>
            <p>
                <input type="submit" value="Envoyer">
            </p>
        </form>
        <p>
            <!-- affichages des erreurs au client -->
            <?php 
                foreach($_SESSION["errors"] as $error){
                    echo $error;
                }
            ?>
        </p>
    </div>
    <a href="index.php">retour</a>
</body>
</html>