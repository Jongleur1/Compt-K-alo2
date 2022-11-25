<!-- 
<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $_SESSION["error"] = [];
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "Adresse email ou mot de passe incorrect";
        }
        // if ($_SESSION["error"] === []) {
        //     if (!isset($_SESSION["force"])) {
        //         $_SESSION["force"] = 1;
        //     } else {
        //         $_SESSION["force"]++;
        //     }
        //     if($_SESSION["force"] > 10) {
        //         $_SESSION["error"] = ["Trop de tentatives de connexions échoués"];
        //     }
        //     if ($_SESSION["error"] === []) {
                require "conectbdd.php";
                echo 'test';
                $sql = "SELECT `Email` FROM `informations` WHERE Email = :email";
                
                $query = $db->prepare($sql);
                echo 'test';
                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query->execute();
                
                $user = $query->fetch();
                if (!$user) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                }
                else if(!password_verify($_POST["password"], $user["password"])) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                }
                
                if ($_SESSION["error"] === []) {
                    unset($_SESSION["force"]);
                header("Location: Acceuil_site.php");
                }
            }
        }
//     }
// }

$title = "Connexion";
require_once "conectbdd.php";
?>
//--------------------------------- AFFICHAGE HTML ---------------------------------//

<?php require_once("conectbdd.php"); ?>
<?php echo $contenu; ?>
 
<form method="post" action="">
    <label for="email">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br> <br>
         
    <label for="mdp">Mot de passe</label><br>
    <input type="text" id="mdp" name="mdp"><br><br>
 
     <input type="submit" value="Se connecter">
</form>
 
<?php require_once("conectbdd.php"); ?> -->
