<?php session_start();
if (!isset($_SESSION['userTEST'])){
    header('Location: ../index.php');
    exit;
  }

$modif_taille = strip_tags($_POST["modif_taille"]);
$modif_age = strip_tags($_POST["modif_age"]);
$modif_poids = strip_tags($_POST["modif_poids"]);
$modif_taille = (is_numeric($modif_taille)) ? (int)$modif_taille : 0;
$modif_poids = (is_numeric($modif_poids)) ? (int)$modif_poids : 0;
$modif_age = (is_numeric($modif_age)) ? (int)$modif_age : 0;

if (isset($_POST) && !empty($_POST)){
    if (isset ($_POST['modif_age'],$_POST['modif_taille'], $_POST['modif_poids']) && !empty($_POST['modif_poids']) && !empty($_POST['modif_taille'])&& !empty($_POST['modif_age'])){

        if ($modif_age < 0  || $modif_age > 150 ){
            $_SESSION['error'][]='met un age detre humain la momie';
        } 
        if ($modif_taille < 30 || $modif_taille > 300 ){
            $_SESSION['error'][]='met une taille d humain';
        }
        if ($modif_poids < 10  || $modif_poids > 600 ){
            $_SESSION['error'][]='met un poids d humain';
        }
    }   
         
    if ($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
        require "../conectbdd.php";
        $_SESSION['userTEST']=[
            "email"=> $_SESSION['userTEST']['email'],
            "age"=> $_SESSION['userTEST']['age'],
            "poids"=> $_SESSION['userTEST']['poids'],
            "taille"=> $_SESSION['userTEST']['taille'],
            "surname"=> $_SESSION['userTEST']['surname']
        ];
       $sqlmodif = "UPDATE `informations` SET `Age`=:user_age,`Taille`=:user_taille,`Poids`=:user_poids WHERE email = :user_email";
            $query = $base->prepare($sqlmodif);
            $query->bindValue(":user_email",$_SESSION['userTEST']['email'], PDO::PARAM_STR);
            $query->bindValue(":user_age",$modif_age, PDO::PARAM_INT);
            $query->bindValue(":user_taille",$modif_taille, PDO::PARAM_INT);
            $query->bindValue(":user_poids",$modif_poids, PDO::PARAM_INT);

            $_SESSION['userTEST']['age'] = $modif_age;
            $_SESSION['userTEST']['poids'] = $modif_poids;
            $_SESSION['userTEST']['taille'] = $modif_taille;

            $query->execute();
    }
}

if (isset ($_SESSION['error'])){
    foreach ($_SESSION['error'] as $message_erreur) {
        echo $message_erreur;
    }
    unset($_SESSION['error']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <script src="script.js" defer></script>
    <title>Profil</title>
</head>
<body>
    <div class="header_class_text">
        <div></div>
        <h1>COMPT'K'ALO</h1>
        <div class="btn_deconnexion">
        <a href="../deconnexion.php"><img src="../image/deconnexion.svg" alt=""></a>
        </div>
    </div>
    <!-- <div class="header_class_bar"></div> -->

    <img id="myImg" src="../image/lol.jpg" class="img_profile" >
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
        <p class="raviebeth">Ravie de vous revoir, <?php 
          echo $_SESSION['userTEST']['surname'];
         ?>!</p>
    </div>
    <div class="border_test"></div>
    <div class="informations">
        <ul>Vos informations :
            <li>Votre âge:       <?php echo$_SESSION['userTEST']['age'];?></li>
            <li>Votre poids:     <?php echo $_SESSION['userTEST']['poids'];?></li>
            <li>Votre taille:     <?php echo $_SESSION['userTEST']['taille'];?></li>
        </ul>
    </div>

    <div class="div_modif_param">

    <button class="modif_param">Modifiez vos paramétres</button>

    </div>

    <div class="change_param">
            
            <div class="valid_param">
            <form action="" method="post">

                <label for="modif_age" class="stbangroskebab">Age</label>
                <input type="number" name="modif_age" value=<?php echo $_SESSION['userTEST']['age'];?>>

                <label for="modif_poids">Poids</label>
                <input type="number" name="modif_poids" value=<?php echo $_SESSION['userTEST']['poids'];?>>

                <label for="modif_taille">Taille</label>
                <input type="number" name="modif_taille" value=<?php echo $_SESSION['userTEST']['taille'];?>>

                <!-- <div class="valid_param"> -->
                <button type="submit" class="btn_valid_param">Valider</button>
                <!-- </div> -->

            </form>
            </div>
    </div>

 
    

<footer> <div class="container-nav">
    <div class="barre_nav">
        <div class="option1">
            <a href="mon_graph.php"><img src="../image/graph vide.svg" alt="Mon graph"></a>
            <p>Mon graph</p>
        </div>
        <div class="option1">
        <a href="mon_suivie.php"> <img src="../image/pomme vide.svg" alt= "Mon suivie" ></a>
            <p>Mon suivie</p>
         </div>
         <div class="option1">
            <a href="mon_profil.php"><img src="../image/profil_plein.svg" alt="Mon profil"></a>
            <p>Mon profil</p>
         </div>
    </div> 
   </div>  </footer>
</body>
</html>