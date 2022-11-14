<?php  
session_start();
$genre = $_POST['Genre'];
$taille = strip_tags($_POST["Taille"]);
$age = strip_tags($_POST["Age"]);
$poids = strip_tags($_POST["Poids"]);
$taille = (is_numeric($taille)) ? (int)$taille : 0;
$poids = (is_numeric($taille)) ? (int)$taille : 0;
$age = (is_numeric($taille)) ? (int)$taille : 0; 
if (isset($_POST) && !empty($_POST)){
    if (isset ($_POST['Genre'],$_POST['Age'],$_POST['Taille'], $_POST['Poids']) && !empty($_POST['Poids']) && !empty($_POST['Taille'])&& !empty($_POST['Age'])){
        if ($taille < 30 || $taille > 300 ){
            $_SESSION['error'][]='met une taille d humain';
        }
        if ($poids < 10  || $poids > 600 ){
            $_SESSION['error'][]='met un poids d humain sale camion ben';
        }
        if ($age < 0  || $age > 150 ){
            $_SESSION['error'][]='met un age detre humain la momie';
        }   
        // if ($genre == 0){
        //     $genre = "femme";
        // }
        // if ($genre == 1){
        //     $genre = "homme";
        // }
    }
    if($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
        require "conectbdd.php";
       $sql = "UPDATE `informations` SET `Sexe`=:user_sexe,`Age`=:user_age,`Taille`=:user_taille,`Poids`=:user_poids WHERE `email` =:user_email";
       $id= $_SESSION['user']['id'];
       // $sql="UPDATE `informations` SET `Sexe`=:user_sexe,`Age`=:user_age,`Taille`=:user_taille,`Poids`=:user_poids  WHERE `id` = :user_id";
            $query = $base->prepare($sql);
            $query->bindParam(":user_email",$_SESSION['email']);
            $query->bindParam(":user_sexe",$genre);
            $query->bindParam(":user_age",$age);
            $query->bindParam(":user_poids",$email);
            $query->bindParam(":user_taille",$password);
            $query->execute();
    }
}



if (isset ($_SESSION['error'])){
    foreach ($_SESSION['error'] as $message_erreur ) {
        echo $message_erreur;
    }
    unset($_SESSION['error']);
}
echo "Tu pretend etre:   grosse  folle de$genre"; 

var_dump($_SESSION);
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
        <form action="" method="post">
            <label for="Genre">Sexe</label>
            <label for="Genre">Femme</label>
            <input type="radio" name="Genre" value="0">
            <label for="Genre">Homme</label>
            <input type="radio" name="Genre" value="1">
            <label for="Age">Age</label>
            <input type="number" name="Age" min="0" max="150" required>
            <label for="Poids"> Poids</label>
            <input type="number" name="Poids" min="0" max="600" required >
            <label for="Taille">Taille (en cm)</label>
            <input type="text" name="Taille" min="0" max="300" required>
            
</br>
            
            <button type="submit" class="btn_debut">  Suivant</a></button>
            <a href="inscriptionfin.php">stbanananan</a>

        </form>
    </div>

    
</body>
</html>