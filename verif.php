
<?php 

session_start();
if(isset($_POST['email']) && isset($_POST['password']))
{

	$dbHost = '144.21.67.201';
	$dbHostPort ="1521";
	$dbServiceName ="pdbest21.631174089.oraclecloud.internal";
	$usr= 'CARON2B20';
	$pswd= 'CARON2B2001';
	$dbConnStr = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)
	(HOST =".$dbHost.")(PORT = ".$dbHostPort."))
	(CONNECT_DATA = (SERVICE_NAME = ".$dbServiceName.")))";

	if(!$dbConn=oci_connect($usr,$pswd, $dbConnStr)){
		$err=oci_error();
		trigger_error("Connexion non établie : " .$err ['message'], E_USER_ERROR);
	}
	else
	{
		echo "Connecté(e)";
	}

	if($_POST['email'] !== "" && $_POST['password'] !== "")
    {
		$mailE = $_POST['email'];
		$mdp = $_POST['password'];
        $requete = "SELECT emailEmploye, mdp FROM employes";
		
			  
			  
        $exec_requete = oci_parse($dbConnStr,$requete);
		//$info = $infos = array();
		
		
		while (oci_fetch($exec_requete)){
			$a = oci_result($exec_requete, 'emailEmploye');
			$b = oci_result($exec_requete, 'mdp');
			
			if($mailE == $a && $mdp == $b) // nom d'utilisateur et mot de passe correctes
			{
				//$_SESSION['email'] = $email;
				header('Location: connexion.php');
			}
			else
			{
				header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
			}
			//$infos[]=$info;
		}
		
		
        
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
?>
