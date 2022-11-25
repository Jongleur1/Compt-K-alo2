<?php 
session_start();
if (!isset($_SESSION['userTEST'])){
    header('Location: ../index.php');
    exit;
  }
// $email = $_SESSION['userTEST']['email'];
// require "../conectbdd.php";
// $sql = ("INSERT INTO `calories`(`email`) VALUES (:user_email)");
// $query = $base->prepare($sql);
// $query->bindValue(":user_email",$email, PDO::PARAM_STR);
// var_dump ($query);
// $query->execute();
// var_dump($_SESSION['userTEST']);

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

    
    <div class="inscriptionpt2 box">
      
        <div class="message_inscription">

        <p>Bravo <?php 
         echo $_SESSION['userTEST']['surname'];?>,</br>
Vous avez bientot fini l’inscription, il nous manque encore quelques informations (:</p>

        </div>
        <a href="inscriptionpt3.php"> 

        <div>
    <button class="btn_debut" type="submit">Suivant</button>
        </div>
        </a>
    </div>

    
</body>
</html>