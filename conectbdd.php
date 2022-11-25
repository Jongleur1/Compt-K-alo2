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
    $base->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
catch (PDOException $excep)
{
    echo "erreur connexion" . $excep->getMessage();
}




?>
