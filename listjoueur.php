<?php

     $json= file_get_contents('fichier.json');
     $decode= json_decode($json,true);
     $tabuser=[];
foreach($decode as $value){
    if($value['role']=="joueur"){
        $tab[]=$value;
    }
}
$num_page=0;
$valeur__total = count( $tab);
$nbr_par_page = 15;
$nbr_pages = ceil($valeur__total / $nbr_par_page);
if (isset($_GET['page'])) {
    $num_page = $_GET['page'];
}else{
    $num_page=1;
}
//tri la colonne score par odre décroissant
$columns=array_column($tab,"score");
array_multisort($columns, SORT_DESC, $tab);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
    <link rel="stylesheet" href="listjoueur.css">
</head>
<body>
<div class="white-right" id="content" >
<div class="bord">
    <h2>Liste des joueurs</h2>
</div>
<div class="bloc">
    <?php
   
    //pagination
    $debut = ($num_page - 1) * $nbr_par_page;
    $fin = $debut + $nbr_par_page - 1;
    echo' <table >';
    echo'<tr>';
    echo' <th>Prenom</th>';
    echo '<th>Nom</th>';
    echo '<th>Score</th>';
    echo '</tr>';

    echo '<br><br>';
    for ($i=$debut; $i<=$fin; $i++){
        if (array_key_exists($i, $tab)) {
            echo '<tr>';
                echo '<td>' . $tab[$i]['prenom'] . '</td>';
                echo '<td>' . $tab[$i]['nom'] . '</td>';
                echo '<td>' . $tab[$i]['score'] . ' pts</td>';
                echo '</tr>';
        }
    
    }
    echo '</table>';
    echo '<div class="div">';
    if ($num_page > 1){
        $precedent= $num_page - 1;
        echo '<a class="precedent"  href="QUIZ.php?section=joueurst&page='.$precedent.'">PREVIOUS</a>';
    }

    if ($num_page != $nbr_pages){
        $suivant= $num_page + 1;
        echo '<a class="next" href="QUIZ.php?section=joueurs&page='.$suivant.'">NEXT</a>';
    }
    echo '</div>';

    ?>
   
</div>
</div>
</body>
</html>
<input type="text" class="champ" id="row_0">
             <button type="button" class="bouton-green" onclick="onAddInput()"> <img src="Images/ic-ajout-réponse.png" alt=""></button>
                </div>
                <div class="row" >
                <!-- <input type="text" class="champ-deux">
             <button type="button" class="bouton-red" >x</button>
                </div> -->
               </div>
      
      <!-- <div class="numreponse">
          
              <h2>Réponse</h2>
                <textarea name="" id="réponse" cols="30" rows="10"></textarea>
                <input type="radio" name="" class="radio">
                <input type="checkbox"  class="checkbox">
                <img src="Images/ic-supprimer.png" alt="">
                <button class="enregistrer">ENREGISTRER</button>
          </div> -->
      </div>
      </div>
</div>
