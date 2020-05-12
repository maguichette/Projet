<?php
if (isset($_POST['ok'])) {
    $question = "";
    $point = "";
    $typrep = "";
    $reponses = [];
    $message = "";
}
$numinput = 0;
if (isset($_POST['questions']) && isset($_POST['points']) && isset($_POST['typreponse'])) {
    $numinput = $_POST['numinput'];
    $question = $_POST['questions'];
    $point = $_POST['points'];
    $typrep = $_POST['typreponse'];
    $nbInput = count($_POST) - 5;
    for ($i = 0; $i < $nbInput; $i++) {
        if ($_POST['typreponse'] == "multiple") {
            if (isset($_POST['reponse' . ($i + 1) . ''])) {
                if (isset($_POST['checkbox' . ($i + 1) . ''])) {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['valide'] = "true";
                } else {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['valide'] = "false";
                }
            }
        }
        if ($_POST['typreponse'] == "simple") {
            if (isset($_POST['reponse' . ($i + 1) . ''])) {
                if ($_POST['radio'] ==="value".($i + 1)."") {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['valide'] = "true";
                } else {
                
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['valide'] = "false";
                }
            }
        }
    }
}
if ($_POST['typreponse'] == "texte") {
    if (isset($_POST['reponse'])) {
            $reponses[$i]['reponse'] = $_POST['reponse'];
            $reponses[$i]['valide'] = "true";
        }
}

$Tab_Json = json_decode(file_get_contents("question.json"), true);

// $rep_tab=[];
//$rep_valid_tab=[];
if ($point >= 1) {
    $Tab = array(
        // "questions" => $question,
        // "points" => $point,
        // "typreponse" => $typrep,
        // "reponses" => $reponses
    );
    $Tab_Json[] = $Tab;
    $Tab_Json = json_encode($Tab_Json);
    file_put_contents("question.json", $Tab_Json);
    echo '<span id="message" style="color:red">enregistrement réussi</span>';
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
    <link rel="stylesheet" href="creation_question.css">
</head>

<body>
    <div class="white-right" id="content">
        <div class="bord">
            <label for="" id="nombre">PARAMETRER VOTRE QUESTION</label>
        </div>
        <div class="bloc">
            <form action="" method="post" id="form-connexion">
                <div class="areatext">
                    <h2>Question</h2>
                    <textarea name="questions" class="typearea error" cols="30" rows="10" id="input" error="error-1"></textarea>
                    <div class="error" id="error-1"></div>
                </div>
                <div class="areatext1">
                    <h2>Nbre de points</h2>
                    <input type="number" class="numero error" name="points" id="input" error="error-2">
                    <div class="error" id="error-2"></div>
                </div>
                <div class="input" id="inputs">
                    <h2>Type de réponse</h2>
                    <select id="valeur" class="select error" id="input" error="error-3" onchange="onAddTexte()" name="typreponse">
                        <option value="" selected>selectionner une valeur</option>
                        <option value="multiple">choix multiple</option>
                        <option value="simple">choix simple</option>
                        <option value="texte">type texte</option>
                    </select>
                    <div class="error" id="error-3"></div>
                    <button type="button" class="bouton-green" onclick="onAddInput()"> <img src="Images/ic-ajout-réponse.png" alt=""></button>

                </div>



                <input type="hidden" name="numinput" id="hidden">

                <button type="submit" class="enregistrer" name="ok">ENREGISTRER</button>
        </div>
    </div>
    </div>
    </div>



    </form>
    <script>
        const inputs = document.getElementsByClassName("error");
        for (input of inputs) {
            input.addEventListener("keyup", function(e) {
                if (e.target.hasAttribute("error")) {
                    var idDivError = e.target.getAttribute("error");
                    document.getElementById(idDivError).innerText = ""
                }
            })
        }
        document.getElementById("form-connexion").addEventListener("submit", function(e) {
            const fields = document.getElementsByClassName("error");
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
        let nbrRow = 0;

        function onAddInput() {


            var select = document.getElementById('valeur');
            var divInputs = document.getElementById('inputs');
            var newInput = document.createElement('div');
            newInput.setAttribute('class', 'row');
            newInput.setAttribute('id', 'row_' + nbrRow);
            if (select.options[select.selectedIndex].value === "multiple") {
                newInput.innerHTML = `
  <input type="text" class="champ-deux error" error="error-${4+nbrRow}" name="reponse${nbrRow}">
                <input type="checkbox" name="checkbox${nbrRow}" id=" ">
                <button type="button" class="bouton-red" onclick='onDeleteInput(${nbrRow})'> <img src="Images/ic-supprimer.png" alt=""></button>
                <div class="error" id="error-${4+nbrRow}"></div>
             
  `;
                divInputs.appendChild(newInput);
            } else if (select.options[select.selectedIndex].value === "simple") {
                newInput.innerHTML = `
  <input type="text" class="champ-deux error" error="error-${4+nbrRow}" name="reponse${nbrRow}">
                <input type="radio" name="radio" value="value${nbrRow}" >
                <button type="button" class="bouton-red"  onclick='onDeleteInput(${nbrRow})'> <img src="Images/ic-supprimer.png" alt=""></button>
                <div class="error" id="error-${4+nbrRow}"></div>
  `;
                divInputs.appendChild(newInput);
            }

            document.getElementById('hidden').setAttribute("value", "" + nbrRow + "");
            nbrRow++;

        }

        function onAddTexte() {

            nbrRow++;
            var select = document.getElementById('valeur');
            var divInputs = document.getElementById('inputs');
            var newInput = document.createElement('div');
            newInput.setAttribute('class', 'row');
            newInput.setAttribute('id', 'row_' + nbrRow);
            if (select.options[select.selectedIndex].value === "texte") {
                newInput.innerHTML = `
 <input type="text" class="champ-deux error" error="error-4" name="reponse">
    <button type="button" class="bouton-red" onclick='onDeleteInput(${nbrRow})'> <img src="Images/ic-supprimer.png" alt=""></button>
    <div class="error" id="error-4"></div>
            
 `;
                divInputs.appendChild(newInput);
            }
        }

        function onDeleteInput(n) {
            let target = document.getElementById('row_' + n);
            target.remove();
        }

        function fadeOut(idTarget) {
            let target = document.getElementById(idTarget);
            let effect = setInterval(function() {
                if (!target.style.opacity) {
                    target.style.opacity = 1;
                }
                if (target.style.opacity > 0) {
                    target.style.opacity -= 0.1;
                } else {
                    clearInterval(effect);
                }
            }, 200)
        }
        // setTimeout(() => {
        //     document.getElementById("message").innerHTML = '';

        // }, 2000);
    </script>
</body>

</html>