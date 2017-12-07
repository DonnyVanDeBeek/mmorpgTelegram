<?php
	include('../sendData/database.php');
	$con = new Database();
	$db  = $con->getDB();
	
	$q = '';
	
	//Clear Mob
	$mob = "DELETE FROM BOT_RPG_MOB WHERE MOB_HP <= 0; ";
	
	//Clear Buff
	$buff = "DELETE FROM BOT_RPG_BUFF WHERE TIMESTAMPDIFF(SECOND,NOW(),BUFF_DATA_SCADENZA) <= 0 OR BUFF_DURATA_TURNI <= 0; ";
	
	//Clear Viaggio
	$viaggio = "DELETE FROM BOT_RPG_VIAGGIO WHERE TIMESTAMPDIFF(SECOND,NOW(),DATA_ARRIVO) <= 0; ";	
	
	$db->query($mob);
	$db->query($buff);
	//$db->query($viaggio);