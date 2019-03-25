<?php
	$inline = false;
	prof_flag('INIZIO SWITCH');
	switch($ut->getUtenteStatoId()){
		case 0: //Menu principale
				switch($text){
					case 'Inline':
						$inline = true;
						$key = ['inline_keyboard' => [
							[
								['text' =>  'myText', 'callback_data' => '1']
							],
							[
								['text' =>  'myText', 'callback_data' => '2']
							],
						]];
						$msg = 'Inline';
						$ut->setUtenteStatoId(20);
					break;

					case 'Scheda':
						$ut->showScheda();
						$key = kProfilo();
						$ut->setUtenteStatoId(33);
					break;


					case 'Equip':
						write($ut->printEquip());
						$key = kEquipManager();
						//$ut->sendSticker($sticker['EQUIPAGGIAMENTO']);
						$ut->setUtenteStatoId(14);
					break;


					case 'Viaggio': //Go to 1
						write('E così desideri viaggiare.');
						$key = kViaggio();
						$ut->setUtenteStatoId(1);
					break;

					case 'Posizione':
						//prof_flag('POSIZIONE');
						$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
						$msg = '<b>'.$sl->getSottoluogoNome() . '</b>'."\n".'(' . $sl->getLuogoNome() . ')'."\n\n";
						$msg .= $sl->getSottoluogoDesc();
						//$msg .= $sl->drawMap();
						//$msg .= $sl->getSottoluogoNome() . ' (' . $sl->getLuogoNome() . ')'."\n";
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);

						if($sl->hasImgPath() && $ut->isDonny()){
							if($sl->hasTelegramFileId()){
								$output = $ut->sendImageById($sl->getTelegramFileId(), $msg);
								if(!json_decode($output)->ok){
									$output = $ut->sendImage($sl->getImgPath(), $msg);
									$sl->setTelegramFileId(json_decode($output)->result->photo[0]->file_id);
								}
							}
							else{
								$output = $ut->sendImage($sl->getImgPath(), $msg);
								$sl->setTelegramFileId(json_decode($output)->result->photo[0]->file_id);
							}

							$hasSentImage = true;
						}
					break;

					case 'Cerca Rogne': //Go to 3;
						//$db->spawnMob($ut);
						$className = 'Sottoluogo'.$ut->getUtenteSottoluogoId();
						$sl = new $className($ut);
						
						//$db->spostaMob($ut);

						$tipoFightId = 0;
						$utenteId = $ut->getId();
						$sottoluogoId = $ut->getUtenteSottoluogoId();
						$maxPlayerAllowed = 2;

						$Fight = Fight::create($tipoFightId, $utenteId, $sottoluogoId, $maxPlayerAllowed);

						$Fight->addUtente($ut);
						$Fight->setSottoluogo($sl);
						$Fight->initialize();

						//$ut->sendSticker($sticker['CERCA_ROGNE']);
					break;

					case 'Spostati':
						$msg = 'Scegli dove andare';
						$key = kNearSottoluoghi();
						$ut->setUtenteStatoId(10);
					break;

					case 'Skills':
						$msg = 'Scegli la skill da visualizzare.';
						$key = kSkills();
						$ut->setUtenteStatoId(7);
					break;

					case 'Documento':
						$ut->sendChatAction('upload_photo');
						$ut->sendProfilePic();
						$msg = 'Che bello che sei!';
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);
					break;

					case 'Azioni':
						write('Scegli azione');
						$ut->setUtenteStatoId(34);
						$key = kAzioni();
					break;

					case 'Item':
						//$key = kItems();
						//$key = kItemsInRange(1, 10);
						//$msg = $ut->printItems();
						$key = kScompartimenti();
						$msg = 'Scegli scompartimento o scrivi il nome di un item';
						$ut->setUtenteStatoId(9);
					break;

					case 'Utenti':
						$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
						$ut->printFriends();
						$msg .= $sl->printUtenti();
						$msg .= "\n"."Scrivi il nome di un utente";
						$key = new Keyboard();
						$key->push('Torna Indietro');
						$ut->setUtenteStatoId(21);
					break;

					case 'Aggiungi Punti':
						$msg = 'Scegli statistica';
						$key = kStats();
						$ut->setUtenteStatoId(11);
					break;

					case 'Craft':
						write('Scrivi il nome di un equip o scegli scompartimento');
						write();
						write('<b>Legenda</b>');
						write(GREEN_CHECKMARK.' ce l\'hai');
						write(HAMMER_AND_WRENCH.' puoi craftarlo');
						write(REAL_RED_CROSS.' non ce l\'hai');
						write(BANNED.' non puoi craftarlo');
						$key = kCraft();
						/*
						$key = new Keyboard();
						$key->push("Torna Indietro");
						$key->push("1");
						$key->push("2");
						*/
						$ut->setUtenteStatoId(12);
					break;

					case 'NPC':
						$arr = $ut->arrayNpcsIdSameSottoluogo();
						$n = count($arr);
						$err = 'Non ci sono npc al momento!';

						$msg = $n > 0 ? "Ci sono $n npc qui" : $err;
						$key = kNpc();
						$ut->setUtenteStatoId(17);
					break;

					case 'Gilda':
						$gildaId = $ut->isInGilda();
						if($gildaId === false){
							write('Non fai parte di alcuna gilda!');
							break;
						}

						$className = 'Gilda'.$gildaId;
						$Gilda = new $className($ut);
						$ut->setGilda($Gilda);
						$Gilda->mainMenu();
					break;

					case 'Info':
						write("<b>Equip</b>\nAttraverso questo tasto, puoi gestire i tuoi armamenti. Spada e armatura sono necessarie se vuoi sopravvivere la fuori. Potresti valutare di avere un arco o una balestra se ti piacciono di più. Magari anche un pugnale o un bastone magico, perché no!\nInsomma, qualcosa devi avere. Come dici? Non hai nulla? Non temere, posso darti qualcosina io per iniziare! Vai su Equip, poi inventario e vedrai i miei doni! Vuoi ottenerne altri? Alcuni puoi averli solamente attraverso delle Quest, molti sono craftabili e altri, invece, possono essere comprati in cambio di soldi(£).\n\n\n<b>Skill</b>\nLe skill sono molto importanti e possono essere usate in battaglia. Solamente attraverso un uso sapiente e astuto delle tue skill riuscirai a cavartela nei momenti peggiori. Qualche skill dovresti già conoscerla, per ottenerne altre dovresti trovare qualcuno che te le insegni!\n\n\n<b>Spostamento</b>\nPer conoscere la tua posizione, utilizza semplicemente il tasto Posizione. Per spostarti all'interno di un luogo, utilizza il pulsante Spostati. Per cambiare luogo, utilizza il pulsante viaggio. ATTENZIONE: non è sempre possibile viaggiare, dovrai spostarti per trovare il posto ideale da cui iniziare il viaggio\n\n\n<b>Battaglia</b>\nCliccando su Cerca Rogne inizierai una battaglia, sempre se troverai qualcuno con cui combattere. Dovrai prima selezionare una skill, dopodichè un bersaglio con il tasto Seleziona Target. Potrai inoltre muoverti, cliccando su Muovi e visualizzare il campo di battaglia cliccando su Mappa. Bada bene, potrai utilizzare solo le skill che il tuo equipaggiamento ti permette di utilizzare. Se hai una spada, non potrai utilizzare la skill Scaglia Freccia.\nPerché combattere? In primis, per i punti esperienza ottenuti sconfiggendo i nemici. Bada bene, dovrai vincere la battaglia per ottenere punti esperienza, ovvero sconfiggere ogni nemico. Otterrai anche soldi e oggetti, i cosiddetti item.\n\n\n<b>Item</b>\nGli item sono degli oggetti collezionabili. Ogni item ha una funzione diversa: alcuni possono essere usati per creare degli equip attraverso il crafting, altri possono essere utilizzati, come un panino da mangiare che restituisce vita, altri ancora possono essere lanciati in battaglia per arrecare danno al nemico.\n\n\nCredo di averti annoiato abbastanza. Se hai bisogno di riascoltare queste informazioni clicca sul pulsante Info! Buona avventura!\n\n");
							write("Tales Of Telegram 0.02 Alpha\n");
							write("Gruppo ufficiale di Tales Of Telegram:");
							write("https://t.me/joinchat/FRe_BFBh36gyYcSdPukcGA\n");
							write("Per chiarimenti o ulteriori informazioni contattare @CortoMaItese\n");
							write("Per donazioni (Mi raccomando specificare il vostro nick di Telegram nel messaggio)");
							write("https://www.paypal.me/LorenzoDonnyDona\n");
					break;
				}
		break;





		case 1: //Viaggio
			switch($text){
				case 'Torna al menu principale':
					$msg = $ut->printUtenteInfo();
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				case 'Selezione Luogo':
					$msg = 'Selezione in corso... ' . "\n";
					$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
					$msg .= $sl->printDistanceFromNearLuoghi();
					$key = kNearLuoghi();
					$ut->setUtenteStatoId(2);
				break;
			}
		break;




		case 2: //Selezione Luogo per viaggio
			if($db->doesLuogoExist($text)){ //Go to 5
				$id = $db->getIdFromLuogoNome($text);
				$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
				$partenza = new Luogo($sl->getLuogoId());

				if(!$sl->canTravel()){
					write('Non puoi viaggiare da questo posto!');
					break;
				}

				if(!$partenza->isLuogoNear($id)){
					$msg = 'Non puoi andare qui!';
					break;
				}
				$destinazione = new Luogo($id);
				$ut->viaggio($partenza, $destinazione);
				$ut->setUtenteSottoluogoId($destinazione->getLuogoSottoluogoArrivoId());
				$msg = 'In viaggio per ' . $text;
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(5);
			}else{
				switch($text){
					case 'Torna Indietro':
						$msg = 'Menu principale';
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);
					break;

					default:
						$msg = 'Luogo non esistente.';
						$key = kNearLuoghi();
						$ut->setUtenteStatoId(2);
				}
			}
		break;




		case 3: //Battaglia
			/*
			if(!$ut->areThereMobs()){
				$msg = "Hai vinto la battaglia!\n\n";
				$exp = $ut->getMemo('EXP_ACCUMULATA');
				$soldi = $ut->getMemo('SOLDI_ACCUMULATI');
				$ut->giveSoldi($soldi);
				write("Hai ottenuto $soldi monete!\n");
				$ut->giveExp($exp);
				write("Hai ottenuto $exp exp!\n");
				$ut->svuotaAccumuloSoldi();
				$ut->svuotaAccumuloExp();
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(0);
				break;
			}
			*/

			switch($text){
				case 'Seleziona Target':
			  		$msg = 'Scegli target';
					$key = kMobs();
					$ut->setUtenteStatoId(8);
				break;

				case 'Skills':
					$msg .= 'Scegli una skill'."\n\n";
					$ut->showSkills();
					//$key = kSkills();
					$key = new Keyboard();
					$key->push("Torna Indietro");
					$ut->setUtenteStatoId(6);
				break;

				case 'Scappa':
					write('Sicuro di voler scappare? Vigliacco!'."\n");
					$key = new Keyboard();
					$key->push('Scappo');
					$key->push('Resto');
				break;

				case 'Scappo':
					$slId = $ut->getUtenteSottoluogoId();
					$className = 'Sottoluogo'.$slId;
					$Sottoluogo = new $className($ut);

					if($Sottoluogo->scappa()){
						//$db->deleteMobs($ut);
						$ut->clearAllMobHere();
						$ut->svuotaAccumuloSoldi();
						$ut->svuotaAccumuloExp();
						//$msg = 'Scampato pericolo!';
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);
					}else{
						$hasEnteredBattle = true;
					}
				break;

				case 'Resto':
					write('Saggia scelta'."\n");
					$key = kBattle();
				break;

				case 'Mappa':
					$msg .= $db->drawMap($ut);
				break;

				case 'Muovi':
					$msg .= "Scegli la direzione";
					$key = kMuovi();
					$ut->setUtenteStatoId(13);
				break;

				case 'Usa Item':
					$msg .= "Scegli l'item da utilizzare";
					$key = kItems();
					$ut->setUtenteStatoId(28);
				break;

				case 'Scheda Personaggio':
					$msg = $ut->printUtenteInfo();
				break;

				default:
					if($text[0] == "/"){
						$id = intval(str_replace('/', '', $text));
						$Mob = new Mob($id);
						$Mob->setUtente($ut);
						if($Mob->doesExists()){
							$Mob->printInfo();
						}
					}
			}
		break;



		case 4: //Respawn
			switch($text){
				case 'Respawn':
					$ut->respawn();
					$ut->svuotaAccumuloSoldi();
					$ut->svuotaAccumuloExp();
					$msg = 'Sei tornato in vita!';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;
			}
		break;


		case 5: //In Viaggio
			if($text == 'Scheda'){
				$ut->showScheda();
				break;
			}

			if($ut->isInViaggio()){
				$msg = 'Sei ancora in viaggio fino a ' . $ut->getTempoRimanenteViaggio();
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(5);
			}else{
				$msg = 'Viaggio terminato!';
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(0);
			}
		break;


		case 6: //Lista abilità
			$key = kBattle();
			$ut->setUtenteStatoId(3);

			if($text == 'Torna Indietro'){
				write('Tornando indietro...');
				$ut->setUtenteStatoId(3);
				$key = kBattle();
				break;
			}

			if($text[0] == "/"){
				$text = str_replace("/", "", $text);
				$ut->setUtenteSkillId($text);
			}else{
				$ut->setUtenteSkillId($db->getIdBySkillNome($text));
			}

			$mosso = false;
			$hasUsedSkill = true;
			$hasEnteredBattle = true;
			$mobId = null;
			$tipoMobId = null;

			//write('OK');

			$skillId = $ut->getUtenteSkillId();

			$className = 'Skill'.$skillId;
			$Skill = new $className();
			$Skill->setCaster($ut);
			$Skill->chose();

			/*
			$className = 'Skill'.$db->getIdBySkillNome($text);
			$Skill = new $className();
			$Skill->setCaster($ut);
			$Skill->loadEquips();
			$Skill->loadOvertimes();


			/*
			if($ut->isCrowdControlled()){
				$key = kBattle();
				$ut->setUtenteStatoId(3);
				break;
			}
			*/

			/*
			if($Skill->check()){
				if($Skill->trigger())
					$hasEnteredBattle = true;
			}
			else{
				write($Skill->findErr());
				$key = kBattle();
				$ut->setUtenteStatoId(3);
				break;
			}
			*/
		break;

		case 7:
			if($text == 'Torna Indietro'){
				write('Tornando indietro...');
				$ut->setUtenteStatoId(0);
				$key = kMenuPrincipale();
				break;
			}

			if($text[0] == "/"){
				$text = str_replace("/", "", $text);
				$ut->setUtenteSkillId($text);
			}else{
				$ut->setUtenteSkillId($db->getIdBySkillNome($text));
			}

			$className = 'Skill'.$ut->getUtenteSkillId();
			$Skill = new $className();
			write('<b>'.strtoupper($Skill->getSkillNome()).'</b>:'."\n".'<i>'.$Skill->getSkillDesc().'</i>');


			/*
			$Skill->setCaster($ut);
			$Skill->loadEquips();
			$Skill->loadOvertimes();


			if($Skill->check()){
				$Skill->trigger();
			}
			else{
				write($Skill->findErr());
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(0);
				break;
			}
			*/
		break;

		case 8:
			prof_flag('START BATTLE');
			if($text == 'Torna Indietro'){
				$ut->setUtenteStatoId(3);
				$key = kBattle();
				$msg = 'Tornando al menù battaglia...';
				break;
			}

			if($text == 'Sei troppo distante o vicino per usare questa skill su qualcuno!'){
				$key = kBattle();
				$msg = 'Scegli un altra skill o spostati.';
				$ut->setUtenteStatoId(3);
				break;
			}

			prof_flag('ARE THERE MOBS');
			if(!$ut->areThereMobs()){
				$msg = "Non c'è nessuno...";
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(0);
				break;
			}

			prof_flag('CREATE MOB');
			//$ut->sendChatAction('typing');

			$mobId = $ut->getMobIdByButtonText($text);
			if($mobId === false){
				write("Qualcosa è andato storto");
				break;
			}

			$tipoMobId = Functions::getTipoMobIdByMobId($mobId);
			if($tipoMobId === false){
				write('Target non trovato'."\n");
				break;
			}

			$ut->setTargetMobId($mobId);

			//$Mob = new Mob($id);
			$hasEnteredBattle = true;
			$hasUsedSkill = true;

			$ut->hasEnteredBattle(TRUE);
			$ut->hasUsedSkill(TRUE);

			if($hasEnteredBattle){
				prof_flag('BATTLE1');
	
				//$ut->triggerPreOvertimes();
	
				$res = 0;
	
				//$ut->loadEnemies();
				//$Mobs = $ut->getEnemies();
	
				
	
				$msg = preg_replace("/\n+/", "\n\n", $msg);
	
				prof_flag('BATTLE4');
			}	

			//$ut->setUtentePA(5);

			//COSTRUISCI MESSAGGIO
			//$msg .= $Skill->getMsg('SKILL');
			$key = kBattle();
			$ut->setUtenteStatoId(3);
			prof_flag('END SKILL');
		break;

		case 9:
			switch($text){
				case 'Torna al menu principale':
					$msg = 'Menu principale';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				default:
					if(Functions::itemNameExist($text) || $text[0] == '/'){
						if($text[0] == '/')
							$id = intval(str_replace('/', '', $text));
						else
							$id = Functions::getTipoItemIdByName($text);

						if(!$ut->hasTipoItem($id)){
							write('Non possiedi questo item.');
							break;
						}
						$ut->setDynamicId($id);
						$className = 'Item'.$id;
						//$it = new Item($ut, 1);
						$it = new $className($ut);
						$it->show();
						//$it->trigger();
						unset($it);
						//$ut->sendMessage($msg, $key);
						$key = kHandleItem();
						$ut->setUtenteStatoId(35);
						break;
					}

					//$n = count($ut->selectAllItems());
					$text = intval($text);
					if($text == 0)
						$text++;

					$text--;

					/*
					if($text > $n){
						$msg .= 'Scompartimento non esistente';
						break;
					}
					*/

					$start = $text * 10;
					$end = ($text * 10) + 10;

					$howMany = 50;
					$startFrom = $text * $howMany;
					$ut->showItemsInRange($howMany, $startFrom);

			}
		break;

		case 10:
			if($text == 'Torna Indietro'){
				$key = kMenuPrincipale();
				$ut->setUtenteStatoId(0);
				$msg .= 'Tornando indietro...';
				break;
			}

			//$key = kMenuPrincipale();
			//$ut->setUtenteStatoId(0);
			$sl = getOBJ('Sottoluogo', $ut->getUtenteSottoluogoId(), $ut);

			if($sl->doesSottoluogoNomeExist($text)){

				$id = $db->getIdSottoluogoByNomeSottoluogoAndLuogoId($text, $sl->getLuogoId());

				if(!$sl->isSottoluogoNear($id)){
					$msg = 'Non puoi andare qui!';
					break;
				}

				$sl = getOBJ('Sottoluogo', $id, $ut);
				$sl->setUtente($ut);
				
				if(!$sl->canAttempToStepIn()){
					write('Non esiste un posto del genere a ' . $sl->getLuogoNome() . '.'."\nForse...");
					break;
				}

				$sl->stepIn();
			}else{
				$msg = 'Non esiste un posto del genere a ' . $sl->getLuogoNome() . '.';
			}

			$key = kNearSottoluoghi();
		break;

		case 11:
			switch($text){
				case 'Torna Indietro':
					$msg = 'Tornando indietro...';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				default:
					$msg = $ut->aggiungiPunto($text);
			}
		break;

		case 12:
			switch($text){
				case 'Torna Indietro':
					$msg = 'Tornando indietro...';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				default:
				/*
					if($db->doesEquipExist($text)){
						$id = $db->getEquipIdByName($text);
						$TipoEquip = new TipoEquip($id);
						$ut->setUtenteEquipId($id);
						$TipoEquip->printCraftingItems();
						$key = kConfermaCraft();
						$ut->setUtenteStatoId(32);
					}else{
						$msg .= 'Equip non esistente';
					}
				}
				*/

				if(Functions::doesEquipExist($text) || $text[0] == '/'){
					if($text[0] == '/')
						$id = intval(str_replace('/', '', $text));
					else
						$id = Functions::getEquipIdByName($text);

					$TipoEquip = new TipoEquip($id);
					$ut->setUtenteEquipId($id);
					$TipoEquip->printCraftingItems();
					$key = kConfermaCraft();
					$ut->setUtenteStatoId(32);
					break;
				}

					//$n = count($ut->selectAllItems());
					$text = intval($text);
					if($text == 0)
						$text++;

					$text--;

					/*
					if($text > $n){
						$msg .= 'Scompartimento non esistente';
						break;
					}
					*/

					$start = $text * 10;
					$end = ($text * 10) + 10;

					$howMany = 25;
					$startFrom = $text * $howMany;
					$ut->showEquipsInRangeForCraft($howMany, $startFrom);
			}
		break;

		case 13:
			//$msg = 'f';
			switch($text){
				case 'Torna Indietro':
					$msg = 'Tornando al menù battaglia...';
					$key = kBattle();
					$ut->setUtenteStatoId(3);
				break;

				case 'Mappa':
					$msg .= $db->drawMap($ut);
					$key = kMuovi();
					$ut->setUtenteStatoId(13);
				break;

				default:
					if($text[0] == "/"){
						$id = intval(str_replace('/', '', $text));
						$Mob = new Mob($id);
						if($Mob->doesExists()){
							$Mob->printInfo();
						}
					}

					if($ut->getUtentePM() < 1){
						$msg .= 'Non hai abbastanza punti movimento!';
						$ut->setUtentePM(5);
						$key = kMuovi();
						$ut->setUtenteStatoId(13);
						break;
					}

					$mosso = false;

					switch($rawText){
						case $emoji['UP']:
							$dirMosso = 'NORD';
							$mosso = true;
							//$mosso = $ut->muovi(1, 'NORD');
						break;

						case $emoji['DOWN']:
							$dirMosso = 'SUD';
							$mosso = true;
							//$mosso = $ut->muovi(1, 'SUD');
						break;

						case $emoji['RIGHT']:
							$dirMosso = 'EST';
							$mosso = true;
							//$mosso = $ut->muovi(1, 'EST');
						break;

						case $emoji['LEFT']:
							$dirMosso = 'OVEST';
							$mosso = true;
							//$mosso = $ut->muovi(1, 'OVEST');
						break;

						case 'Stai Fermo':
							$msg = 'Rimani immobile'."\n";
							$mosso = true;
							$dirMosso = null;
						break;
					}

					$hasEnteredBattle = $mosso;
					$ut->hasEnteredBattle($hasEnteredBattle);
					$ut->hasMoved($mosso);
					$ut->moveDirection($dirMosso);

					$key = kMuovi();
					$ut->setUtenteStatoId(13);
				break;
			}
		break;

		//Equip men fuori battaglia
		case 14:
			switch($text){
				case 'Aggiungi':
					/*
					$msg = 'Scegli equip da aggiungere';
					$key = kNotActiveEquipList();
					$ut->setUtenteStatoId(15);
					*/
				break;

				case 'Rimuovi':
					/*
					$msg .= 'Scegli equip da rimuovere';
					$key = kActiveEquipList();
					$ut->setUtenteStatoId(16);
					*/
				break;

				case 'Rimuovi Tutto':
					write('Sicuro di voler rimuovere tutto il tuo equipaggiamento?'."\n");
					$key = new Keyboard();
					$key->push('Sì, Rimuovi');
					$key->push('Annulla');
					//$msg = $ut->rimuoviTuttoEquip();
					//$key = kEquipManager();
					//$ut->setUtenteStatoId(14);
				break;

				case 'Sì, Rimuovi':
					$msg = $ut->rimuoviTuttoEquip();
					$key = kEquipManager();
				break;

				case 'Annulla':
					write('Equipaggiamento NON rimosso');
					$key = kEquipManager();
				break;

				case 'Upgrade':
					/*
					$msg .= 'Scegli item da potenziare';
					$key = kNotActiveEquipList();
					$ut->setUtenteStatoId(24);
					*/
				break;

				case 'Inventario':
					//$msg = $ut->printEquip();
					//$key = kEquipManager();
					//$ut->setUtenteStatoId(14);
					$msg = 'Scegli una categoria di equip';
					$key = kOwnedCategorieEquip();
					$ut->setUtenteStatoId(29);
				break;

				case 'Torna Indietro':
					$msg .= 'Tornando indietro';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;
			}
		break;

		case 15: //Aggiungi Equip
			switch($text){
				case 'Torna Indietro':
					$msg .= 'Tornando indietro';
					$key = kEquipManager();
					$ut->setUtenteStatoId(14);
				break;

				default:
					$equipId = $ut->getEquipIdByEquipButtonString($text);
					$msg = $ut->attivaEquip($equipId);
					$key = kNotActiveEquipList();
					//$ut->setUtenteStatoId(15);
				break;
			}
		break;

		case 16: //Rimuovi Equip
			switch($text){
				case 'Torna Indietro':
					$msg .= 'Tornando indietro';
					$key = kEquipManager();
					$ut->setUtenteStatoId(14);
				break;

				default:
					$equipId = $ut->getEquipIdByEquipButtonString($text);
					$msg = $ut->rimuoviEquip($equipId);
					$key = kActiveEquipList();
					$ut->setUtenteStatoId(16);
				break;
			}
		break;

		case 17:
			switch($text){
				case 'Torna Indietro':
					$msg .= 'Tornando indietro';
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				default:
					//$ut->sendMessage("1");
					if($db->doesNpcNameExist($text)){
						//$ut->sendMessage("2");
						$id = $db->getNpcIdByName($text);
						$className = 'Npc'.$id;

						$Npc = new $className();

						if($ut->isSameSottoluogoNpc($Npc)){
							//$ut->sendMessage("3");
							$ut->setUtenteNpcId($Npc->getData('ID'));
							$Npc->setText($text);
							$Npc->setUtente($ut);
							$Npc->talk();
							//if($ut->isDonny())
								//$msg .= '<a href = "'.$Npc->getData('IMG_PATH').'"> </a>';
							$Npc->printImg();
							$key = $Npc->getKeyboard();
						}else{
							//$ut->sendMessage("4");
							$msg = "Questo npc non si trova qui";
						}

					}else{
						//$ut->sendMessage("5");
						$msg = "Questo npc non esiste";
					}
				break;
			}

		break;

		case 18: //NPC TALK OPTIONS
			$className = 'Npc'.$ut->getUtenteNpcId();
			$Npc = new $className();
			$Npc->setText($text);
			$Npc->setUtente($ut);
			$Npc->talk();
			$key = $Npc->getKeyboard();
		break;

		//INLINE
		case 20:
			if($cbqData == 999){
				$ut->setUtenteStatoId(0);
				$key = kMenuPrincipale();
				$msg = 'Sei nel menù principale';
			}else
				$ut->answerCallBackQuery($cbqID, 'Hai selezionato '.$cbqData.' come skill');
		break;

		case 21:
			switch($text){
				case 'Torna Indietro':
					write('Tornando indietro');
					$key = kMenuPrincipale();
					$ut->setUtenteStatoId(0);
				break;

				default:
					if(!Functions::utenteNickExist($text)){
						$msg = 'Personaggio non riconosciuto';
						break;
					}

					$id = Functions::getUtenteIdByNick($text);
					$razzaId = Functions::getUtenteRazzaIdById($id);
					$className = 'Razza'.$razzaId;
					$en = new $className($id);

					if($en->getUtenteSottoluogoId() != $ut->getUtenteSottoluogoId()){
						$msg .= 'Questo personaggio non si trova qui.';
						break;
					}

					$ut->setUtenteUtenteId($id);
					write($en->printUtenteInfo());
					$en->printKilledMobsOfAllTime();
					$en->printKilledMobsToday();
					$key = kOpzioniUtente();
					$ut->setUtenteStatoId(22);
				break;
			}
			break;

		case 22:
			$id = $ut->getUtenteUtenteId();
			$razzaId = Functions::getUtenteRazzaIdById($id);
			$className = 'Razza'.$razzaId;
			$en = new $className($id);

			switch($text){
				case 'Torna Indietro':
					write('Scrivi il nome di un utente');
					$key = new Keyboard();
					$key->push('Torna Indietro');
					$ut->setUtenteStatoId(21);
				break;

				case 'Sfida a duello':
					if($en->getUtenteStatoId() != 0){
						$msg = $en->getNome() . ' è impegnato e non può duellare al momento';
					}else{
						$msg = 'In attesa che '.$en->getNome().' accetti il duello...';
						$key = new Keyboard();
						$key->push('Annulla duello');
						$ut->setUtenteStatoId(25);

						$scegliDuello = new Keyboard();
						$scegliDuello->push('Accetta');
						$scegliDuello->push('Rifiuta');
						$en->setUtenteUtenteId($ut->getUtenteId());
						$en->setUtenteStatoId(23);
						$en->sendMessage($msg, $scegliDuello);
					}
				break;

				case 'Aggiungi agli amici':
					if($ut->areWeBothFriend($en)){
						$msg .= "Siete già amici!";
					}
					else{
						if($ut->isFriend($en)){
							$msg .= "Lo hai già aggiunto alla lista degli amici. Chiedigli di aggiungerti!";
						}
						else{
							$ut->addFriend($en);
						}
					}
				break;

				case 'Scheda':
					$en->showScheda();
				break;

				case 'Equip':
					write($en->printEquip());
				break;

			}
		break;

		//CONFERMA DUELLO
		case 23:
			$id = $ut->getUtenteUtenteId();
			$en = new Utente($id);
			switch($text){
				case 'Accetta':
					$msg = 'Che il duello abbia inizio!';
					$key = kDuello();
					$en->setUtenteStatoId(26);
					$en->sendMessage($msg, $key);
					$ut->setUtenteStatoId(26);
					Functions::inserisciDuello($en->getUtenteId(), $ut->getUtenteId());
					$ut->clearAllMobHere();
					$en->clearAllMobHere();

					$ut->spawnUserInRandomPositionOfSottoluogo();
					$en->spawnUserInRandomPositionOfSottoluogo();
				break;

				case 'Rifiuta':
					$msg = 'Duello rifiutato';
					$key = kMenuPrincipale();
					$en->setUtenteStatoId(0);
					$en->sendMessage($msg, $key);
					$ut->setUtenteStatoId(0);
					$ut->sendMessage($msg, $key);
				break;

				default:

				break;
			}

		break;

		//ANNULLA DUELLO
		case 25:
			$id = $ut->getUtenteUtenteId();
			$razzaId = Functions::getUtenteRazzaIdById($id);
			$className = 'Razza'.$razzaId;
			$en = new $className($id);

			if($text == 'Annulla duello'){
				$ut->setUtenteStatoId(0);
				$msg = 'Duello annullato';
				$key = kMenuPrincipale();

				$en->setUtenteStatoId(0);
				$en->sendMessage($msg, $key);
			}else{
				$msg = 'In attesa che il duello venga accettato...';
			}
		break;

		case 24: //UPGRADE
			switch($text){
				case 'Torna Indietro':
					$msg .= 'Tornando indietro';
					$key = kEquipManager();
					$ut->setUtenteStatoId(14);
				break;

				default:
					$equipId = $ut->getEquipIdByEquipButtonString($text);
					$Equip = new Equip($equipId);
					$className = 'Equip'.$Equip->getTipoEquipId();
					$Equip = new $className($ut, $equipId);
					$Equip->upgrade($ut);

					//$msg = $Equip->getMsg('UPGRADE');
					$key = kNotActiveEquipList();
					$ut->setUtenteStatoId(24);
				break;
			}
			break;

			//DUELLO
			case 26:
				if(!$ut->isMyTurnInDuel()){
					$msg .= 'Non è il tuo turno!';
					break;
				}

				switch($text){
					case 'Ritirati':
						$id = $ut->getUtenteUtenteId();
						$razzaId = Functions::getUtenteRazzaIdById($id);
						$className = 'Razza'.$razzaId;
						$en = new $className($id);

						$msg = 'Ti sei ritirato';
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);
						$db->terminaDuello($en->getId());
						$en->setUtenteStatoId(0);
						$en->sendMessage($ut->getNome().' si è arreso', $key);
					break;

					case 'Mappa':
						$msg = $ut->drawDuelMap();
					break;

					case 'Scheda':
						$msg = $ut->printUtenteInfo();
						$key = kDuello();
					break;

					case 'Usa Skill':
						$key = kSkills();
						$msg = 'Seleziona la skill che vuoi lanciare';
						$ut->setUtenteStatoId(27);
					break;

					default:
						if(!$ut->isMyTurnInDuel()){
							$msg .= 'Non è il tuo turno!';
							break;
						}

						$id = $ut->getUtenteUtenteId();
						$razzaId = Functions::getUtenteRazzaIdById($id);
						$className = 'Razza'.$razzaId;
						$en = new $className($id);

						$hasEnteredDuel = false;
						switch($rawText){
							case $emoji['UP']:
								$hasEnteredDuel = $ut->muovi(1, 'NORD');
							break;

							case $emoji['DOWN']:
								$hasEnteredDuel = $ut->muovi(1, 'SUD');
							break;

							case $emoji['RIGHT']:
								$hasEnteredDuel = $ut->muovi(1, 'EST');
							break;

							case $emoji['LEFT']:
								$hasEnteredDuel = $ut->muovi(1, 'OVEST');
							break;

							case 'Stai Fermo':
								$msg = 'Rimani immobile'."\n";
								$hasEnteredDuel = true;
							break;
						}
				}

					//$hasEnteredDuel = true;
			break;

			case 27:
				if(!$ut->isMyTurnInDuel()){
					$msg = 'Non è il tuo turno!';
					break;
				}

				if($text == 'Torna Indietro'){
					$ut->setUtenteStatoId(26);
					$msg = "Tornando indietro";
					$key = kDuello();
					break;
				}

				$id = $ut->getUtenteUtenteId();
				$razzaId = Functions::getUtenteRazzaIdById($id);
				$className = 'Razza'.$razzaId;
				$en = new $className($id);

				$ut->setUtenteSkillId($db->getIdBySkillNome($text));
				$className = 'Skill'.$ut->getUtenteSkillId();
				$Skill = new $className();
				$Skill->setCaster($ut);
				$Skill->setTarget($en);
				$Skill->loadEquips();
				$Skill->loadOvertimes();


				if($Skill->check()){
					$Skill->trigger();
					$hasEnteredDuel = true;
					$ut->setUtenteStatoId(26);
					$key = kDuello();
				}
				else{
					$msg .= $Skill->findErr();
				}

				//$en->sendMessage($msg);
			break;

			case 28: //USA ITEM IN BATTAGLIA
			switch($text){
				case 'Torna Indietro':
					$msg = 'Tornando indietro...';
					$key = kBattle();
					$ut->setUtenteStatoId(3);
				break;

				default:
					if(Functions::itemNameExist($text)){
						$id = Functions::getTipoItemIdByName($text);
						$className = 'Item'.$id;
						$it = new $className($ut);
						$it->trigger();
						$hasEnteredBattle = true;
					}else{
						write('Item non identificato.');
					}
					$key = kItems();
			}
			break;

			case 29:
				switch($text){
					case 'Torna Indietro':
						$msg = 'Tornando indietro...';
						$key = kEquipManager();
						$ut->setUtenteStatoId(14);
					break;

					default:
						if(Functions::categoriaEquipNameExist($text)){
							$id = Functions::getCategoriaEquipIdByName($text);
							//$ut->setMemo('CATEGORIA_EQUIP_ID', $id);
							$ut->setUtenteCategoriaEquipId($id);
							$ut->setUtenteStatoId(30);
							//$key = kSelectedEquipsByCategoria();
							$key = new Keyboard();
							$key->push('Torna Indietro');
							//write('Hai selezionato '.$text);
							write($ut->printEquipOwnedByCategoriaId($id));
						}else{
							write('Categoria inesistente');
							$key = kOwnedCategorieEquip();
						}
					break;
				}
			break;

			case 30:
				//$id = $ut->getEquipIdByEquipButtonString($text);
				switch($text){
					case 'Torna Indietro':
						$msg = 'Scegli una categoria di equip';
						$key = kOwnedCategorieEquip();
						$ut->setUtenteStatoId(29);
					break;

					default:
						//$id = $ut->getEquipIdByEquipButtonString($text);
						if($text[0] == '/'){
							$id = intval(str_replace('/', '', $text));
							if($ut->hasEquipId($id)){
								$Eq = new Equip($id);
								$Eq->printEquipInfo();
								$ut->setUtenteEquipId($id);
								$ut->setUtenteStatoId(31);
								$key = kManageSingleEquip($Eq->isActive());
							}else{
								write('Non possiedi questo equip! '."$id");
							}
						}else{
							write('Perfavore, scegli un equip valido!');
						}
					break;
				}

			break;

			case 31:
				$Eq = new Equip($ut->getUtenteEquipId());
				switch($text){
					case 'Torna Indietro':
						//write('Tornando indietro...');
						//$key = kSelectedEquipsByCategoria();
						$key = new Keyboard();
						$key->push('Torna Indietro');
						$id = $ut->getUtenteCategoriaEquipId();
						write($ut->printEquipOwnedByCategoriaId($id));
						$ut->setUtenteStatoId(30);
					break;

					case 'Equipaggia':
						$res = $ut->attivaEquip($Eq->getEquipId());
						$key = kManageSingleEquip($res);
					break;

					case 'Rimuovi':
						$ut->rimuoviEquip($Eq->getEquipId());
						$key = kManageSingleEquip(false);
					break;

					case 'Upgrade':
						$Eq->upgrade($ut);
					break;

					case 'Visualizza':
						$Eq->printEquipInfo();
					break;

					case 'Incastona':
						write('Scegli item da incastonare.');
						//write('Attenzione: incastonando un item, tutti gli incastonamenti precedenti verranno rimossi');
						$key = kIncastona();
						$ut->setUtenteStatoId(36);
					break;
				}

			break;

			//Crafta
			case 32:
				switch($text){
					case 'Crafta':
						$ut->craftEquip($ut->getUtenteEquipId());
					break;

					case 'Annulla':
						write('Crafting annullato');
					break;
				}

				$key = kCraft();
				$ut->setUtenteStatoId(12);
			break;

			//Profilo
			case 33:
				switch($text){
					case 'Torna Indietro':
						write('Tornando al menù principale...');
						$ut->setUtenteStatoId(0);
						$key = kMenuPrincipale();
					break;

					case 'Equip':
						write($ut->printEquip());
					break;

					case 'Buff/Debuff':
						write($ut->printBuffs());
					break;

					case 'Stati':
						$ut->showOverTimes();
					break;

					case 'Item':

					break;

					case 'Combattimento':
						write("Livello dei vari tipi di equip\n");
						$ut->showTalentiCategoriaEquip();
					break;

					case 'Quest':
						$ut->printActiveQuests();
					break;
				}
			break;

			case 34:
				$className = 'Sottoluogo'.$ut->getUtenteSottoluogoId();
				$sl = new $className($ut);
				switch($text){
					case 'Torna Indietro':
						write('Tornando al menù principale...');
						$key = kMenuPrincipale();
						$ut->setUtenteStatoId(0);
					break;

					case 'Esplora':
						$sl->esplorazione();
					break;
				}
			break;

			case 35:
				switch($text){
					case 'Torna Indietro':
						write('Tornando al menù item...');
						$key = kScompartimenti();
						$ut->setUtenteStatoId(9);
					break;

					case 'Usa':
						$id = $ut->getDynamicId();
						$className = 'Item'.$id;
						$it = new $className($ut);
						$it->trigger();
						unset($it);
					break;
				}
			break;

			case 36: //Scegli runa/gemma
				switch($text){
					case 'Torna Indietro':
						$id = $ut->getUtenteEquipId();
						$Eq = new Equip($id);
						$Eq->printEquipInfo();
						$ut->setUtenteStatoId(31);
						$key = kManageSingleEquip($Eq->isActive());
					break;

					default:
						if(Functions::itemNameExist($text)){
							$id = Functions::getTipoItemIdByName($text);
							if(!$ut->hasTipoItem($id)){
								write('Non possiedi questo item.');
								break;
							}
							$ut->setDynamicId($id);
							$className = 'Item'.$id;
							$it = new $className($ut);
							$it->show();
							write("L'item selezionato verrà incastonato, procedere?");
							$ut->setUtenteStatoId(37);
							$key = kIncastonaConfirm();
						}else{
							write('Questo item non esiste');
						}

					break;
				}
			break;

			case 37:
				switch($text){
					case 'Procedi':
						$equipId = $ut->getUtenteEquipId();
						$tipoEquipId = Functions::getTipoEquipIdByEquipId($equipId);
						$itemId = $ut->getDynamicId();

						$classEquip = 'Equip'.$tipoEquipId;
						$classItem = 'Item'.$itemId;

						$Equip = new $classEquip($ut, $equipId);
						$Item = new $classItem($ut);

						if($Equip->incastona($Item))
							write('Incastonamento andato a buon fine!');
						else
							write('Incastonamento NON andato a buon fine');

						$ut->setUtenteStatoId(36);
						$key = kIncastona();
					break;

					case 'Annulla';
						write('Incastonamento annullato');
						$ut->setUtenteStatoId(36);
						$key = kIncastona();
					break;
				}
			break;

		default:
			$msg = 'Errore  ($ut->getUtenteStatoId vale ' . $ut->getUtenteStatoId() . ')';
			$key = kMenuPrincipale();
			$ut->setUtenteStatoId(0);
		break;

	}