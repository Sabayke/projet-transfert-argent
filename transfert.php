<?php


//R�cuperation des donn�es envoy�es par asterisk


$code=$_REQUEST['code'];

$montant=$_REQUEST['montant'];

$numdest=$_REQUEST['numdest'];

//Connexion � la base de donn�es

mysqli_connect("localhost","root","");

//s�lection de la base de donn�es banque

mysqli_select_db(banque);

//V�rification du solde de l'exp�diteur

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