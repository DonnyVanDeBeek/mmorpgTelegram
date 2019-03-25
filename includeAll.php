<?php
	//include('./sendData/botToken.php');
	include('./sendData/database.php');

	$dir = './classes';
	$ext = '.php';

	//Database
	$root = $dir.'';
	//include($dir.'/database' .$ext);
	include($dir.'/Functions'.$ext);

	/*
	//Keyboard
	$root = $dir.'/keyboard';
	include($root.'/keyboard'.$ext);

	//Luogo
	$root = $dir.'/luogo';
	include($root.'/Luogo'	  .$ext);
	include($root.'/Sottoluogo'.$ext);

	//Classi sottoluogo
	$root = $dir.'/luogo/sottoluogo';
	include($root.'/BarDragons'.$ext);
	include($root.'/ClubAmiciNotturni'.$ext);

	//NPC
	$root = $dir.'/npc';
	include($root.'/Npc'.$ext);

	//Classi NPC
	$root = $dir.'/npc/npc';
	include($root.'/Vetto'.$ext);
	include($root.'/MastroBrugo'.$ext);
	include($root.'/Randomante'.$ext);
	include($root.'/MarkJankos'.$ext);
	include($root.'/JohnnyJankos'.$ext);
	include($root.'/MrLobster'.$ext);

	//Utente
	$root = $dir.'/utente';
	include($root.'/Classe.php');
	include($root.'/utente.php');

	//Classi Utente
	$root = $dir.'/utente/razze';
	include($root.'/Uomo'.$ext);

	//Abstract
	$root = $dir.'/abstract';
	include($root.'/Buff'  .$ext);
	include($root.'/Drop'  .$ext);
	include($root.'/Skill' .$ext);
	include($root.'/Nome'  .$ext);
	include($root.'/Stat'  .$ext);
	include($root.'/Danno' .$ext);
	include($root.'/AI' .$ext);

	//Mob
	$root = $dir.'/mob';
	include($root.'/TipoMob'.$ext);
	include($root.'/mob'	.$ext);

	//Classi Mob
	$root = $dir.'/mob/mob';
	include($root.'/Orco'.$ext);
	include($root.'/Lupo'.$ext);
	include($root.'/CinghialeCattivo'.$ext);
	include($root.'/Herobrine'.$ext);
	include($root.'/SpiritoDellAria'.$ext);
	include($root.'/OrcoArciere'.$ext);

	//Equip
	$root = $dir.'/equip';
	include($root.'/TipoEquip'.$ext);
	include($root.'/Equip'.$ext);

	//Classi Equip
	$root = $dir.'/equip/equip';
	include($root.'/SpadaCipollosa'.$ext);

	//Items
	$root = $dir.'/item';
	include($root.'/TipoItem'.$ext);
	include($root.'/Item'.$ext);

	//Classi Items
	$root = $dir.'/item/item';
	include($root.'/Cipolla'.$ext);
	include($root.'/ArgentoPuro'.$ext);
	include($root.'/PozionePiccolaDellaForza'.$ext);
	include($root.'/PozionePiccolaDellaMagia'.$ext);
	include($root.'/PozionePiccolaDelCaos'.$ext);
	*/

	function autoloadItem($class_name) {
    	$filename = "classes/item/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiItem($class_name) {
    	$filename = "classes/item/item/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadNpc($class_name) {
    	$filename = "classes/npc/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiNpc($class_name) {
    	$filename = "classes/npc/npc/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadMob($class_name) {
    	$filename = "classes/mob/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiMob($class_name) {
    	$filename = "classes/mob/mob/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadAbstract($class_name) {
    	$filename = "classes/abstract/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadKeyboard($class_name) {
    	$filename = "classes/keyboard/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadLuogo($class_name) {
    	$filename = "classes/luogo/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiSottoluogo($class_name) {
    	$filename = "classes/luogo/sottoluogo/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadUtente($class_name) {
    	$filename = "classes/utente/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadRazze($class_name) {
    	$filename = "classes/utente/razze/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadEquip($class_name) {
    	$filename = "classes/equip/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiEquip($class_name) {
    	$filename = "classes/equip/equip/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadOvertime($class_name) {
    	$filename = "classes/overTime/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiOvertime($class_name) {
    	$filename = "classes/overTime/overTime/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiSkill($class_name) {
    	$filename = "classes/skill/skill/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadSkill($class_name) {
    	$filename = "classes/skill/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadEsplorazione($class_name) {
    	$filename = "classes/esplorazione/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiEsplorazione($class_name) {
    	$filename = "classes/esplorazione/Esplorazione/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadQuest($class_name) {
    	$filename = "classes/quest/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiQuest($class_name) {
    	$filename = "classes/quest/quest/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadGilda($class_name) {
    	$filename = "classes/gilda/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiGilda($class_name) {
    	$filename = "classes/gilda/gilda/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiTipoMobCategoria($class_name) {
    	$filename = "classes/mob/categorie/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadFight($class_name) {
    	$filename = "classes/fight/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	function autoloadClassiFight($class_name) {
    	$filename = "classes/fight/fight/" . $class_name . ".php";
    	if (is_readable($filename)) {
        	require $filename;
    	}
	}

	spl_autoload_register("autoloadClassiEquip");
	spl_autoload_register("autoloadEquip");
	spl_autoload_register("autoloadRazze");
	spl_autoload_register("autoloadUtente");
	spl_autoload_register("autoloadEquip");
	spl_autoload_register("autoloadClassiSottoluogo");
	spl_autoload_register("autoloadLuogo");
	spl_autoload_register("autoloadKeyboard");
	spl_autoload_register("autoloadAbstract");
	spl_autoload_register("autoloadClassiMob");
	spl_autoload_register("autoloadMob");
	spl_autoload_register("autoloadClassiNpc");
	spl_autoload_register("autoloadNpc");
	spl_autoload_register("autoloadClassiItem");
	spl_autoload_register("autoloadItem");
	spl_autoload_register("autoloadOvertime");
	spl_autoload_register("autoloadClassiOvertime");
	spl_autoload_register("autoloadClassiSkill");
	spl_autoload_register("autoloadSkill");
	spl_autoload_register("autoloadEsplorazione");
	spl_autoload_register("autoloadClassiEsplorazione");
	spl_autoload_register("autoloadQuest");
	spl_autoload_register("autoloadClassiQuest");
	spl_autoload_register("autoloadGilda");
	spl_autoload_register("autoloadClassiGilda");
	spl_autoload_register("autoloadClassiTipoMobCategoria");
	spl_autoload_register("autoloadFight");
	spl_autoload_register("autoloadClassiFight");
