<?php
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == "admin"){
        header("Location: QUIZ.php");
        exit;
    }
    else{
        header("Location: interface_joueur.php");
        exit;
    }
}
$json= file_get_contents('fichier.json');
$decode= json_decode($json,true);
                      
if(isset($_POST['submit'])){
    $login= $_POST['email'];
    $password= $_POST['password'];
    if(isset($login) && isset($password)){
        if(!empty($login) && !empty($password)){
            foreach($decode as $value){
                if($login == $value['Login'] && $password == $value['password']){
                    $_SESSION['prenom']= $value['prenom'];
                    $_SESSION['nom']= $value['nom'];
                    $_SESSION['role']= $value['role'];
                    $_SESSION['avatar']= $value['avatar'];
                    if($value['role'] == 'admin'){
                        header('Location: QUIZ.php');
                    }
                }else{
                    header('Location: interface_joueur.php');
                }
            }
            
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  type="text/css" href="qcm.css">
    <title>Page de connexion</title>
</head>
<body>
      
        <div class="font">
        <div class="logo"><img src="Images/logo-QuizzSA.png" alt="">
        </div>
        <div class="para">
            <h4>Le plaisir de jouer</h4>

        </div>
        </div>
        <div class="FONT">
        <div class="form">
        <div class="couleur">
        <h1>Login Form</h1>
        </div>
        <form action="" method="POST"  id="form-connexion">
        <div class="post">
        <input class="name" placeholder="Login" type="text" class="email" name="email" id="" error="error-1" >
        <div class="div2"><img src="/App2/icone-user.png" alt=""></div>
        <div class="error" id="error-1"></div>
        </div>
       <div class="post2">
       <input class="pass" placeholder="password" type="password" class="password" name="password" id="" error="error-2">
       <div class="div2"> <img src="/App2/icone-password.png" alt=""></div>
       <div class="error" id="error-2"></div>
       </div>
       <div class="post3">
        <button type="submit" name="submit" class="connex" id="">Connexion</button>
       <p><a href="user.php">S'inscrire pour jouer ?</a> </p>
    </div>

       </div>
       </form>
        </div>
        </div>
      
       </div>
       <script>
           
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