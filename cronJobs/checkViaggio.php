<?php
    //include('.././includeAll.php');
	include('../sendData/database.php');
	include('../classes/luogo/Luogo.php');
	include('../classes/luogo/Sottoluogo.php');
	include('../classes/utente/Classe.php');
	include('../classes/utente/utente.php');
	
	$con = new Database();
	$db = $con->getDB();	
	
	$q = "
	    SELECT *
		FROM BOT_RPG_VIAGGIO 
		WHERE DATE(DATA_ARRIVO) = DATE(NOW())
		AND HOUR(DATA_ARRIVO) = HOUR(NOW())
		AND MINUTE(DATA_ARRIVO) = MINUTE(NOW())";
	$res = $db->query($q);
	while($row = $res->fetch_object()){
		$ut = new Utente($row->UTENTE_ID);
		$ut->sendMessage('Viaggio terminato!');
		$db->query("DELETE FROM BOT_RPG_VIAGGIO WHERE UTENTE_ID = ". $ut->getUtenteId());
	}
	
	