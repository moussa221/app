<?php

function bdd(){
     try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=remotemysql.com;dbname=8dc7uoGEac', '8dc7uoGEac', 'Yd7flN473i', $pdo_options);
	//$bdd = new PDO('mysql:host=localhost;dbname=TutoForum', 'root', 'root', $pdo_options);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
return $bdd;
}

?>
