<html>
<head>
  <title>transfert d'argent</title>
</head>
<body>
<?php
session_start();
// pour le transfert
$bdd = new PDO('mysql:host=127.0.0.1;dbname=kadia', 'root', '');
  
  
if(isset($_POST['valider'])) {
  
   if(isset($_POST['montantTra']))
     {
      $montantTra = $_POST['montantTra'];
  
    
{
    
    $sender=$_POST['sender'];
    //$query="UPDATE diaka SET montant = $montantTra WHERE Nom = '$sender'";
    //echo $query;
    //$insertmontant3 = $bdd->prepare("SELECT count(*) as nb from diaka WHERE Nom = ? AND montant>= ?");  //3sek la tenssa 3en ha4i la ligne
   //verification
   //$montanttr = $_POST['montanttr'];
   //if($montanttr>0 && $montantTra<$montanttr)
//   {
   //$insertmontant3->execute(array($montantTra, $_POST['sender']));
    
    //
    //if($montanttr>0 && $montantTra<$montanttr)
    //{
    //$insertmontant3->execute(array($montantTra , $_POST['sender']));
    $insertmontant1 = $bdd->prepare("UPDATE diaka SET montant = montant - ? WHERE Nom = ?");
      $insertmontant1->execute(array($montantTra , $_POST['sender']));
      $insertmontant2 = $bdd->prepare("UPDATE diaka SET montant = montant + ? WHERE Nom = ?");
      $insertmontant2->execute(array($montantTra , $_POST['receiver']));
  //  echo " suis là";
    //header('bienvenu.html');
    //   
   }
  // else 
//{
  //echo "Votre solde ne vous permez pas d'effectuer cette opération";
//}

}
}

?>
<?php
header( 'content-type: text/html; charset=utf-8' );
require('user.php');
require('functions.php');

//Users array
$users = ['ramata','fifi','kardiata'];
$i=0;
foreach ($users as $user) {
  //Create user
  $users[$i] = new user($user,10000,'');
  //Get user
  $users[$i]->get();
  echo '<br>';
  $i++;
  //
}
?>
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
</form>

<?php /*
//var_dump($_POST['sender'] == $_POST['receiver']);
if (($_POST['montantTra']!=NULL) AND ($_POST['sender']!= $_POST['receiver'])) 
{
  $montant = $_POST['montant'];
  if($montant>=10000)
  {
    echo"Votre solde ne vous permez pas d'effectuer cette opération";
  }else
       { 
       $senderID = $_POST['sender'];
  $receiverID = $_POST['receiver'];
  // Sample transfer
  $users[$senderID]->credit($users[$receiverID],$montant);
  echo '<br>';
  $users[$senderID]->get();
  echo '<br> a transféré <b>'.$montant.'</b> vers <br><br>';
  $users[$receiverID]->get();
  require ('message.html') ;
}
}
else
{
  echo "y a erreur qq part";
} */
?>
</center>
</body>
</html>