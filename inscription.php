<? session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
     
    <title>Inscription ·</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style/styleIndex.css">
     <link rel="stylesheet" href="style/styleIndexCo.css">
</head>
<header>
    <div id="header">
        <h1>Inscription</h1>
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


    <!-- Formulaire -->
    <?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');

if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mail2']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<?php 
if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
{
    header('Location: profil.php?id='.$_SESSION['id']);
}
?>
         <form method="POST" action="">
            <table>
               <tr>
                  <td>
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td>
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     <br/>
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
    </div>
    <?php
         if(isset($erreur)) {
            echo "<script> alert(\" $erreur \") </script>";
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