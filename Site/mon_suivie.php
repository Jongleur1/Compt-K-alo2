<?php 
session_start();
if (!isset($_SESSION['userTEST'])){
    header('Location: ../index.php');
    exit;
  }

// $klc = strip_tags($_POST["how_many_calorie"]);
// $klc= (is_numeric($klc)) ? (int)$klc : 0;
// if (isset($_POST) && !empty($_POST)){
//     if(isset($_POST['last_meal'],$_POST['when_meal'],$_POST['how_many_calorie'])&& !empty($_POST['last_meal']) && !empty($_POST['when_meal']) && !empty($_POST['how_many_calorie'])){
//         $tenday = mktime(0, 0, 0, date("m")  , date("d")-10, date("Y"));
//          if($_POST['when_meal'] > $tenday && $_POST['when_meal'] < date){
//             $_SESSION['erroklc'][]="La DATE OH";
//          }
//          if($_POST['how_many_calorie']<0){
//              $_SESSION['erroklc'][]="LES KLC ONT A DIS";
//          }

//     if($_SESSION['error'] === [] || $_SESSION['error'] === NULL
$meal=$_POST['when_meal'];
$klc=$_POST['how_many_calorie'];

require "../conectbdd.php";
$base->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if(!empty($_POST)){
    // var_dump($_SESSION['userTEST']['email']);
    if(isset($_POST['when_meal'],$_POST['how_many_calorie']) && !empty($_POST['when_meal']) && !empty($_POST['how_many_calorie'])){
        $sqlVerifEmail = " SELECT * FROM `test` WHERE `email` = :email AND `date` = :datee ";
        $query = $base->prepare($sqlVerifEmail);
        $query->bindValue(":email",$_SESSION['userTEST']['email'], PDO::PARAM_STR);
        $query->bindValue(":datee",$meal, PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
        if(!empty($data)){
            $addKlc = $data["nbr_klc"] + $klc;
            $sql = "UPDATE `test` SET `nbr_klc` = :nbr_klc WHERE `email` = :email AND `date` = :datee";
            $query = $base->prepare($sql);
            $query->bindValue(":nbr_klc",$addKlc);
            $query->bindValue(":email",$_SESSION['userTEST']['email']);
            $query->bindValue(":datee",$meal);
            $query->execute();
        }
        else {
            $sql= "INSERT INTO `test`( `date`,`nbr_klc`,`email`) VALUES (:user_date,:user_nbr_klc,:user_email)";
            $query8 = $base->prepare($sql);
            $query8->bindValue(":user_date",$meal, PDO::PARAM_STR);
            $query8->bindValue(":user_nbr_klc",$klc, PDO::PARAM_INT);
            $query8->bindValue(":user_email",$_SESSION['userTEST']['email'], PDO::PARAM_STR);
            $query8->execute();
        }
        

    }
    

}
    // var_dump($today);
    $sql = "SELECT `date`, `nbr_klc` FROM `test` WHERE `email` = :email AND date >= DATE_ADD(CURDATE(), INTERVAL -10 DAY) AND date <= CURDATE() ORDER BY date";
    $query = $base->prepare($sql);
    $query->bindValue(":email",$_SESSION['userTEST']['email']);
    $query->execute();

    $data = $query->fetchAll();



?>



<script>
    //On empêche le refresh de la page d'ajouter des informations dans le formulaire et donc d'augmenter les calories//
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <script src="script2.js" defer></script>
    <title>Suivie</title>
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

    <div class="nbr_calorie">

        <form action="" method="post">


            <!-- <div class="meal"> -->

            <label for="when_meal">Date de ce repas ?</label>
            <input type="date"  id="date" name="when_meal" >

            <!-- </div> -->

            <!-- <div class="meal"> -->

            <label for="how_many_calorie">Le nombre de calorie ?</label>
            <input type="number" name="how_many_calorie">

            <!-- </div> -->

            <button type="submit" class="btn_suivie">Valider</button>

        </form>


    </div>

    <div class="border_test"></div>

    <div class="historique_calorie">

    <h3 class="h3_histo_calorie">Dernier repas enregistrer</h3>


    <table>

        <tr>
            <td>Date</td>
            <td>Nombre calories</td>
        </tr>

        <?php
        
        foreach ($data as $key) {
            ?>
            <tr>
                <td><?= $key["date"]; ?></td>
                <td><?= $key["nbr_klc"]; ?></td>
            </tr>
            <?php
        }

        ?>

    </table>

    </div>



<footer>
<div class="container-nav">
    <div class="barre_nav">
        <div class="option1">
            <a href="mon_graph.php"><img src="../image/graph vide.svg" alt="Mon graph"></a>
            <p>Mon graph</p>
        </div>
        <div class="option1">
        <a href="mon_suivie.php"> <img src="../image/pomme-pleine.svg" alt= "Mon suivie" ></a>
            <p>Mon suivie</p>
         </div>
         <div class="option1">
            <a href="mon_profil.php"><img src="../image/profil.svg" alt="Mon profil"></a>
            <p>Mon profil</p>
         </div>
    </div>
</div></footer>
    
</body>
</html>