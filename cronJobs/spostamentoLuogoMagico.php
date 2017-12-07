<?php
	include('../sendData/database.php');
	$db = new Database();
	$db->getDB();
	
	$x = rand(-1000000,1000000);
	$y = rand(-1000000,1000000);
	$id = 3;
	
	$q = "UPDATE BOT_RPG_LUOGO SET LUOGO_X = ".$x.", LUOGO_Y = ".$y." WHERE LUOGO_ID = " . $id;
	$db->getDB()->query($q);