<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=toip_projet', 'root', '');
// le mot de passe de yahya est mymam25899
if(isset($_POST['forminscription'])) 
{
   $login = htmlspecialchars($_POST['login']);
   $secret = sha1($_POST['secret']);
   $montant = htmlspecialchars($_POST['montant']);
   $telephone = htmlspecialchars($_POST['telephone']);
   if(!empty($_POST['login']) AND !empty($_POST['secret']) AND !empty($_POST['montant']) AND !empty($_POST['telephone'])) 
   {
      $loginlength = strlen($login);
      
         if($secret == $secret) 
		 {
           // if(filter_var($secret, FILTER_VALIDATE_SECRET)) {
               $reqsecret = $bdd->prepare("SELECT * FROM users WHERE secret = ?");
               $reqsecret->execute(array($secret));
               $secretexist = $reqsecret->rowCount();
               if($secretexist == 0) {
                  if($login == $login) {
                     $insertmbr = $bdd->prepare("INSERT INTO users(login, secret, montant, telephone) VALUES(?, ?, ?, ?)");
                     $insertmbr->execute(array($login, $secret, $montant, $telephone));
                     echo "Cher client votre compte Asterisk a été bien créé ! continué à utiliser asterisk";
					 header('Location: bienvenu.html');  
                  } //else {
                     //$erreur = "Vos mots de passes ne correspondent pas !";
                  //}
               } else {
                  echo "le login est déjà utilisé !";
               }
            } else {
               echo " y a un probléme au niveau de la bd";
            }
         } else {
            echo " il faut remplir tous les champs !!! ";
        }
      } else {
         echo "Vous avez dépasser la taille autorisé !";
      } 

?>
<html>
   <head>
      <title>Inscription</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Formulaire pour l'administrateur d'Asterisk</h2>
         <br /><br />
         <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="login">login :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre login" id="login" name="login" value="<?php if(isset($login)) { echo $login; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="secret">Secret:</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="secret" name="secret" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="montant">Le solde du client :</label>
                  </td>
                  <td>
                     <input type="montant" placeholder="Saisir le montant" id="montant" name="montant">
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="telephone"> Telephone :</label>
                  </td>
                  <td>
                     <input type="telephone" placeholder="Le telephone du client" id="telephone" name="telephone" />
                  </td>
               </tr>
               <tr>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="forminscription" />
                  </td>
               </tr>
            </table>
         </form>
         <!--
           <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?> 
         -->
         
      </div>
   </body>
</html>