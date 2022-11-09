<?php 
$bdd_name = 'mysql:host=localhost;dbname=comptkalo';
$user = 'greta';
$password = 'Greta1234!';
$ident_user = $_POST['user_login'];
$mdp_user = $_POST['user_mdp'];

try {
    $base = new PDO(
        $bdd_name, 
        $user, 
        $password
    );
} 
catch (PDOException $excep)
{
    echo "erreur connexion" . $excep->getMessage();
}




?>
