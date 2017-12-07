<?php
	include('includeAll.php');
	$content = file_get_contents("php://input");
	$update = json_decode($content, true);

	//if(isset($_GET['msg'])){	}

	if(!$update)
	{
	exit;
	}

	$message    = isset($update['message'])             ? 	$update['message']            : "";
	$messageId  = isset($message['message_id'])         ? 	$message['message_id']        : "";
	$chatId     = isset($message['chat']['id'])         ? 	$message['chat']['id']        : "";
	$firstname  = isset($message['chat']['first_name']) ? 	$message['chat']['first_name']: "";
	$lastname   = isset($message['chat']['last_name'])  ? 	$message['chat']['last_name'] : "";
	$username   = isset($message['chat']['username'])   ? 	$message['chat']['username']  : "";
	$date       = isset($message['date'])               ? 	$message['date']              : "";
	$text       = isset($message['text'])               ? 	$message['text']              : "";

	//include('conf/config.php');

	$keyboardstart = '{ "keyboard": [';
	$keyboardend = '], "one_time_keyboard": true}';

	//$con = $db;

	$con = new Database();
	$db = new Functions();

	//Funzione per inviare un messaggio sulla chat dell'utente
	function sendMessage($msg, $chatId, $keyboard = null){
		global $keyboartstart;
		global $keyboardend;
		header("Content-Type: application/json");
		$parameters = array('chat_id' => $chatId, "text" => $msg);
		$parameters["method"] = "sendMessage";
		$parameters["parse_mode"] = "HTML";
		//$keyboard = ['inline_keyboard' => [[['text' =>  'myText', 'callback_data' => 'myCallbackText']]]];
		//$parameters["reply_markup"] = json_encode($keyboard, true);
		//'{ "keyboard": [["uno"], ["due"], ["tre"], ["quattro"]], "one_time_keyboard": true}'
		if($keyboard !== null) $parameters["reply_markup"] = '{ "keyboard": ['.$keyboard.'], "one_time_keyboard": false, "resize_keyboard" : true}';//$keyboartstart . $keyboard . $keyboardend;
		echo json_encode($parameters);
		die();
	}

	/*
	function emoji($emoji_name){
		global $con;
		$q = "SELECT EMOJI_UNICODE FROM BOT_RPG_EMOJI WHERE EMOJI_NOME = '".$emoji_name."'";
		$res = $con->query($q);
		$row = $res->fetch_object();
		return $row->EMOJI_UNICODE;
	}

	/*
	function emoji($emoji_name){
		switch($emoji_name){
			case "ANGRY_RED_FACE";
				return "\xF0\x9F\x98\xA1";

			case "SWEATY_HAPPY_FACE";
				return "\xF0\x9F\x98\x85";
		}
	}
	*/

	//sendMessage(getUTENTE_STATO_REGISTRAZIONE_ID($username), $chatId);
	//keyboard();

	//sendMessage($db->isRegistered($username, $chatId), $chatId);

	//Controlla se è già registrato oppure no
	//$db = new Database();
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

	$id = $db->getIdFromTelegramId($username);

	switch(ucfirst($db->getClasseNomeFromUtenteId($id))){
		case 'Guerriero':
			$ut = new Guerriero($id);
		break;

		case 'Mago':
			$ut = new Mago($id);
		break;

		case 'Sacerdote':
			$ut = new Sacerdote($id);
		break;

		case 'Ladro':
			$ut = new Ladro($id);
		break;

		case 'Arciere':
			$ut = new Arciere($id);
		break;
	}

	if($text == '/admin_delete_account'){
		$db->deleteAccount($id);
		sendMessage('Account cancellato', $chatId);
	}

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
				$msg = 'Adesso scegli la tua classe tra quelle disponibili';
				$keyboard = $db->selectALL_CLASSE_NOME_BUTTON();
			}else{
				$msg = 'Inserisci il tuo nick (Massimo 10 caratteri, minimo 3)';
				$keyboard = '["Inserisci nick"]';
			}

			sendMessage($msg, $chatId, $keyboard);
			break;

		//Conferma scelta classe
		case 2:
			if($db->updateClasse($id, $text)){
				$msg = 'Classe impostata con successo!';
				$keyboard = '["Scheda personaggio"], ["Equipaggiamento"], ["Viaggio"], ["Posizione"], ["Cerca Rogne"]';
				$db->aumUTENTE_STATO_REGISTRAZIONE_ID($id);
			}else{
				$msg = 'Scegli una classe esistente! Non provare a fare il furbo.';
				$keyboard = $db->selectALL_CLASSE_NOME_BUTTON();
			}
			sendMessage($msg, $chatId, $keyboard);
			break;
	}

	//sendMessage('La tua forza è '. $ut->getTotalStat('FORZA'), $ut->getChatId());

	//sendMessage('Forza: '. $ut->getTotalStat('FORZA'), $ut->getChatId(), $keyboard);

	/*
	Menu Principale 0:{
		Scheda Personaggio:
		Equipaggiamento:
	}




	*/
	$classiEmoji = array(
		'Guerriero' => "\xF0\x9F\x91\xA8",
		'Mago' => "\xF0\x9F\x94\xA5",
		'Chierico' => "\xF0\x9F\x99\x8F",
		'Ranger' => "\xF0\x9F\x92\x98",
		'Ladro' => "\xF0\x9F\x94\xAA"
	);

	//$menuPrincipale = $ut->getNome() . ' ('.$ut->getLevel().')' . "\n" . ucfirst($ut->getClasse()) . ' ' . $classiEmoji[ucfirst($ut->getClasse())];

	$menuPrincipale = $ut->printUtenteInfo();

	$kMenuPrincipale = '["Documento", "Spostati"],["Scheda personaggio", "Equipaggiamento"], ["Viaggio", "Posizione"], ["Cerca Rogne", "Skills"]';
	$kViaggio = '["Selezione Luogo"], ["Torna al menu principale"]';
	$kBattle = '["Attacca"], ["Abilità"], ["Scappa"]';
	$kRespawn = '["Respawn"]';
	//$kSottoluoghi = $db->selectAllSottoluoghiFromLuogoId($ut->)
	$kLuoghi = $db->selectALL_LUOGO_NOME_BUTTON();
	$kSkills = $ut->getSkillsButtons();
	//$kMobs = $db->keyboardFormat($ut->selectAllMobs());

	$arrKeyboard = array(
		'Scheda personaggio' => $kMenuPrincipale,
		'Equipaggiamento' => $kMenuPrincipale,
		'Viaggio' => $kViaggio,
		'Selezione Luogo' => $kLuoghi,
		'Torna al menu principale' => $kMenuPrincipale,
		'Posizione' => $kMenuPrincipale,
		'Vai a' => $kMenuPrincipale,
		'Viaggio_err' => $kLuoghi,
		'Viaggio_ok' => $kMenuPrincipale,
		'Cerca Rogne' => $kBattle,
		'Scappa' => $kMenuPrincipale,
		'Morto' => $kRespawn,
		'Abilità' => $kSkills,
		'Skills' => $kSkills,
		'Documento' => $kMenuPrincipale
		//'Seleziona Target' => $kMobs
	);

	/*
	$arrKeyboard = array(
		0 => $kMenuPrincipale,
		1 => $kViaggio,
		2 => $kLuoghi
	);
	*/

	$arrStati = array(
		'Scheda personaggio' => 0,
		'Equipaggiamento' => 0,
		'Documento' => 0,
		'Viaggio' => 1,
		'Selezione Luogo' => 2,
		'Torna al menu principale' => 0,
		'Posizione' => 0,
		'Vai a' => 0,
		'Viaggio_err' => 2,
		'Viaggio_ok' => 5,
		'Cerca Rogne' => 3,
		'Scappa' => 0,
		'Morto' => 4,
		'Abilità' => 6,
		'Skills' => 7,
		'Seleziona Target' => 8
	);

	//sendMessage('ciao', $ut->getChatId());

	$stato = $ut->getUtenteStatoId();

	switch($ut->getUtenteStatoId()){


		case 0: //Menu principale
			//$keyboard = '["Scheda personaggio"], ["Equipaggiamento"], ["Viaggio"]';
			//$msg = 'Menu principale';
				switch($text){

					case 'Scheda personaggio':
						$msg = $ut->printUtenteInfo();
						//$ut->sendMessage($msg);
					break;


					case 'Equipaggiamento':
						if($ut->hasSomethingEquipped()){
							$ids = array();
							$ids = $ut->getIdsEquipActive();
							for($i = 0; $i < count($ids); $i++){
								$msg .= $ut->getEquipInfo($ids[$i]) . "\n\n";
							}
						}else{
							$msg .= 'Non hai oggetti equipaggati!';
						}
					break;


					case 'Viaggio': //Go to 1
						$msg = 'E così desideri viaggiare.';
					break;

					case 'Posizione':
						$msg = 'Posizione: ' . $ut->getOBJSottoluogo()->getSottoluogoNome() . ' (' . $ut->getOBJSottoluogo()->getLuogoNome() . ')';
					break;

					case 'Cerca Rogne': //Go to 3;
						$db->spawnMob($ut);
						$msg = 'Ecco le Rogne!'."\n";
						$msg .= $ut->printMobs();
					break;

					case 'Skills':
						$msg = 'Scegli la skill da utilizzare.';
					break;

					case 'Documento':
						$ut->sendProfilePic();
						$msg = 'Che bello che sei!';
					break;

				}
		break;





		case 1: //Viaggio
			//$keyboard = '["Selezione Luogo"], ["Torna al menu principale"]';
			switch($text){
				case 'Torna al menu principale':
					$msg = $menuPrincipale;
				break;

				case 'Selezione Luogo':
					$msg = 'Selezione in corso... ' . "\n";
					$msg .= $ut->getOBJSottoluogo()->printDistanceFromAllOtherLuogo();
				break;
			}
		break;




		case 2: //Selezione Luogo per viaggio
			if($db->doesLuogoExist($text)){ //Go to 5
				$partenza = new Luogo($ut->getOBJSottoluogo()->getLuogoId());
				$destinazione = new Luogo($db->getIdFromLuogoNome($text));
				$ut->viaggio($partenza, $destinazione);
				$ut->setUtenteSottoluogoId($destinazione->getRandomSottoluogoId());
				$msg = 'In viaggio per ' . $text;
				$text = 'Viaggio_ok';
			}else{
				switch($text){
					case 'Torna al menu principale':
						$msg = 'Menu principale';
					break;

					default:
						$msg = 'Luogo non esistente.';
						$text = 'Viaggio_err';
				}
			}
		break;




		case 3: //Battaglia
			if(!$ut->areThereMobs()){
				$msg = "Non c'è nessuno...";
				$text = 'Torna al menu principale';
				break;
			}
			$mob = new Mob($ut->scanForMob());
			switch($text){
				case 'Seleziona Target':
			  	$msg = 'Scegli target';
				break;

				case 'Abilità':
					$msg .= 'Scegli una skill';
				break;

				case 'Scappa':
					$msg = 'Scampato pericolo!';
				break;
			}
		break;



		case 4: //Respawn
			switch($text){
				case 'Respawn':
					$ut->respawn();
					$msg = 'Sei tornato in vita!';
					$text = 'Torna al menu principale';
				break;
			}
		break;


		case 5: //In Viaggio
			if($ut->isInViaggio()){
				$msg = 'Sei ancora in viaggio fino a ' . $ut->getTempoRimanenteViaggio();
				$text = 'Viaggio_ok';
			}else{
				$msg = 'Viaggio terminato!';
				$text = 'Torna al menu principale';
			}
		break;


		case 6: //Lista abilità
			if(!$ut->areThereMobs()){
				$msg = "Non c'è nessuno...";
				$text = 'Torna al menu principale';
				break;
			}

			$mob = new Mob($ut->scanForMob());
			$S = new Skill($text);
			$msg .= "<b>" . $ut->useSkill($S, $mob) . "</b>\n";
			//$msg .= "<b>" . $ut->useSkill($text, $mob) . "</b>\n";
			if($mob->getMobHp() > 0){
				$msg .= $mob->getNome() . " ti ha inflitto ". $mob->attacca($ut) . " danni\n\n";
			}else{
				$ut->setUtenteSoldi($ut->getUtenteSoldi() + $mob->getTipoMobSoldi());
				$ut->setUtenteExp($ut->getUtenteExp() + $mob->getTipoMobExp());
				$D = new Drop($ut, $mob);
				$drop = true;
				$msg .= "Hai sconfitto " . $mob->getNome() . "\n";
				$msg .= "+" . $mob->getTipoMobSoldi() . " monete\n";
				$msg .= "+" . $mob->getTipoMobExp() . " exp\n";
			}

			if($ut->getUtenteHp() <= 0){
				$ut->setUtenteHp(0);
				$text = 'Morto';
				$msg .= 'Sei morto';
				break;
			}

			$msg .= $ut->getUtenteNome() .": ". $ut->getUtenteHp() . " HP\n";
			$msg .= $mob->getNome() .": ". $mob->getMobHp() . " HP";

			$ut->sendMessage($msg);
			if($drop) $ut->sendMessage($D->send());
			$ut->sendMessage($ut->printMobs());
			$msg = '-';

			$text = 'Cerca Rogne';
		break;

		case 7:
			$msg = '';
			$sk = new Skill($text);
			$msg .= $ut->useSkill($sk);
			//$ut->sendMessage($ut->printMobs());
			$text = 'Torna al menu principale';
		break;

		case 8:
			$msg = 'Target Selezionato';

			$text = 'Target Selezionato';
		break;


	}

	if($text == 'Torna al menu principale'){
		$msg = $menuPrincipale;
	}

	if(!is_null($msg)){
		$ut->setUtenteStatoId($arrStati[$text]);
		sendMessage($msg, $ut->getUtenteChatId(), $arrKeyboard[$text]);
	}
	else
		sendMessage('Invalid', $ut->getUtenteChatId());

	/*
	//SEND MESSAGE
	//$text = $message['chat']['username'];
	header("Content-Type: application/json");
	$parameters = array('chat_id' => $chatId, "text" => $text);
	$parameters["method"] = "sendMessage";
	echo json_encode($parameters);
	/****************/

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
