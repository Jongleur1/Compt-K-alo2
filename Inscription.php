<?php 
session_start();
require "conectbdd.php";
echo "<pre>";
var_dump($_POST);
echo "</pre>";
if (isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'])&& !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['mdp'])&& !empty($_POST['mdp2'])){
        if($_POST['mdp'] !== $_POST['mdp2']) {
            // $_SESSION['error'][]='met les même mdp fdp';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'][]='met email valide ';
          } 

        //email verify 
        if($_SESSION['error'] === []){
            unset($_SESSION['error']);
            //bdd
        }
        else { ?>
            <p class="cecicela"><?= $_SESSION['error'][0]?></p>
        <?php }
    }
}

?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>COMPT'K'ALO</title>
</head>
<body>
    <div class="choix_connexion_inscription">
        <p><a href="index.php">Connexion</a></p>
        <p>Inscription</p>
    </div>

    
    <div class="form_inscription box">
    <p class="cecicela"><?= $_SESSION['error'][0]?></p>
        <form action="" method="post">
            
            <label for="name">Name</label>
            <input type="text" name="name">
            <label for="surname">Surname</label>
            <input type="text" name="surname">
            <label for="email"> Email</label>
            <input type="email" name="email">
            <label for="mdp">Password</label>
            <input type="password" name="mdp">
            <label for="mdp2">Repeat password</label>
            <input type="password" name="mdp2">

            
            <button type="submit" class="btn_debut"> Suivant</a></button>
            <a href="inscriptionpt2.php"> 

        </form>
    </div>

    
</body>
</html>