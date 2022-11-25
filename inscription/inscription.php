<?php 
session_start();
if (isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'])&& !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['mdp'])&& !empty($_POST['mdp2'])){
        if($_POST['mdp'] !== $_POST['mdp2']) {
             $_SESSION['error'][]='met les même mdp ';
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'][]=' email invalide ';
          } 
          
        if($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
     
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $password = strip_tags($_POST['mdp']);
            $password = password_hash($_POST["mdp"], PASSWORD_ARGON2ID);
            $email = strip_tags($_POST['email']);
            
        
            require "../conectbdd.php";
            
            // $_SESSION['userTEST']=[
            //     "surname" => $surname,
            //     "email"=> $email
                
            //     // "age"=> $age,
            //     // "poids"=> $poids,
            //     // "taille"=>$taille
            // ];
            $sql = ("INSERT INTO `informations`(`Nom`, `Prenom`, `Email`, `Motdepasse`) VALUES (:user_nom,:user_surname,:user_email,:user_password)");
            $query = $base->prepare($sql);
            $query->bindValue(":user_nom",$name, PDO::PARAM_STR);
            $query->bindValue(":user_surname",$surname, PDO::PARAM_STR);
            $query->bindValue(":user_email",$email, PDO::PARAM_STR);
            $query->bindValue(":user_password",$password, PDO::PARAM_STR);
            $testmail = "SELECT * FROM `informations` WHERE Email=?";
            $stmt = $base->prepare($testmail);
            $stmt->execute([$email]);
            $user = $stmt->rowCount();
            if ($user > 0){
                $_SESSION['error'][]= 'email DEJA RENTRER MON REUF';
            }
            else{
                // $sqltest= ("INSERT INTO `test`(`Email`) VALUES (':user_email')");
                // $query1 = $base->prepare($sqltest);
                // $query1->bindValue(":user_email",$email, PDO::PARAM_STR);
                // $query1->execute( [
                //     ':user_email' => $email
                // ]);

                $_SESSION['userTEST']=[
                    "surname" => $surname,
                    "email"=> $email,
                    
                    
                    // "age"=> $age,
                    // "poids"=> $poids,
                    // "taille"=>$taille
                ];
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
        <p><a href="../index.php">Connexion</a></p>
        <p><u>Inscription</u></p>
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
            
        <div class="form__group field">

            <input type="text" class="form__field" placeholder="Nom" name="name">
            <label for="name" class="form__label"> Nom </label>
            
        </div>    

        <div class="form__group field">

            <input type="text" class="form__field" placeholder="Prénom" name="surname">
            <label for="surname" class="form__label"> Prénom </label>

        </div>

        <div class="form__group field">

            <input type="text" class="form__field" placeholder="Adresse email" name="email">
            <label for="email" class="form__label">Adresse email</label>
            
        </div>

        <div class="form__group field">

            <input type="password" class="form__field" placeholder="Mot de passe" name="mdp">
            <label for="mdp" class="form__label">Mot de passe</label>

        </div>


        <div class="form__group field">

            <input type="password" class="form__field" placeholder="Répeter le mdp" name="mdp2">
            <label for="mdp2" class="form__label">Répeter le mdp</label>

        </div>     

            
            <button type="submit" class="btn_debut"> Suivant </button>

        </form>
         

    </div>

    
</body>
</html>