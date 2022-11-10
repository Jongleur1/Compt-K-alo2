<?php 
session_start();
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

    
    <div class="inscriptionpt2 box">
      
    
        <p>Bravo <?php 
         echo $_SESSION['user']['surname']?>,
Vous avez bientot fini l’inscription, il nous manque encore quelques informations (:</p>
    <button class="btn_debut"><a href="inscriptionpt3.php"> Suivant</a></button>
    </div>

    
</body>
</html>