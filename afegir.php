<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;

	ini_set('display_errors', 0);
	
	if ($_POST['uid'] && $_POST['unorg'] && $_POST['num_id'] && $_POST['grup'] && $_POST['dir_pers'] && $_POST['sh'] && $_POST['cn'] && $_POST['sn']
	    && $_POST['nom'] && $_POST['mobil'] && $_POST['adressa'] && $_POST['telefon'] && $_POST['titol'] && $_POST['descripcio']){
	#Dades de la nova entrada

	$uid=$_POST['uid'];
	$unorg=$_POST['unorg'];
	$num_id=$_POST['num_id'];
	$grup=$_POST['grup'];
	$dir_pers=$_POST['dir_pers'];
	$sh=$_POST['sh'];
	$cn=$_POST['cn'];
	$sn=$_POST['sn'];
	$nom=$_POST['nom'];
	$mobil=$_POST['mobil'];
	$adressa=$_POST['adressa'];
	$telefon=$_POST['telefon'];
	$titol=$_POST['titol'];
	$descripcio=$_POST['descripcio'];
	$objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
	#
	#Afegint la nova entrada
	$domini = 'dc=fjeclot,dc=net';
	$opcions = [
        'host' => 'zend-gegaco.fjeclot.net',
		'username' => "cn=admin,$domini",
   		'password' => 'fjeclot',
   		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
   		'baseDn' => 'dc=fjeclot,dc=net',
    ];	
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$nova_entrada = [];
	Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
	Attribute::setAttribute($nova_entrada, 'uid', $uid);
	Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
	Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
	Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
	Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
	Attribute::setAttribute($nova_entrada, 'cn', $cn);
	Attribute::setAttribute($nova_entrada, 'sn', $sn);
	Attribute::setAttribute($nova_entrada, 'givenName', $nom);
	Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
	Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
	Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
	Attribute::setAttribute($nova_entrada, 'title', $titol);
	Attribute::setAttribute($nova_entrada, 'description', $descripcio);
	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";	
	}
?>


<html>
	<head>
		<title>AFEGINT DADES D'USUARIS
		</title>
	</head>
	<body>
		<form action="http://zend-gegaco.fjeclot.net/projecte_gascon/afegir.php" method="POST">
		Uid: <input type="text" name="uid"><br>
		Unitat organitzativa: <input type="text" name="unorg"><br>
		uidNumber: <input type="number" name="num_id"><br>
		gidNumber: <input type="number" name="grup"><br>
		Directori personal: <input type="text" name="dir_pers"><br>
		Shell: <input type="text" name="sh"><br>
		cn: <input type="text" name="cn"><br>
		sn: <input type="text" name="sn"><br>
		givenName: <input type="text" name="nom"><br>
		mobile: <input type="number" name="mobil"><br>
		postalAddress: <input type="text" name="adressa"><br>
		telephoneNumber: <input type="number" name="telefon"><br>
		title: <input type="text" name="titol"><br>
		description: <input type="text" name="descripcio"><br>
		
		<input type="submit"/>
		<input type="reset"/>
		</form>
	</body>
</html>