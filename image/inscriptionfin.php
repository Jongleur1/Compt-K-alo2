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
        <p><a href="../index.php">Connexion</a></p>
        <p><u>Inscription</u></p>
    </div>
    

    
    <div class="inscriptionpt2 box">

        <div class="message_inscription">
    
        <p>Bravo <?php echo $_SESSION['userTEST']['surname'];
        var_dump($_SESSION['userTEST']);?></br>
Vous avez  fini l’inscription, </p>

        </div>

        <div>

    <button class="btn_debut"><a href="../Site/mon_profil.php"> Suivant</a></button>

        </div>

    </div>

    
</body>
</html>