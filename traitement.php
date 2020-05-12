<?php
session_start();
    if (isset($_POST['suivant'])) {
        echo "J'ai cliqué sur suivant </br>";
        echo $_POST['num_page'];
        if ($_POST['typreponse']=="simple") {
            if (!isset($_POST['radio'])) {
                 $val="";
            } else {
            $val=$_POST['radio'];
            }
            
            $_SESSION['reponses'][$_POST['num_page']]=$val;

          }elseif ($_POST['typreponse']=="multiple") {
            if (!isset($_POST['check'])) {
                $val=array();
           } else {
           $val=$_POST['check'];
           }
           
           $_SESSION['reponses'][$_POST['num_page']]=$val;
          }else{
            $_SESSION['reponses'][$_POST['num_page']]=$_POST['texte'];
          }
        $num_page=$_POST['num_page'];
        $num_page++;
          header("location:interface_joueur.php?page=$num_page");
    }
    

?>
