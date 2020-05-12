<?php

$erreur=$erreurNbr='';
if (isset($_POST['btn'])) {
    // $_SESSION['control']=$_POST['number'];
    if (!empty($_POST['number'])) {
       $tab=array();
       $tab['nbrquestion']=$_POST['number'];
       if ($tab['nbrquestion']>=5) {
        $js=json_encode($tab,JSON_PRETTY_PRINT);
        file_put_contents('cinq_questions.json',$js);
       }
       else{
        echo '<span id="erreurNbr" style="color:red"> Mettez un nombre supérieur ou égal à 5</span>';
       }
    }
    
    $Json = file_get_contents("cinq_question.json");
    $tabl_Json=json_decode($Json,true);

}


//     if (!is_number($_POST['number']) || $_POST['number']<=0) {
//         echo '<span id="erreur" style="color:red">veuillez entrer un nombre</span>';
       
//     } elseif (is_number($_POST['number']) && $_POST['number']> 5) {
//         echo '<span id="erreurNbr" style="color:red">le nombre ne doit pas dépasser 5</span>';
        
//     } else {
//         $Tab_Json = json_decode(file_get_contents("cinq_question.json"), true);
        
        
//         $Tab = array(
//             // "questions" => $question,
//             // "points" => $point,
//             //  "typreponse" => $typrep,
//             // "reponses" => $reponses
//         );
//         $Tab_Json[] = $Tab;
//     $Tab_Json = json_encode($Tab_Json);
//     file_put_contents("cinq_question.json", $Tab_Json);
//     }
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
    <link rel="stylesheet" href="liste_des_questions.css">
</head>
<body>

<div class="white-right" id="content" >
<form action="" method="post" id="form-qcm">
      <div class="bord">
      <label for="" id="nombre">Nbre de questions/jeu</label>
      <input type="texte" class="number"id="" value="<?php echo $_SESSION['control']?>" error="error1" name="number">
      <button type="submit" class="ok" name="btn" id="">OK</button>
      </div>
      <div class="error" id="error1"></div>
      </form>
      <div class="bloc">
      
      <?php
$Tab_Json = json_decode(file_get_contents("question.json"), true);

//Voir l'existence de $_GET['page']
      if (isset($_GET['page'])) {
          $num_page = $_GET['page'];
      }else{
          $num_page=1;
      }

      $valeur__total = count( $Tab_Json);//taille du tableau qui a les questions
      $nbr_par_page = 5; //questions par pages à changer apres
      $nbr_pages = ceil($valeur__total / $nbr_par_page); //nbre de page
      $debut = ($num_page - 1) * $nbr_par_page;
      $fin = $debut + $nbr_par_page - 1;
      $Tab_Json = array_slice($Tab_Json, $debut,$nbr_par_page); //permet de scinder le tableau en parti à se documenter


foreach ($Tab_Json as $key => $value) {
            echo ($key),". ",$value['questions'],"</br>";
            if ($value['typreponse']=="simple") {
            foreach ($value['reponses']  as $val) {
                
                    echo "<input type='radio' name='radio_$key'/> ",$val['reponse'],"</br>";
                }
            }elseif ($value['typreponse']=="multiple") {
                foreach ($value['reponses']  as $val) {
                
                    echo "<input type='checkbox' name='check'/> ",$val['reponse'],"</br>";
                }
            }
            elseif ($value['typreponse']=="texte"){
                  
                    echo "<input type='texte' name='texte' readonly> </br>";
                }
            
            
   }

if ($num_page > 1){
    $precedent= $num_page - 1;
    echo '<a class="precedent"  href="QUIZ.php?section=list&page='.$precedent.'">PREVIOUS</a>';
}

if ($num_page != $nbr_pages){
    $suivant= $num_page + 1;
    echo '<a class="next" href="QUIZ.php?section=list&page='.$suivant.'">NEXT</a>';
}

?>
 </div>
</div>

<script>
 const inputs = document.getElementsByTagName("input");
        for (input of inputs) {
            input.addEventListener("keyup", function(e) {
                if (e.target.hasAttribute("error")) {
                    var idDivError = e.target.getAttribute("error");
                    document.getElementById(idDivError).innerText = ""
                }
            })
        }
        document.getElementById("form-qcm").addEventListener("submit", function(e) {
            const fields = document.getElementsByTagName("input");
            var error = false;
            for (field of fields) {
                if (field.hasAttribute("error")) {
                    var idDivError = field.getAttribute("error");
                    if (!field.value) {
                        document.getElementById(idDivError).innerText = " Ce champ est obligatoire"
                        error = true
                    }

                }
            }
            if (error) {
                e.preventDefault();

            }
            return false;
        })
</script>
</body>
</html>