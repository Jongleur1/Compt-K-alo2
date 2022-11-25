<?php
session_start();
if (!isset($_SESSION['userTEST'])){
  header('Location: ../index.php');
  exit;
}
require "../conectbdd.php";

$sql="SELECT `date` , `nbr_klc` FROM `test` WHERE `email` = :user_email ORDER BY `date`";
$query = $base->prepare($sql);
$query->bindValue(":user_email",$_SESSION['userTEST']['email'], PDO::PARAM_STR);
$query->execute();
$data = $query->fetchAll();
$poidimc=$_SESSION['userTEST']['poids'];
$tailleimc= $_SESSION['userTEST']['taille']*0.01;
$imc= $poidimc / ($tailleimc*$tailleimc);
$imc= round($imc ,1);

if($imc <=16.5){
  $imc_result="c'est chaud la ";
}
elseif($imc<=18.5){
    $imc_result="Mange un peu ";
}
elseif($imc<=25){
    $imc_result="Tous vas bien";
}
elseif($imc<=30){
    $imc_result="Fait attention tu es en surpoids";

}
elseif($imc<=35){
  $imc_result="obésité simple";
}
elseif($imc<=40){
  $imc_result="obésité sévère";
}
elseif($imc>40){
  $imc_result="obésité massive";
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Mon graphique</title>
</head>
<body>
<div class="header_class_text header_class_text_graph">
  <div></div>
        <h1>COMPT'K'ALO</h1>
        <div class="btn_deconnexion">
        <a href="../deconnexion.php"><img src="../image/deconnexion.svg" alt=""></a>
        </div>
    </div>
<div class="legraph">
  <canvas id="myChart"></canvas>
</div>
<div class="imc_result">
<p>Votre IMC est de <?php echo $imc ?></p>
<p><?php echo $imc_result ?></p>
</div>
<footer><div class="container-nav">
    <div class="barre_nav">
        <div class="option1">
            <a href="mon_graph.php"><img src="../image/graph_plein.svg" alt="Mon graph"></a>
            <p>Mon graph</p>
        </div>
        <div class="option1">
        <a href="mon_suivie.php"> <img src="../image/pomme vide.svg" alt= "Mon suivie" ></a>
            <p>Mon suivie</p>
         </div>
         <div class="option1">
            <a href="mon_profil.php"><img src="../image/profil.svg" alt="Mon profil"></a>
            <p>Mon profil</p>
         </div>
    </div>
</div>  </footer>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  ctx.height = 500;
  new Chart(ctx, {
    type: 'bar',
    legend:false,
    data: {
      labels: ['<?= $data[0]['date']?>', '<?= $data[1]['date']?>', '<?= $data[2]['date']?>', '<?= $data[3]['date']?>', '<?= $data[4]['date']?>', '<?= $data[5]['date']?>','<?= $data[6]['date']?>','<?= $data[7]['date']?>','<?= $data[8]['date']?>','<?= $data[9]['date']?>'],
      datasets: [{
        backgroundColor: [          
        <?php  for ($i=0; $i < 10; $i++): ?>
              <?php  if($data[$i]['nbr_klc'] < 2300):?>
              "blue",
              <?php endif; ?>
              <?php  if($data[$i]['nbr_klc'] > 2701):?>
              "red",
              <?php endif; ?>
               <?php  if( $data[$i]['nbr_klc'] > 2301 &&  $data[$i]['nbr_klc'] <= 2700):?>
               "green",
             <?php endif; ?>
        <?php endfor; ?>
        
        ],
        label: 'Nbr de klc que tu ingurgites',
        data: ['<?= $data[0]['nbr_klc']?>', '<?= $data[1]['nbr_klc']?>', '<?= $data[2]['nbr_klc']?>', '<?= $data[3]['nbr_klc']?>', '<?= $data[4]['nbr_klc']?>', '<?= $data[5]['nbr_klc']?>','<?= $data[6]['nbr_klc']?>','<?= $data[7]['nbr_klc']?>','<?= $data[8]['nbr_klc']?>','<?= $data[9]['nbr_klc']?>'],
        borderWidth: 1,
        legend:false,
      }]
    },
    options: {
      plugins: { 
        legend: { display: false, },
       },
     maintainAspectRatio: false
    }
  });
</script>

 

 