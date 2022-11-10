<?php 
session_start();
if (isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'])&& !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['mdp'])&& !empty($_POST['mdp2'])){
        if($_POST['mdp'] !== $_POST['mdp2']) {
             $_SESSION['error'][]='met les même mdp fdp';
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'][]=' email invalide ';
          } 
          
        if($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
     
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $_SESSION['user']['surname']= $surname;
            $password = strip_tags($_POST['mdp']);
            $email = strip_tags($_POST['email']);
            require "conectbdd.php";
            $sql = "INSERT INTO `informations`(`Nom`, `Prenom`, `Email`, `Motdepasse`) VALUES (:user_nom,:user_surname,:user_email,:user_password)";
            $query = $base->prepare($sql);
            $query->bindValue(":user_nom",$name, PDO::PARAM_STR);
            $query->bindValue(":user_surname",$surname, PDO::PARAM_STR);
            $query->bindValue(":user_email",$email, PDO::PARAM_STR);
            $query->bindValue(":user_password",$password, PDO::PARAM_STR);
            $testmail = "SELECT * FROM `test` WHERE Email=?";
            $stmt = $base->prepare($testmail);
            $stmt->execute([$email]); 
            $user = $stmt->rowCount();
            if ($user > 0){
                $_SESSION['error'][]= 'email DEJA RENTRER MON REUF';
            }
            else{
                $query->execute();
                header('Location: inscriptionpt2.php');
            }
            


        
        }   
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

    <?php 
    if (isset ($_SESSION['error'])){
        foreach ($_SESSION['error'] as $message_erreur ) {
            echo $message_erreur;
        }
        unset($_SESSION['error']);
    }
    
    
    ?>


        <form action="" method="post">
            
            <label for="name">Name</label>
            <input type="text" name="name">
            <label for="surname">Surname</label>
            <input type="text" name="surname">
            <label for="email"> Email</label>
            <input type="text" name="email">
            <label for="mdp">Password</label>
            <input type="password" name="mdp">
            <label for="mdp2">Repeat password</label>
            <input type="password" name="mdp2">

            
            <button type="submit" class="btn_debut"> Suivant</a></button>

        </form>
        <a href="inscriptionpt2.php">dfgh</a> 

    </div>

    
</body>
</html>