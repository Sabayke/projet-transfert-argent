<html>
<head>
  <title>transfert d'argent</title>
</head>
<body>
<?php
header( 'content-type: text/html; charset=utf-8' );
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=kadia', 'root', '');
  
  
if(isset($_POST['valider'])) {
  
   if(isset($_POST['montantTra']))
     {
      $montantTra = $_POST['montantTra'];
      $sender=$_POST['sender']; 
	  
	  $select_montanttr = $bdd->prepare("SELECT montant FROM diaka WHERE Nom=?"); 
	  $select_montanttr->execute(array($sender));
	  $montanttr = $select_montanttr->fetch()[0];
	  if($montanttr>0 && $montantTra<$montanttr)
	  {

	  $insertmontant1 = $bdd->prepare("UPDATE diaka SET montant = montant - ? WHERE Nom = ?");
      $insertmontant1->execute(array($montantTra , $_POST['sender']));
      $insertmontant2 = $bdd->prepare("UPDATE diaka SET montant = montant + ? WHERE Nom = ?");
      $insertmontant2->execute(array($montantTra , $_POST['receiver']));
      header('message.html');   
   }
  else 
{
  $erreur= "Votre solde ne vous permez pas d'effectuer cette opération";
}

}
  else
{
	$erreur = "Il faut remplir tous les champs jeune homme";
}
}
  else
{
	$erreur = "Jeune homme t'as rien saisie";
}

?>

<!--link rel="stylesheet" href="style.css" media="screen" type="text/css" /-->
<center> 
  <h1 style="height: 60px; bottom: 10px;">FifiMoney pour le transfert d'argent</h1>
<form method="POST" action="" >
  <table>
    <tr>
      <td>
        <input type="text" name="sender" placeholder="expéditeur">
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="montantTra" placeholder="Saisir le montant à transféré">
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" name="receiver" placeholder="destinataire">
      </td>
    </tr>
     <tr>
      
      
    </tr>
  </table>

  <input type="submit" name="valider" value="Send"><br>
          <?php
		  if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
                ?>
</form>
</center>
</body>
</html>