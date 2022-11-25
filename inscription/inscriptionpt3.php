<?php  
session_start();
echo "<pre>";
// var_dump ($_SESSION);
echo "</pre>";
$genre = $_POST['Genre'];
$taille = strip_tags($_POST["Taille"]);
$age = strip_tags($_POST["Age"]);
$poids = strip_tags($_POST["Poids"]);
$taille = (is_numeric($taille)) ? (int)$taille : 0;
$poids = (is_numeric($poids)) ? (int)$poids : 0;
$age = (is_numeric($age)) ? (int)$age : 0; 
if (isset($_POST) && !empty($_POST)){
    if (isset ($_POST['Genre'],$_POST['Age'],$_POST['Taille'], $_POST['Poids']) && !empty($_POST['Poids']) && !empty($_POST['Taille'])&& !empty($_POST['Age'])){
        
        if ($age < 0  || $age > 150 ){
            $_SESSION['error'][]='met un age detre humain la momie';
        } 
        if ($taille < 30 || $taille > 300 ){
            $_SESSION['error'][]='met une taille d humain';
        }
        if ($poids < 10  || $poids > 600 ){
            $_SESSION['error'][]='met un poids d humain';
        }
        
        // if ($genre == 0){
        //     $genre = "femme";
        // }
        // if ($genre == 1){
        //     $genre = "homme";
        // }
    }
    $surname = $_SESSION['userTEST']['surname'];
    
    if($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
        require "../conectbdd.php";
        $_SESSION['userTEST']=[
            "email"=> $_SESSION['userTEST']['email'],
            "surname"=>$surname,
            "age"=> $age,
            "poids"=> $poids,
            "taille"=>$taille
            
        ];
       $sql = "UPDATE `informations` SET `Sexe`=:user_sexe,`Age`=:user_age,`Taille`=:user_taille,`Poids`=:user_poids WHERE email = :user_email";
       
       // $sql="UPDATE `informations` SET `Sexe`=:user_sexe,`Age`=:user_age,`Taille`=:user_taille,`Poids`=:user_poids  WHERE `id` = :user_id";
            $query = $base->prepare($sql);
            $query->bindValue(":user_email",$_SESSION['userTEST']['email'], PDO::PARAM_STR);
            $query->bindValue(":user_sexe",$genre, PDO::PARAM_INT);
            $query->bindValue(":user_age",$age, PDO::PARAM_INT);
            $query->bindValue(":user_taille",$taille, PDO::PARAM_INT);
            $query->bindValue(":user_poids",$poids, PDO::PARAM_INT);
            $query->execute();
            header('Location: inscriptionfin.php');
    }
}



if (isset ($_SESSION['error'])){
    foreach ($_SESSION['error'] as $message_erreur ) {
        echo $message_erreur;
    }
    unset($_SESSION['error']);
}

?>











<!DOCTYPE html>
<html lang="en">
<head>
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
        <form action="" method="post">

            <div class="form__sexe">
            
            <label for="Genre" class="label_inscr">Femme</label>
            <input type="radio" name="Genre" value="0">
            <label for="Genre" class="label_inscr">Homme</label>
            <input type="radio" name="Genre" value="1">

            </div>

            <div class="form__group field">

            <input type="number" class="form__field" placeholder="Age" name="Age" min="0" max="150" required>
            <label for="Age" class="form__label">Age</label>

            </div>

            <div class="form__group field">

            <input type="number" class="form__field" placeholder="Poids" name="Poids" min="0" max="600" required >
            <label for="Poids" class="form__label">Poids</label>

            </div>

            <div class="form__group field">

            <input type="text" class="form__field" placeholder="Taille (en cm)" name="Taille" min="0" max="300" required>
            <label for="Taille" class="form__label">Taille (en cm)</label>

            </div>
            
</br>
            
            <button type="submit" class="btn_debut">Suivant</a></button>

        </form>
    </div>

    
</body>
</html>