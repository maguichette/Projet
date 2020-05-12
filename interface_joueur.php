<?php
session_start();
$avatar = $_SESSION['avatar'];
if (!isset($_SESSION['prenom'])) {
    $_SESSION['msg'] = 'Veuillez vous connecter d\'aboord';
    header('Location: index.php');
    exit;
}
$json = file_get_contents('fichier.json');
$decode = json_decode($json, true);
$tabuser = [];
foreach ($decode as $value) {
    if ($value['role'] == "joueur") {
        $tab[] = $value;
    }
}
$columns = array_column($tab, "score");
array_multisort($columns, SORT_DESC, $tab);
//Pagination
$Tab_Json = json_decode(file_get_contents("question.json"), true);
$tab_fixe = json_decode(file_get_contents("cinq_questions.json"), true);

if (isset($_GET['page'])) {
    $num_page = (int) $_GET['page'];
} else {
    $num_page = 1;
}

$valeur__total = count($Tab_Json);
$nbr_par_page = 1;
$nbr_pages = ceil($valeur__total / $nbr_par_page);
$debut = ($num_page - 1) * $nbr_par_page;
$fin = $debut + $nbr_par_page - 1;
$Tab_Json = array_slice($Tab_Json, $debut, $nbr_par_page);

$_SESSION['reponse'] = $_POST['resultat'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="interface_joueur.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script>
    function cacher1() {
        document.getElementById('topscore').style.display = "block";
        document.getElementById('meilleurscore').style.display = "none";

    }

    function cacher2() {
        document.getElementById('topscore').style.display = "none";
        document.getElementById('meilleurscore').style.display = "block";

    }
</script>


<body onload="cacher1()">
    <div class="header">
        <div class="logo">
            <img src="Images/logo-QuizzSA.png" alt="">
        </div>

        <div class="header_title">
            <h3>Le plaisir de jouer</h3>
            <?php
            if (isset($_SESSION['message'])) { ?>
                <p id="msg" style="color: red"><?= $_SESSION['message'] ?></p>

            <?php
                unset($_SESSION['message']);
            }
            ?>

        </div>
    </div>
    <div class="background">
        <div class="background_header">
            <div class="image">

                <img src="avatar/13495265_1719707671637373_622873276949554619_n.jpg<?= $avatar ?>" alt="">
            </div>
            <div class="prenom_nom"><?= $_SESSION['prenom'] ?> <br> <span class="nom"><?= $_SESSION['nom'] ?></span></div>
            <div class="titre">
                <h2> BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br> JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERAL </h2>

                <div class="bouton"> <a href="deconnexion.php"><button class="logout" type="submit">Déconnexion</button></a></div>

            </div>
            <div class="form">
                <div class="white">
                    <div class="right">
                        <div class="white-right" id="content">
                            <div class="question">
                                <form action="traitement.php" method="post">
                                <div class="div">
                                    <div class="nice"><u>
                                            <h2><?= 'Question ' . $num_page . '/' . $tab_fixe['nbrquestion'] ?></h2>
                                        </u></div>
                                    <?php
                                    foreach ($Tab_Json as $key => $value) {
                                        echo ($num_page), ". ", $value['questions'], "</br>";
                                    ?>
                                </div>
                            </div>
                            <input type="text" class="pts" value="<?php echo $value['points'] . 'pts' ?>">
                            <div class="answer">
                                





                            <?php
                                echo "<input type='hidden' name='typreponse' value='".$value['typreponse']."' />";
                                echo "<input type='hidden' name='num_page' value='$num_page' />";

                                        if ($value['typreponse'] == "simple") {
                                            foreach ($value['reponses'] as $val) {

                                                echo '<input type="radio" name="radio" value="'.$val['reponse'].'"  /> ', $val['reponse'], '</br>';
                                            }
                                        } elseif ($value['typreponse'] == "multiple") {
                                            foreach ($value['reponses']  as $val) {

                                                echo '<input type="checkbox" name="check[]" value="'.$val['reponse'].'"/> ', $val['reponse'], '</br>';
                                            }
                                        } elseif ($value['typreponse'] == "texte") {

                                            echo "<input type='texte' name='texte' > </br>";
                                        }
                                    }

                            ?>
                            </div>
                            <?php
                            // je teste si les reponse sont bien enregistrés
                            // if (isset($_SESSION['reponses'])) {
                            //     echo "<pre>";
                            //     var_dump($_SESSION['reponses']);
                            //     echo "</pre>";
                            // }

                            if ($num_page > 1) {
                                $precedent = $num_page - 1;
                               // echo '<a class="precedent"  href="interface_joueur.php?page=' . $precedent . '">PRECEDENT</a>';
                            }

                            if ($num_page < $nbr_pages) {
                               // $suivant = $num_page + 1;
                               echo "<input type='submit' name='suivant' value='Suivant' class='next'/>";
                               // echo '<a class="next" href="interface_joueur.php?page=' . $suivant . '">SUIVANT</a>';
                            }

                            ?>


                        </div>
                        </form>
                    </div>
                    <div class="top">
                        <div class="tab">
                            <!-- <button class="tablinks">Top Score</button> -->
                            <button class="tablinks" id="click1" onclick="cacher1()">TOP Score</button>
                            <button class="tablinks" onclick="cacher2();">Mes meilleurs score</button>

                            <div id="meilleurscore" class="tabcontent">
                                <?php
                                $json = file_get_contents('fichier.json');
                                $decode = json_decode($json, true);
                                $tabuser = [];
                                foreach ($decode as $value) {
                                    if ($value['role'] == "joueur") {
                                        $tabuser[] = $value;
                                    }
                                }
                                $columns = array_column($tab, "score");
                                array_multisort($columns, SORT_DESC, $tab);
                                echo "<table>";
                                echo '<td><strong> Nom </stong></td><td><strong> Prenom </stong></td><td><strong> Score </stong></td>';
                                if (($_SESSION['prenom']) == $value['prenom'] && ($_SESSION['nom']) == $value['nom']) {
                                    echo  $value = $score;
                                    echo "<tr>";
                                    echo '<td>' . $tab[$i]['prenom'] . '</td>';
                                    echo '<td>' . $tab[$i]['nom'] . '</td>';
                                    echo '<td>' . $tab[$i]['score'] . ' pts</td>';
                                    echo '</tr>';
                                }
                                echo "</table>"
                                ?>
                            </div>

                            <div id="topscore" class="tabcontent">
                                <?php
                                $json = file_get_contents('fichier.json');
                                $decode = json_decode($json, true);
                                $tabuser = [];
                                foreach ($decode as $value) {
                                    if ($value['role'] == "joueur") {
                                        $tabuser[] = $value;
                                    }
                                }
                                $columns = array_column($tab, "score");
                                array_multisort($columns, SORT_DESC, $tab);
                                echo "<table>";
                                echo '<td><strong> Nom </stong></td><td><strong> Prenom </stong></td><td><strong> Score </stong></td>';
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<tr>";
                                    echo '<td>' . $tab[$i]['prenom'] . '</td>';
                                    echo '<td>' . $tab[$i]['nom'] . '</td>';
                                    echo '<td>' . $tab[$i]['score'] . ' pts</td>';
                                    echo '</tr>';
                                }
                                echo "</table>"
                                ?>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>