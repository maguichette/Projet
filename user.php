
<?php
if(isset($_POST['compte'])){
    $json= file_get_contents('fichier.json');
$decode= json_decode($json,true);
$tab['prenom']=$_POST['prenom'];
$tab['nom']=$_POST['nom'];
$tab['login']=$_POST['login'];
$tab['password']=$_POST['password'];
$tab['role']="joueur";
$tab['score']="0";
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
    <link rel="stylesheet" href="user.css">
</head>
<body>
      
        <div class="font">
        <div class="logo"><img src="Images/logo-QuizzSA.png" alt="">
        </div>
        <div class="para">
            <p>Le plaisir de jouer</p>
            <div class="FONT">
            <form action="" method="POST" enctype="multipart/form-data" id="form-connexion">
        <div class="form">
        <div class="monprofil">
          <h2>S'INSCRIRE</h2>
          <h3>Pour tester votre niveau de culture general</h3> 
          <div class="bar"></div>
          <div class=myinput>
          <label >Prénom</label>
          <input type="text" id="" error="error-1" name='prenom'>
          <div class="error" id="error-1"></div>
          <label >Nom</label>
          <input type="nom" id="" error="error-2" name='nom'>
          <div class="error" id="error-2"></div>
          <label >Login</label>
          <input type="login" id="" error="error-3" name='login'>
          <div class="error" id="error-3"></div>
          <label >Password</label>
          <input type="password" id="" error="error-4" name='password'>
          <div class="error" id="error-4"></div>
          <label >confirmer Password</label>
          <input type="confirmer password" id="" error="error-5" name='cpassword'>
          <div class="error" id="error-5"></div>
        
          <input id="btn1" type="file" onchange="image(this)">
          <input type="submit" name=" compte" value="créer compte" class="btn2">
         
          </div>
          <div class="myprofil">
          <img src="" alt="" id="img">
          </div>
              <p class=jouer>Avatar du joueur</p>
            
           </div>
           <script>
               //recuperer une image et le charger dans la section//
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
</body>
</html>