<?php


//Récuperation des données envoyées par asterisk


$code=$_REQUEST['code'];

$montant=$_REQUEST['montant'];

$numdest=$_REQUEST['numdest'];

//Connexion à la base de données

mysqli_connect("localhost","root","");

//sélection de la base de données banque

mysqli_select_db(banque);

//Vérification du solde de l'expéditeur

$a="select solde from compte where code='$code'";

$b=mysqli_query($a);

$c=mysqli_fetch_array($b);

$d=$c['solde'];

if ($d>$montant)
{

		$trans="update compte set solde=$d-$montant where code='$code'";

		$trans1=mysqli_query($trans);

		$soldedestinataire="select solde from compte where numcompte='$numdest'";

		$e=mysqli_query($soldedestinataire);
	
		$f=mysqli_fetch_array($e);

		$g=$f['solde'];
		$trans2="update compte set solde=$g+$montant where numcompte='$numdest'";

		$trans3=mysqli_query($trans2);

		echo "ok";

		}	

else
	
echo "ko";

?>