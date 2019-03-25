<?php
	//ini_set('memory_limit', '512M');
	date_default_timezone_set('Europe/Rome');
	//PROFILER
	// Call this at each point of interest, passing a descriptive string
	$prof_timing = array();
	$prof_names = array();
	function prof_flag($str)
	{
	    global $prof_timing, $prof_names;
	    $prof_timing[] = microtime(true);
	    $prof_names[] = $str;
	}

	// Call this when you're done and want to see the results
	function prof_print()
	{
	    global $prof_timing, $prof_names;
	    $size = count($prof_timing);
	    $msg = '';
	    for($i=0;$i<$size - 1; $i++)
	    {
	        $msg .= "<b>{$prof_names[$i]}</b>\n";
	        $msg .= $prof_timing[$i+1]-$prof_timing[$i]."\n";
	    }
	    return $msg .= "<b>{$prof_names[$size-1]}</b>\n";
	}
	//////////
	//prof_flag('INCLUDE ALL');

	$time_start = microtime(true);
	prof_flag('EMOJI');
	include('emoji.php');
	include('sticker.php');
	prof_flag('INCLUDE ALL');
	include('includeAll.php');

	//prof_flag('INIT');
	$content = file_get_contents("php://input");
	$update = json_decode($content, true);

	//if(isset($_GET['msg'])){	}
	//mail('lorenzo.dona97@gmail.com', 'main.php', 'Arrivo 1');


	if(!$update)
	{
	exit;
	}

	//mail('lorenzo.dona97@gmail.com', 'main.php', 'Arrivo 2');


	$message    	= isset($update['message'])             ? 	$update['message']            : "";
	$messageId 		= isset($message['message_id'])         ?   $message['message_id']         : "";
	//$messageId  	= isset($message['message_id'])         ? 	$message['message_id']        : "";
	$chatId     	= isset($message['chat']['id'])         ? 	$message['chat']['id']        : "";
	//$firstname  	= isset($message['chat']['first_name']) ? 	$message['chat']['first_name']: "";
	//$lastname   	= isset($message['chat']['last_name'])  ? 	$message['chat']['last_name'] : "";
	$username   	= isset($message['chat']['username'])   ? 	$message['chat']['username']  : "";
	//$date       	= isset($message['date'])               ? 	$message['date']              : "";
	$text       	= isset($message['text'])               ? 	$message['text']              : "";

	//INLINE
	$cbqID 			= isset($update['callback_query']['id']) 				? $update['callback_query']['id']	: "";
	$cbqData		= isset($update['callback_query']['data']) 				? $update['callback_query']['data']			: "";
	$username 		= isset($update['callback_query']['from']['username'])  ? $update['callback_query']['from']['username'] : $username;



	//$text = "Scheda";
	//$username = "CortoMaItese";
	//$chatId = '353877764';


	$keyboardstart = '{ "keyboard": [';
	$keyboardend = '], "one_time_keyboard": true}';

	prof_flag('START');

	$db = new Functions();

	function ArrMsgDmg($msg, $dmg){
		$data = array();
		$data['msg'] = $msg;
		$data['dmg'] = $dmg;
		return $data;
	}

	function getOBJ($className, $id, &$ut){
		$class = $className.$id;
		if(class_exists($class)){
			$OBJ = new $class($ut);
		}else{
			$OBJ = new $className($id);
		}
		return $OBJ;
	}

	$hasSentImage = false;
	$hasEnteredBattle = false;
	$hasEnteredDuel = false;
	//writeChannel('PROVA PROVA PROVA');

	//Funzione per inviare un messaggio sulla chat dell'utente
	function sendMessage($msg, $chatId, $keyboard = null){
		global $keyboartstart;
		global $keyboardend;
		header("Content-Type: application/json");
		$parameters = array('chat_id' => $chatId, "text" => $msg);
		$parameters["method"] = "sendMessage";
		$parameters["parse_mode"] = "HTML";
		global $messageId;
		//$parameters["reply_to_message_id"] = $messageId;
		global $inline;
		if($keyboard !== null){
			if(!$inline){
				$parameters["reply_markup"] = '{ "keyboard": ['.$keyboard.'], "one_time_keyboard": false, "resize_keyboard" : true}';
			}else{
				//$keyboard = ['inline_keyboard' => [[['text' =>  'myText', 'callback_data' => 'myCallbackText']]]];
				$parameters["reply_markup"] = json_encode($keyboard, true);
			}
		}
		//global $ut;
		//$ut->sendMessage(json_encode($parameters));
		echo json_encode($parameters);
		die();
	}

	if($username == ""){
		sendMessage('Per poter utilizzare questo bot hai bisogno di un username (es. @CortoMaItese)', $chatId);
	}

	//$text = str_replace('/', '', $text);

	function remove_emoji($string) {
    	// Match Emoticons
    	$regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
    	$clear_string = preg_replace($regex_emoticons, '', $string);

	    	// Match Miscellaneous Symbols and Pictographs
	    	$regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
	    	$clear_string = preg_replace($regex_symbols, '', $clear_string);

	    	// Match Transport And Map Symbols
	    	$regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
	    	$clear_string = preg_replace($regex_transport, '', $clear_string);

	    	// Match Miscellaneous Symbols
	    	$regex_misc = '/[\x{2600}-\x{26FF}]/u';
	    	$clear_string = preg_replace($regex_misc, '', $clear_string);

	    	// Match Dingbats
	    	$regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
	    	$clear_string = preg_replace($regex_dingbats, '', $clear_string);

    	return $clear_string;
	}

	$rawText = $text;

	$text = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
	$text = remove_emoji($text);

	$text = trim($text);

	$text = Database()->real_escape_string($text);

	if(!$db->isRegistered($username)){
		//Controlla se vuole registrarsi
		if($text == '/start'){
			$db->register($username, $chatId);
		}else{
			$msg = 'Non sei registrato, registrati con il comando /start ' . $username;
			sendMessage($msg, $chatId);
		}
	}

	if(!$db->isRegistered($username)) die();

	prof_flag('GET_ID');
	$id = $db->getIdFromTelegramId($username);
	prof_flag('UOMO');
	$razzaId = Functions::getUtenteRazzaIdById($id);
	$classRazzaName = 'Razza'.$razzaId;
	$ut = new $classRazzaName($id);
	$lvl = $ut->calculateLevel();
	//$ut->deleteMessage($messageId);

	if(!$ut->isDonny()){
		$ut->sendMessage('<b>BOT IN MANUTENZIONE</b>'."\n");
		die();
	}

	include('keyboards.php');

	if($text == '/forcemenu'){
		$msg = 'Debug mode'."\n\n";
		$flfm = false;
		$statoId = $ut->getUtenteStatoId();
		$arrBattle = array(13, 6, 8, 3, 18);
		$n = count($arrBattle);
		for($i = 0; $i < $n && !$flfm; $i++){
			if($arrBattle[$i] == $statoId){
				$flfm = true;
				$ut->setUtenteStatoId(3);
				$key = kBattle();
			}
		}

		if(!$flfm){
			$ut->setUtenteStatoId(0);
			$key = kMenuPrincipale();
		}
	}

	//Admin Panel

	function isAdmin(){
		global $ut;
		$Donny = 12;
		$Vetto = 13;
		$adminIds = array($Donny, $Vetto);
		$n = count($adminIds);
		$isAdmin = false;
		$id = $ut->getId();

		for($i = 0; $i < $n; $i++){
			if($id == $adminIds[$i])
				return true;;
		}
	}

	$isAdmin = isAdmin();

	if($text == '/admin_panel'){
		if($isAdmin){
			write("Admin Panel\n");
			write("Per imparare tutte le skill");
			write("/admin_learn_all_skills_512\n");
			write("Per visualizzare la tastiera più lunga");
			write("/endless_keyboard\n");
			write("Per Telestraportarsi");
			write("/admin_teleport\n");
			write("Per cancellare i punti statistica");
			write("/delete_points\n");
			write("Per inviare un idea");
			write("/idea testo\n");
		}else{
			//write('Access Denied');
		}
	}

	if($text == '/admin_memo' && $isAdmin){
		$ut->sendMessage($ut->getMemo('STUN'));
	}

 	if($text == '/admin_learn_all_skills_512' && $isAdmin){
 		$utenteId = $ut->getId();
 		$sql = "SELECT SKILL_ID FROM BOT_RPG_SKILL WHERE SKILL_ID NOT IN (SELECT LEARNED_SKILL_SKILL_ID FROM BOT_RPG_LEARNED_SKILL WHERE LEARNED_SKILL_UTENTE_ID = ".$ut->getId().")";
 		$res = Database()->query($sql);
 		while($row = $res->fetch_object()){
 			$idd = $row->SKILL_ID;
 			$sql = "INSERT INTO BOT_RPG_LEARNED_SKILL VALUES($idd, $utenteId, 1, 0)";
 			Database()->query($sql);
 		}
 		write('Hai imparato tutte le skill disponibili!');
 	}

 	if(str_split($text, 6)[0] == '/daiEq' && $isAdmin){
 		$txt = explode(' ', $text);
 		$sql = "SELECT MAX(EQUIP_ID) + 1 AS M FROM BOT_RPG_EQUIP";
 		$maxId = Database()->query($sql)->fetch_object()->M;
 		$sql = "INSERT INTO BOT_RPG_EQUIP VALUES ($maxId, ".intval($txt[2]).", ".intval($txt[1]).", 1, 0)";
 		//$ut->sendMessage($sql);
 		Database()->query($sql);
 		write('Equip consegnato con successo');
 	}

 	if(str_split($text, 6)[0] == '/daiIt' && $isAdmin){
 		$txt = explode(' ', $text);
 		$TARGET = new Utente(intval($txt[2]));
 		$TARGET->giveItem(intval($txt[1]), intval($txt[3]));
 		write('Item consegnato con successo');
 	}

 	if($text == '/endless_keyboard' && $isAdmin){
 		$k = new Keyboard();
 		$n = 213;
 		for($i = 0; $i < $n; $i++){
 			$k->push('Button '.$i);
 		}

 		$key = $k;
 		write('Tastiera di '.$n.' Bottoni');
 	}

 	if($text == '/admin_teleport' && $isAdmin){
 		$sql = "SELECT SOTTOLUOGO_ID, SOTTOLUOGO_NOME, LUOGO_NOME FROM BOT_RPG_SOTTOLUOGO, BOT_RPG_LUOGO WHERE LUOGO_ID = SOTTOLUOGO_LUOGO_ID";
 		$res = Database()->query($sql);
 		while($row = $res->fetch_object()){
 			write($row->SOTTOLUOGO_NOME.' ('.$row->LUOGO_NOME.')'."\n/tp".$row->SOTTOLUOGO_ID."\n");
 		}
 	}

 	if(str_split($text, 3)[0] == '/tp' && $isAdmin){
 		$ut->setUtenteStatoId(0);
		$key = kMenuPrincipale();
 		$ut->setUtenteSottoluogoId(substr($text, 3));
 		write('Sei stato teletrasportato');
 	}

 	if($text == '/delete_points' && $isAdmin){
 		$id = $ut->getId();
 		$sql = "DELETE FROM BOT_RPG_STAT_PUNTI WHERE UTENTE_ID = $id";
 		Database()->query($sql);
 		write('Punti cancellati con successo.');
 		write('Divertiti a rimetterli!');
 	}

 	if(str_split($text, 5)[0] == '/idea'){
 		$text = substr($text, 5);
 		$text = trim($text);
 		$id = $ut->getId();
 		$text = Database()->real_escape_string($text);
 		$sql = "INSERT INTO BOT_RPG_IDEA VALUES(NULL, '$text', NOW(), 0, $id)";
 		Database()->query($sql);
 		write('Buona idea! Grazie del contributo');
 	}





 	//END Admin Panel
	//prof_flag('AFTER DB');

	/*
	if($text == '/admin_delete_account'){
		$db->deleteAccount($id);
		sendMessage('Account cancellato', $chatId);
	}
	*/


	prof_flag('FASI REGISTRAZIONE');
	//SWITCH PER LE FASI DELLA REGISTRAZIONE
	switch($db->getUTENTE_STATO_REGISTRAZIONE_ID($id)){
		//Scelta nickname
		case 0:
			$msg = 'Devi scegliere un nickname con il quale sarai conosciuto dagli altri giocatori';
			$keyboard = '["Va bene"], ["Non voglio"]';
			if(strpos($text, 'Va bene') !== false){
				$msg = 'Inserisci il tuo nick (Massimo 10 caratteri, minimo 3)';
				$keyboard = '["Inserisci nick"]';
				$db->aumUTENTE_STATO_REGISTRAZIONE_ID($id);
			}

			if(strpos($text, 'Non voglio') !== false){
				$msg = 'Senti ciccio, è il mio gioco e decido io: scegli un nick';
			}

			sendMessage($msg, $chatId, $keyboard);
			break;

		//Scelta classe
		case 1:
			if(strlen($text) < 11 && strlen($text) > 2){
				$db->updateUTENTE_NICKNAME($id, $text);
				$db->aumUTENTE_STATO_REGISTRAZIONE_ID($id);
				$msg = 'Ora puoi nascere, chissà dove nascerai...';
				$keyboard = '["Nasci"]';//$db->selectALL_CLASSE_NOME_BUTTON();
			}else{
				$msg = 'Inserisci il tuo nick (Massimo 10 caratteri, minimo 3)';
				$keyboard = '["Inserisci nick"]';
			}

			sendMessage($msg, $chatId, $keyboard);
			break;

		//Conferma scelta classe


		case 2:
			if($text == "Nasci"){
				$msg = 'Sei nato.';
				$keyboard = '["Apri gli occhi"]';
				$db->aumUTENTE_STATO_REGISTRAZIONE_ID($id);
			}else{
				$msg = 'Devi nascere...';
				//$keyboard = $db->selectALL_CLASSE_NOME_BUTTON();
				$keyboard = '["Apri gli occhi"]';
			}
			sendMessage($msg, $chatId, $keyboard);
			break;

		case 3:
			$key = null;
			$ut->startGame();
			$ut->sendMessage($msg, $key);
			die();
			break;
	}

	//$lu = new Sottoluogo($ut->getUtenteSottoluogoId());

	//prof_flag('KEYBOARDS');

	//$messageId = $ut->sendMessage('Prova');
	//$ut->sendMessage($messageId.' questo è l\'id del messaggio sopra');

	//$menuPrincipale = $ut->printUtenteInfo();

	//$stato = $ut->getUtenteStatoId();
	include('megaSwitch.php');

	prof_flag('LA FINE');

	$ut->updateUtenteDataLastCommand();

	if($hasEnteredBattle){
		prof_flag('BATTLE1');

		//$ut->triggerPreOvertimes();

		$res = 0;

		//$ut->loadEnemies();
		//$Mobs = $ut->getEnemies();

		if($hasUsedSkill)
			$res = $ut->useSkill($mobId, $tipoMobId);

		if($mosso && $dirMosso !== null)
			$res = $ut->walk($dirMosso);

		if($res == 0)
			$ut->battleFlow();

		if(!$ut->areThereMobs()){
			$ut->battleRecap();
			$ut->clearAllMobHere();
			$key = kMenuPrincipale();
			$ut->setUtenteStatoId(0);
		}

		$msg = preg_replace("/\n+/", "\n\n", $msg);

		prof_flag('BATTLE4');
	}

	if($hasEnteredDuel){
		if($ut->isVivo()){
			$ut->lowerBuff();
			$ut->lowerCooldowns();
			$ut->triggerOvertimes();
			$ut->triggerEquipsEffect();
			$msg .= 'È il turno di '.$en->getNome()."\n";
		}else{
			$msg .= $en->getNome().' ha vinto il duello!'."\n";
			$key = kRespawn();
			$ut->setUtenteStatoId(4);
			$en->setUtenteStatoId(0);
			$en->sendMessage('Hai vinto!', kMenuPrincipale());
			$db->terminaDuello($en->getId());
			$hasEnteredDuel = false;

		}
	}

	if($hasEnteredDuel){
		if($en->isVivo()){
			$en->lowerBuff();
			$en->triggerOvertimes();
			$en->triggerEquipsEffect();
			//$enKey = $key;
		}else{
			$msg .= $ut->getNome().' ha vinto il duello!'."\n";
			$enKey = kRespawn();
			$en->setUtenteStatoId(4);
			$ut->setUtenteStatoId(0);
			$key = kMenuPrincipale();
			$db->terminaDuello($ut->getId());
		}
			$en->sendMessage($msg, $enKey);
			$db->switchTurnoDuello($en->getId());
	}


	//$livello = $ut->calculateLevel();
	//$ut->sendMessage($livello.' non è maggiore di '.$lvl);
	$livello = $ut->calculateRealLevel();
	if($livello > $lvl){
		write('<b>AUMENTO DI LIVELLO: '.$lvl.' -> '.$livello.'</b>');
		//$ut->sendVideo('CgADBAADLgMAAoJRmFCs-mAOFSda5AI');
	}

	if(!$ut->isVivo()){
		$ut->die();
		$key = kRespawn();
		$ut->setUtenteStatoId(4);
	}

	if($hasSentImage){
		//$time_end = microtime(true);
		//$ut->sendMessage('Execution time: '.round(($time_end - $time_start), 3).' seconds');
		die();
	}

	/*
	if($ut->getId() == 13){
		write("\n\n\n".'Smettila di fumare. Il fumo uccide... io lo dico per te. Conosco persone morte per il fumo da quando sono bambino, per questo non fumo. Perfavore... smettila');
	}
	*/
	$ut->sendMessage(var_dump($ut->doSendFinalMessage()));
	if($msg != '' && $ut->doSendFinalMessage()){
		//$msg = str_replace("\n", "\n\n", $msg);

		$maxLen = 4000;
		while(strlen($msg) >= $maxLen){
			$ut->sendMessage(substr($msg, 0, $maxLen));
			$msg = substr($msg, $maxLen, strlen($msg));
		}

		//if(class_exists('Item'))
			//$ut->sendMessage($msg, $key);
		//else
		//sendMessage($msg, $ut->getUtenteChatId(), $key);
		$time_end = microtime(true);
		//$msg = $msg."\n".'Execution time: '.round(($time_end - $time_start), 3).' seconds';
		if(!isset($key)) $key = null;
		if($ut->doSendFinalMessage())
			$ut->sendMessage($msg, $key);
		if(isset($stick)) $ut->sendSticker($stick);
		prof_flag('FINE');
		$tempoEsecuzione = round(($time_end - $time_start), 3);
	}
	else
		sendMessage('Comando non valido, se stai riscontrando un comportamento anomalo, usa questo comando /forcemenu', $ut->getUtenteChatId());

	if($ut->isDonny())
			$ut->sendMessage('Execution time: '.$tempoEsecuzione.' seconds');

	$ut->saveCommand($rawText, $msg, $tempoEsecuzione);

	//$ut->sendMessage('Execution time: '.round(($time_end - $time_start), 3).' seconds');

	//$dbconn->close();
	//if($ut->isDonny())
		//$ut->sendMessage(prof_print());


	/*SEND IMAGE
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("img/nigiri.png")), 'caption' => $text);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	/***********************************************/
