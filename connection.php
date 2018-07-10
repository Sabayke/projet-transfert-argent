<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=toip_projet', 'root', '');
//echo "Tous les champs doivent être complétés !";
if(isset($_POST['ok'])) 
{
	//echo "salut !";
   $login = htmlspecialchars($_POST['login']);
   $secret = sha1($_POST['secret']);
   if(!empty($login) AND !empty($secret)) 
   {
      $requser = $bdd->prepare("SELECT * FROM users WHERE login = ? AND secret = ?");
     $requser->execute(array($login, $secret));
      $userexist = $requser->rowCount();
      if($userexist == 1) 
	  {
         $userinfo = $requser->fetch();
         $_SESSION['login'] = $userinfo['login'];
         $_SESSION['secret'] = $userinfo['secret'];
         header("Location: bienvenu.html");
	 // var_dump($login);
           } else {
         echo "Mauvais login ou mot de passe !";
		}
   } else {
      echo "Tous les champs doivent être complétés !";
   }
}     

?>
<html>
   <head>
      <title> Connexion</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Veuillez connecter pour utiliser Asterisk</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="text" name="login" placeholder="Entrer votre login" />
            <input type="password" name="secret" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="ok" value="ok" />
         </form>
      </div>
   </body>
</html>