<?php 
$bdd_name = 'mysql:host=localhost;dbname=comptkalo';
$user = 'greta';
$pass = 'Greta1234!';
try {
    $base = new PDO(
        $bdd_name, 
        $user, 
        $pass
    );
} 
catch (PDOException $excep)
{
    echo "erreur connexion" . $excep->getMessage();
}




?>
