<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
     
    <title>Connexion ·</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style/styleIndex.css">
     <link rel="stylesheet" href="style/styleIndexCo.css">
</head>
<header>
    <div id="header">
        <h1>Connexion</h1>
    </div>
    <a href="connexion.php">
    <img class="profile" src="images/user.svg"></a>
</header>
<body>
    <!-- Nav bar -->
<div class="btn-navigation">
        <div class="barre"></div>
        <div class="barre"></div>
        <div class="barre"></div>
    </div> 
    <div class="navigation">
    <ul> 
            <li>
                <a href="index.php">Accueil</a>
            </li>
            <li>
                <a href="connexion.php">Connexion</a>
            </li>
            <li>
                <a href="inscription.php">Inscription</a>
            </li>
            <li>
                <a href="cours.php">Cours</a>
            </li>
        </ul>
    </div>
</div>
<!-- Formulaire de connexion -->
<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) && !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
setcookie('pseudo', $_POST['username'], time() + 365*24*3600, null, null, false, true);
?>
<form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <?php
         if(isset($erreur)) {
            echo "<script> alert(\" $erreur \") </script>";
         }?>
         <?php 
if (isset($_SESSION['id']) && isset($_SESSION['id']))
{
    header('Location: profil.php?id='.$_SESSION['id']);
}
?>

<!-- Bas de page -->
<footer>
        <div id="bottom">
            <div class="copyright">
                <div class="text-bottom">
                    <p class="politique">Politique de confidentialité</p>
                    <div class="politiqueblock">
                        <div class="politiqueblock2">
                            <h2>Politique de confidentialité</h2>
                            <p class="politiquetext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo, massa id pellentesque scelerisque, lorem arcu ornare lacus, 
                                vel interdum velit sem a massa. Duis lobortis blandit mauris gravida vestibulum. Curabitur diam diam, fermentum vitae neque eget, 
                                gravida mollis dui. Sed tincidunt sem nec ligula laoreet, in blandit ante hendrerit. Morbi in diam porta, fermentum elit quis, consequat velit. Donec et aliquam nibh. 
                                Praesent purus augue, sagittis ac sapien sed, semper porttitor libero. Phasellus porta ac dolor at malesuada. Nulla condimentum rutrum dictum. Duis ut ex euismod, 
                                volutpat mi eu, euismod augue. Cras ante nisl, cursus in lacus rutrum, pretium viverra sapien. Curabitur varius vehicula ornare. 
                                Suspendisse id lorem a libero gravida elementum.</p>
                        </div>
                    </div>
                    <p class="mentions">Mentions légales</p>
                    <div class="mentionsblock">
                        <div class="mentionsblock2">
                            <h2>Mentions · Légales </h2>
                            <p class="mentionstext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo, massa id pellentesque scelerisque, lorem arcu ornare lacus, 
                                vel interdum velit sem a massa. Duis lobortis blandit mauris gravida vestibulum. Curabitur diam diam, fermentum vitae neque eget, 
                                gravida mollis dui. Sed tincidunt sem nec ligula laoreet, in blandit ante hendrerit. Morbi in diam porta, fermentum elit quis, consequat velit. Donec et aliquam nibh. 
                                Praesent purus augue, sagittis ac sapien sed, semper porttitor libero. Phasellus porta ac dolor at malesuada. Nulla condimentum rutrum dictum. Duis ut ex euismod, 
                                volutpat mi eu, euismod augue. Cras ante nisl, cursus in lacus rutrum, pretium viverra sapien. Curabitur varius vehicula ornare. 
                                Suspendisse id lorem a libero gravida elementum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script> 
<script src="src/app.js"></script>

</body>

</html>