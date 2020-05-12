<?php
session_start();
$avatar= $_SESSION['avatar'];
if (!isset($_SESSION['prenom'])){
    $_SESSION['msg']='Veuillez vous connecter d\'aboord';
    header('Location: index.php');
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="quiz.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="header">
    <div class="logo">
        <img src="Images/logo-QuizzSA.png" alt="">
    </div>

    <div class="header_title">
        <h3>Le plaisir de jouer</h3>
        <?php
        if(isset($_SESSION['message'])) {?>
            <p id="msg" style="color: red"><?=$_SESSION['message']?></p>

            <?php
            unset($_SESSION['message']);
             }
            ?>

    </div>
</div>
<div class="background">
    <div class="background_header">
    <div><h2 >CRÉER ET PARAMÉRTER VOS QUIZZ</h2>
        <a href="deconnexion.php"><button class="logout" type="submit">Déconnexion</button></a>
    </div>
    </div>
<div class="form">
    <div class="white">
        <div class="header_white">
            <div class="round">
            <div class="image">

                 <img  src="<?=$avatar?>" alt="">

            </div>
            </div>
            <div class="prenom_nom"><?=$_SESSION['prenom']?> <br> <span class="nom"><?=$_SESSION['nom']?></span></div>
        </div>
        <ul>
            <a href="QUIZ.php?section=list">
            <div class="menu" >
                <li >Listes Questions</li>
                <img src="Images/ic-liste.png" alt="">
            </div>
            </a>
            <a href="QUIZ.php?section=admin" >
            <div class="menu">
                <li>Créer Admin</li>
                <img src="Images/ic-ajout.png" alt="">
            </div>
            </a>
            <a href="QUIZ.php?section=joueurs" >
            <div class="menu">
                <li>Listes Joueurs</li>
                <img src="Images/ic-liste.png" alt="">
            </div>
            </a>
            <a href="QUIZ.php?section=questions">
            <div class="menu">
                <li>Créer Questions</li>
                <img src="Images/ic-ajout-active.png" alt="">
            </div>
            </a>
        </ul>

        </div>

    </div>
    <div class="right" >
        <div class="white-right" id="content" >
            <?php
            if (isset($_GET['section'])){
                if ($_GET['section']== "admin"){
                    include_once "creer_admin.php";
                }elseif ($_GET['section']=="list"){
                    include_once "liste_des_questions.php";
                }
                elseif ($_GET['section']=="questions"){
                    include_once "creation_question.php";
                }
                elseif ($_GET['section']=="joueurs"){
                    include_once "listjoueur.php";
                }

            }
            ?>
        </div>
    </div>
</div>

</body>
</html>

