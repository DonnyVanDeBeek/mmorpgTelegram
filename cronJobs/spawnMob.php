<?php
	include('../sendData/database.php');
	include('../classes/Sottoluogo.php');
	
	$con = new Database();
	$db = $con->getDB();
	
	$q = "SELECT SOTTOLUOGO_ID FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_MOB_SPAWN = 0 ORDER BY RAND() LIMIT 1";
	$res = $db->query($q);
	$row = $res->fetch_object();
	
	$q = "SELECT * FROM BOT_RPG_SPAWN WHERE SOTTOLUOGO_ID = ".$row->SOTTOLUOGO_ID." 