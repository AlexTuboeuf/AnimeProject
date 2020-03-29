<?php session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
     
    <title>Edition de profil ·</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style/styleIndex.css">
     <link rel="stylesheet" href="style/styleEd.css">
</head>
<header>
    <div id="header">
        <h1>Edition de profil</h1>
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
                <a href="cours.php">Cours</a>
            </li>
        </ul>
    </div>
</div>

<br><br><br><br><br><br><br><br><br>
<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');

if(isset($_SESSION['id'])) {
    $password = $_SESSION['id'];
    $requser = $bdd->prepare('SELECT * FROM membres WHERE motdepasse = ?');
    $requser->execute(array($password));
    $userinfo = $requser->fetch();
    
   if(isset($_POST['newpseudo']) && !empty($_POST['newpseudo']) && $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) && !empty($_POST['newmail']) && $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) && !empty($_POST['newmdp1']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
        <div class="FormulaireEdition">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label><br>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $userinfo['pseudo']; ?>" /><br /><br />
               <label>Mail :</label><br>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $userinfo['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label><br>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label><br>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br /><br>
               <input class="MAJ" type="submit" value="Mettre à jour mon profil !" />
            </form>
        </div>
            <?php if(isset($msg)) { echo $msg; } ?>
<?php   
}
else {
   header("Location: connexion.php");
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