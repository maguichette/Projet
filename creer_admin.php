<?php
if(isset($_POST['compte'])){
    $json= file_get_contents('fichier.json');
$decode= json_decode($json,true);
$tab['prenom']=$_POST['prenom'];
$tab['nom']=$_POST['nom'];
$tab['login']=$_POST['login'];
$tab['password']=$_POST['password'];
$tab['cpassword']=$_POST['cpassword'];
if($_POST['password']!=$_POST['cpassword']){
    echo "veiller saisir des mots de passe identiques";
}
else{
    $decode[]=$tab;
    $encode= json_encode($decode);
    file_put_contents('fichier.json',$encode);
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
    <link rel="stylesheet" href="creer_admin.css">
</head>
<body>
<div class="profil">
    <h2>S'INSCRIRE</h2>
    <h3>Pour proposer des quizz</h3>
    <div class="bar"></div>
    <div class=myinput>
        <form action=""method="post" enctype="multipart/form-data" id="form-connexion">
        <input type="text" placeholder="prénom"name='prenom'id="" error="error-1">
        <div class="error" id="error-1" style='color:red;'></div>
        <input type="nom" placeholder="nom"name='nom'id="" error="error-2">
        <div class="error" id="error-2"style='color:red;'></div>
        <input type="login" placeholder="login"name='login' id="" error="error-3">
        <div class="error" id="error-3"style='color:red;'></div>
        <input type="password" placeholder="password" name='password'id="" error="error-4">
        <div class="error" id="error-4"style='color:red;'></div>
        <input type="confirmer password" placeholder="confirmer password" name='cpassword'id="" error="error-5 ">
        <div class="error" id="error-5"style='color:red;'></div>
            <br>
            <div>
                <p class="avatar">Avatar</p>
                <input id="btn1" type="file" onchange="image(this)">
            </div>


        <input type="submit" name=" compte" value="créer compte" class="btn2">
        </form>
    </div>
    <div class="myprofil">
        <img src="" alt="" id="img">
    </div>
</div>

<script>
    function image(avatar) {
        let image= document.getElementById("img")
        image.src=window.URL.createObjectURL(avatar.files[0]);
    }
     //gerer les champs obligatoires//
     const inputs = document.getElementsByTagName("input");
           for(input of inputs){
               input.addEventListener("keyup",function(e){
                  if (e.target.hasAttribute("error")){
                    var idDivError=e.target .getAttribute("error");
                    document.getElementById(idDivError).innerText=""
                  }
               })
        } 
        document.getElementById("form-connexion").addEventListener("submit",function(e){
            const inputs = document.getElementsByTagName("input");
           var error=false;
           for(input of inputs){
            if(input.hasAttribute("error")){
              var  idDivError=input.getAttribute("error");
               if(!input.value){
                       document.getElementById(idDivError).innerText=" Ce champ est obligatoire"
                       error=true
                   }
                 
               }
           }
           if(error){ 
               e.preventDefault();
              
            }
            return false;
           })
</script>
</body
