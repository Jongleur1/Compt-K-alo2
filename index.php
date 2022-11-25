<?php 

session_start();
// if (isset($_SESSION["user"])) {
//     header("Location: index.php");
//     exit;
//}
require "conectbdd.php";
$sql="DELETE FROM `test` WHERE DATEDIFF(CURDATE(), `date`) > 10" ;
$query = $base->prepare($sql);
$query->execute();

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $_SESSION["error"] = [];
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "Adresse email ou mot de passe incorrect";
        } 
                require "conectbdd.php";
                $email = $_POST["email"];
                $sql = "SELECT * FROM `informations` WHERE Email = :user_email";
                
                $query = $base->prepare($sql);
                
                $query->bindValue(":user_email", $email, PDO::PARAM_STR);
                $query->execute();
                
                $user = $query->fetch();
                echo $user["Age"];
                if (!$user) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                    echo 'test1';
                    
                }
                elseif(!password_verify($_POST["password"], $user["Motdepasse"])) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrectfwvgbncghxfdxw";
                    echo 'test2';
                }
                
                if ($_SESSION["error"] === []) {
                    $_SESSION['userTEST']=[
                        "email"=> $user['Email'],
                        "surname" => $user["Prenom"],
                        "age"=> $user["Age"],
                        "poids"=> $user["Poids"],
                        "taille"=>$user["Taille"]
                    ];

                header("Location: Site/mon_profil.php");
                // echo "<pre>";
                // var_dump($user);
                // echo "</pre>";
                // echo 'test3';
                }
            }
        }

$title = "Connexion";
require_once "conectbdd.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription/style.css">
    <title>COMPT'K'ALO</title>
</head>
<body>
    <div class="choix_connexion_inscription">
        <p><u>Connexion</u></p>
        <p><a href="inscription/inscription.php">Inscription</a></p>
    </div>
    <div class="acceuil_titre">
        <h1 class="title-compt">COMPT'K'ALO</h1>
        <h2 class="under-title"><span style="color:#FF0000">Mange moins | Bouge plus</h2>
    </div>
    
    <div class="form_connexion">
        <form action="" method="post" >
        <?php 
    if (isset ($_SESSION['error'])){
        foreach ($_SESSION['error'] as $message_erreur ) {
            echo $message_erreur;
        }
        unset($_SESSION['error']);
    }
    
    
    ?>
            <div class="form__group field">

                <input type="email" class="form__field" placeholder="Adresse email" name="email">
                <label for="email" class="form__label"> Adresse email </label>

            </div>

            <div class="form__group field">

                <input type="password" class="form__field" placeholder="Mot de passe" name="password">
                <label for="mdp" class="form__label"> Mot de passe </label>
            
            </div>


            <p class="lost_mdp">Mot de passe oublié ?</p>

            <div>

            <button type="submit" class="btn_debut">CONNEXION</button>
            
            </div>
        </form>
    </div>

    
</body>
</html>
