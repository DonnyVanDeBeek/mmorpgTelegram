<?php
	class Npc{
		private $prefix 	= 'BOT_RPG'; 
		private $tableName 	= 'NPC';		
		private $primaryKey = 'ID';
		
		protected $data;

		protected $utente;

		protected $text;

		protected $keyboard = '';
		
		public function __construct($id){
			$db = Database();
			
			$prefix 	= $this->prefix;
			$tableName 	= $this->tableName;
			$primaryKey = $this->primaryKey;
			
			$sql = "SELECT * FROM ".$prefix.'_'.$tableName." WHERE ".$tableName.'_'.$primaryKey." = ".$id;
            $res = $db->query($sql);
            $row = $res->fetch_object();
			
			$sql = "SHOW COLUMNS FROM ".$prefix.'_'.$tableName;
        	$res = $db->query($sql);
			
			while($row1 = $res->fetch_object()){
        		$this->data[$row1->Field] = $row->{$row1->Field};
        	}
		}
		
        public function getData($info){
            $info = $this->tableName.'_'.strtoupper($info);
            return $this->data[$info];
        }
		
		public function setData($info, $value){
			$this->data[$this->tableName.'_'.strtoupper($info)] = $value;
		}

		public function setUtente(&$a){
			$this->utente = $a;
		}

		public function getUtente(){
			return $this->utente;
		}


		public function setDataDB($info, $value){
			$tableName 	= $this->tableName;
			$primaryKey	= $this->primaryKey;
			$sql = "UPDATE ".$tableName." SET ".$tableName.'_'.strtoupper($info)." = ".$value." WHERE ".$tableName.'_'.$primaryKey." = ".$this->getData($primaryKey);
			Database()->query($sql);
		}

		public function getNome(){
			return $this->getData('NOME');
		}

		public function getSpeakNome(){
			return '<b>'.$this->getData('NOME').'</b>:';
		}

		public function handleVenditoreItem(){
			if($this->showItemsEquipToSell()){
				//write('simbolo: '.$this->getText()[0]);
				$txt = $this->getText(); 
				if($txt[0] == "-"){

					if($txt == '- Ho terminato -'){
						write('Te ne vai');
						$this->setKeyFlagStatus(kNpc(), 0, 17);
						return true;
					}

					$txt[0] = '';
					$txt = str_replace('£', '', $txt);
					$txt = str_replace('\n', '', $txt);
					$dati = explode("-", $txt);
					$nome = trim($dati[0]);
					$prezzo = trim($dati[1]);
					//write($nome.' '.$prezzo);
					

					//write('Vendi '.$nome.' per '.intval($prezzo));
					$flag = false;
					$Equips = $this->Equips;
					$n = count($Equips);
					for($i = 0; $i < $n; $i++){
						$cur = $Equips[$i]; 
						if($cur['NOME'] == $nome){
							$flag = true;
							$arr = array(
								'livello' => 1,
								'prezzo' => $cur['PREZZO'],
								'tipoEquipId' => $cur['ID']
							);
							$res = $this->sellEquip($arr);
							if($res){
								write($cur['ON_TRUE']);
							}else{
								write($cur['ON_FALSE']);
							}
						}
					}

					if(!$flag){
						write('Non ho capito, potresti ripetere?');
					}

				}else{
					write('Cosa vuoi comprare?');
				}

				return true;
			}else{
				return false;
			}
		}

		public function handleVendor(){
			if($this->showItemsEquipToSell()){
				//write('simbolo: '.$this->getText()[0]);
				$txt = $this->getText(); 
				if($txt[0] == "-"){

					if($txt == '- Ho terminato -'){
						write('Te ne vai');
						$this->setKeyFlagStatus(kNpc(), 0, 17);
						return true;
					}

					$txt[0] = '';
					$txt = str_replace('£', '', $txt);
					$txt = str_replace('\n', '', $txt);
					$dati = explode("-", $txt);
					$nome = trim($dati[0]);
					$prezzo = trim($dati[1]);
					//write($nome.' '.$prezzo);
					
					//QUERY PER CONTROLLARE CHE NON CI SIANO EQUIP CON LO STESSO NOME DI UN ITEM E VICEVERSA:
					//SELECT TIPO_ITEM_ID, TIPO_EQUIP_ID, TIPO_EQUIP_NOME FROM BOT_RPG_TIPO_EQUIP, BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_NOME = TIPO_EQUIP_NOME

					//write('Vendi '.$nome.' per '.intval($prezzo));
					$flag = false;

					$Equips = $this->Equips;
					$n = count($Equips);
					for($i = 0; $i < $n; $i++){
						$cur = $Equips[$i]; 
						if($cur['NOME'] == $nome){
							$flag = true;
							$arr = array(
								'livello' => 1,
								'prezzo' => $cur['PREZZO'],
								'tipoEquipId' => $cur['ID']
							);
							$res = $this->sellEquip($arr);
							if($res)
								$frase = str_replace('_npc_', '<b>'.$this->getNome().'</b>', $cur['ON_TRUE']); 
							else
								$frase = str_replace('_npc_', '<b>'.$this->getNome().'</b>', $cur['ON_FALSE']); 
							
							write($frase);
						}
					}

					if(!$flag){
						$Items = $this->Items;
						$n = count($Items);
						for($i = 0; $i < $n; $i++){
							$cur = $Items[$i]; 
							if($cur['NOME'] == $nome){
								$flag = true;
								$arr = array(
									'quantita' => $cur['QUANTITA'],
									'prezzo' => $cur['PREZZO'],
									'tipoItemId' => $cur['ID']
								);
								$res = $this->sellItem($arr);
								if($res)
									$frase = str_replace('_npc_', '<b>'.$this->getNome().'</b>', $cur['ON_TRUE']);

								else
									$frase = str_replace('_npc_', '<b>'.$this->getNome().'</b>', $cur['ON_FALSE']); 
							
								write($frase);
								if($res){
									write();
									$this->getUtente()->notifyTakeSoldi($cur['PREZZO']);
									write();
									$this->getUtente()->initNotifyGiveItem();
									$this->getUtente()->notifyGiveItem($cur['ID'], $cur['QUANTITA']); 
								}
							}
						}
					}

					if(!$flag){
						write('Non ho capito, potresti ripetere?');
					}

				}else{
					$this->speak();
				}

				return true;
			}else{
				return false;
			}
		}

		public function interact(){
			$this->addTimesTalked();
			$this->talk();
		}

		public function talk(){
			$this->addTimesTalked();

			if($this->handleVendor())
				return true;

			$this->speak();
		}

		public function speak(){
			$sql = "
					SELECT FRASE_NPC_TESTO, FRASE_NPC_ID
					FROM BOT_RPG_FRASE_NPC 
					WHERE FRASE_NPC_NPC_ID = ".$this->getData('ID')."
					ORDER BY RAND()
					LIMIT 1
					";
			$res = Database()->query($sql);

			if($res->num_rows > 0){
				$row = $res->fetch_object();
				$frase = $row->FRASE_NPC_TESTO;
				$frase = str_replace('_man_', '<b>'.$this->utente->getNome().'</b>', $frase);
				$frase = str_replace('_npc_', '<b>'.$this->getNome().'</b>', $frase);
				//$str = "<b>".$this->getNome()."</b>: ".'"'.$frase.'"';
				$str = '<b>'.$this->getNome().'</b>'."\n\n".$frase;
			}else{
				//$str = "<b>".$this->getNome()."</b>: ".'"..."';
				$str = '...';
			}

			//$this->keyboard = kNpc();

			write($str);
			if(isset($row))
				return $row->FRASE_NPC_ID;
		}

		function addTimesTalked(){
			if($this->hasAlreadyTalkedToUser()){
				$sql = "
					UPDATE BOT_RPG_UTENTE_TALK_NPC 
					SET TIMES_TALKED = TIMES_TALKED + 1, DATA = NOW()
					WHERE NPC_ID = ".$this->getData('ID')." AND UTENTE_ID = ".$this->utente->getUtenteId();
			}else{
				$sql = "
				INSERT INTO BOT_RPG_UTENTE_TALK_NPC 
				VALUES(".
					$this->utente->getUtenteId().", ".
					$this->getData('ID').",
					1,
					0,
					NOW()
				)";
			}

			Database()->query($sql);
		}

		function hasAlreadyTalkedToUser(){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE_TALK_NPC WHERE NPC_ID = ".$this->getData('ID')." AND UTENTE_ID = ".$this->utente->getUtenteId();
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0)
				return true;
			else
				return false;
		}

		function getFlag(){
			$sql = "SELECT FLAG FROM BOT_RPG_UTENTE_TALK_NPC WHERE NPC_ID = ".$this->getData('ID')." AND UTENTE_ID = ".$this->utente->getUtenteId();
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 0;
			else
				return $res->fetch_object()->FLAG;
		}

		function setFlag($value){
			$sql = "UPDATE BOT_RPG_UTENTE_TALK_NPC SET FLAG = ".$value." WHERE NPC_ID = ".$this->getData('ID')." AND UTENTE_ID = ".$this->utente->getUtenteId();
			Database()->query($sql);
		}

		public function getKeyboard(){
			return $this->keyboard;
		}

		public function setKeyboard($a){
			$this->keyboard = $a;
		}

		public function setText($a){
			$this->text = $a;
		}

		public function getText(){
			return $this->text;
		}

		public function getTimestampLastTimeTalked(){
			$sql = "SELECT DATA FROM BOT_RPG_UTENTE_TALK_NPC WHERE NPC_ID = ".$this->getData('ID')." AND UTENTE_ID = ".$this->utente->getUtenteId();
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->DATA;
		}

		public function getAllFrasiIds(){
			$arr = array();
			$sql = "SELECT FRASE_NPC_ID AS ID FROM BOT_RPG_FRASE_NPC WHERE FRASE_NPC_NPC_ID = ".$this->getData('ID');
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$arr[] = $row->ID;
			}
			return $arr;
		}

		public function backToMenu($flag = null){
			if($flag !== null) $this->setFlag($flag);
			$this->setKeyboard(kNpc());
			$this->getUtente()->setUtenteStatoId(17);
		}

		public function backToMainMenu($flag = null){
			if($flag !== null) $this->setFlag($flag);
			$this->setKeyboard(kMenuPrincipale());
			$this->getUtente()->setUtenteStatoId(0);
		}

		public function setKeyFlagStatus($key = null, $flag = 0, $status = 17){
			
			/*
			Ebbene sì, ENTRA. Questa è la cosa più senza senso
			che io abbia mai visto in tutta la mia carriera
			da programmatore

			$flag = 0;
			if($flag == 'exit' || $flag == 'fine')
				write('flag: '.$flag);
			*/

			if($flag === 'exit' || $flag === 'fine'){
				$this->backToMenu(0);
				return;
			}

			if($key !== null)
				$this->setKeyboard($key);
			else
				$this->setKeyboard(kNpc());
			$this->getUtente()->setUtenteStatoId($status);
			$this->setFlag($flag);
		}

		public function sellItem($arr){
			$quantita = isset($arr['quantita']) ? $arr['quantita'] : 1;
			$prezzo	= $arr['prezzo'];
			$tipoItemId = $arr['tipoItemId'];

			$Ut = $this->getUtente();

			if($Ut->getUtenteSoldi() < $prezzo){
				return false;
			}

			$Ut->gainItem($tipoItemId, $quantita);
			$Ut->takeSoldi($prezzo);
			return true;
		}

		public function sellEquip($arr){
			$livello = $arr['livello'];
			$prezzo = $arr['prezzo'];
			$tipoEquipId = $arr['tipoEquipId'];

			$Ut = $this->getUtente();

			if($Ut->getUtenteSoldi() < $prezzo){
				return false;
			}

			$Ut->giveEquip($tipoEquipId, $livello);
			$Ut->takeSoldi($prezzo);
			return true;
		}

		public function craftItem($arr){
			$tipoItemId = $arr['tipoItemId'];
			$ingredienti = $arr['ingredienti'];

			$Ut = $this->getUtente();

			$n = count($ingredienti);
			for($i = 0; $i < $n; $i++){
				$element = $ingredienti[$i];
				if($Ut->howManyItemsLikeThis($element['tipoItemId']) < $element['quantita'])
					return false;
			}

			for($i = 0; $i < $n; $i++){
				$element = $ingredienti[$i];
				$Ut->togliItem($element['tipoItemId'], $element['quantita']);
			}

			$Ut->gainItem($tipoItemId, 1);
			return true;
		}

		public function getFullArrayEquipsToSell(){
			$data = array();
			$day = intval(date('d'));
			$flag = intval($day % 2);
			$id = $this->getData('ID');

			$sql = "SELECT NVTP.TIPO_EQUIP_ID, TE.TIPO_EQUIP_NOME, PREZZO, FRASE_SUCCESSO, FRASE_INSUCCESSO FROM BOT_RPG_NPC_VENDE_TIPO_EQUIP NVTP, BOT_RPG_TIPO_EQUIP TE WHERE TE.TIPO_EQUIP_ID = NVTP.TIPO_EQUIP_ID AND NPC_ID = $id";
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return $data;

			$fraseSucc = '<b>'.$this->getNome().'</b>: "Ecco a te. Serve altro?"';
			$fraseInsucc = '<b>'.$this->getNome().'</b>: "Temo tu non abbia abbastanza danaro. Mi dispiace."';

			$i = 0;
			while($row = $res->fetch_object()){
				$data[$i]['ID'] 		= $row->TIPO_EQUIP_ID;
				$data[$i]['NOME']		= Database()->real_escape_string($row->TIPO_EQUIP_NOME);
				$data[$i]['PREZZO'] 	= $row->PREZZO;
				$data[$i]['ON_TRUE'] 	= $row->FRASE_SUCCESSO !== null ? $row->FRASE_SUCCESSO : $fraseSucc;
				$data[$i]['ON_FALSE'] 	= $row->FRASE_INSUCCESSO !== null ? $row->FRASE_INSUCCESSO :$fraseInsucc;
				$data[$i]['QUANTITA']   = 1;
				$i++;
			}

			return $data;
		}

		public function getArrayEquipsToSell(){
			$data = array();
			$day = intval(date('d'));
			$flag = intval($day % 2);
			$id = $this->getData('ID');

			$sql = "SELECT NVTP.TIPO_EQUIP_ID, TE.TIPO_EQUIP_NOME, PREZZO, FRASE_SUCCESSO, FRASE_INSUCCESSO FROM BOT_RPG_NPC_VENDE_TIPO_EQUIP NVTP, BOT_RPG_TIPO_EQUIP TE WHERE TE.TIPO_EQUIP_ID = NVTP.TIPO_EQUIP_ID AND NPC_ID = $id AND (DISPONIBILITA = 999 OR DISPONIBILITA = $flag)";
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return $data;

			$fraseSucc = '<b>'.$this->getNome().'</b>: "Ecco a te. Serve altro?"';
			$fraseInsucc = '<b>'.$this->getNome().'</b>: "Temo tu non abbia abbastanza danaro. Mi dispiace."';

			$i = 0;
			while($row = $res->fetch_object()){
				$data[$i]['ID'] 		= $row->TIPO_EQUIP_ID;
				$data[$i]['NOME']		= Database()->real_escape_string($row->TIPO_EQUIP_NOME);
				$data[$i]['PREZZO'] 	= $row->PREZZO;
				$data[$i]['ON_TRUE'] 	= $row->FRASE_SUCCESSO !== null ? $row->FRASE_SUCCESSO : $fraseSucc;
				$data[$i]['ON_FALSE'] 	= $row->FRASE_INSUCCESSO !== null ? $row->FRASE_INSUCCESSO :$fraseInsucc;
				$data[$i]['QUANTITA']   = 1;
				$i++;
			}

			return $data;
		}

		public function getArrayItemsToSell(){
			$data = array();
			$day = intval(date('d'));
			$flag = intval($day % 2);
			$id = $this->getData('ID');

			$sql = "SELECT NVTI.TIPO_ITEM_ID, TI.TIPO_ITEM_NOME, QUANTITA, PREZZO, FRASE_SUCCESSO, FRASE_INSUCCESSO FROM BOT_RPG_NPC_VENDE_TIPO_ITEM NVTI, BOT_RPG_TIPO_ITEM TI WHERE TI.TIPO_ITEM_ID = NVTI.TIPO_ITEM_ID AND NPC_ID = $id AND (DISPONIBILITA = 999 OR DISPONIBILITA = $flag)";
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return $data;

			$fraseSucc = '<b>'.$this->getNome().'</b>: "Ecco a te. Serve altro?"';
			$fraseInsucc = '<b>'.$this->getNome().'</b>: "Temo tu non abbia abbastanza danaro. Mi dispiace."';

			$i = 0;
			while($row = $res->fetch_object()){
				$data[$i]['ID'] 		= $row->TIPO_ITEM_ID;
				$data[$i]['NOME']		= Database()->real_escape_string($row->TIPO_ITEM_NOME);
				$data[$i]['PREZZO'] 	= $row->PREZZO;
				$data[$i]['ON_TRUE'] 	= !empty($row->FRASE_SUCCESSO) ? $row->FRASE_SUCCESSO : $fraseSucc;
				$data[$i]['ON_FALSE'] 	= $row->FRASE_INSUCCESSO !== null ? $row->FRASE_INSUCCESSO : $fraseInsucc;
				$data[$i]['QUANTITA']	= $row->QUANTITA;
				$i++;
			}

			return $data;
		}

		public function getFullArrayItemsToSell(){
			$data = array();
			$day = intval(date('d'));
			$flag = intval($day % 2);
			$id = $this->getData('ID');

			$sql = "SELECT NVTI.TIPO_ITEM_ID, TI.TIPO_ITEM_NOME, QUANTITA, PREZZO, FRASE_SUCCESSO, FRASE_INSUCCESSO FROM BOT_RPG_NPC_VENDE_TIPO_ITEM NVTI, BOT_RPG_TIPO_ITEM TI WHERE TI.TIPO_ITEM_ID = NVTI.TIPO_ITEM_ID AND NPC_ID = $id";
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return $data;

			$fraseSucc = '<b>'.$this->getNome().'</b>: "Ecco a te. Serve altro?"';
			$fraseInsucc = '<b>'.$this->getNome().'</b>: "Temo tu non abbia abbastanza danaro. Mi dispiace."';

			$i = 0;
			while($row = $res->fetch_object()){
				$data[$i]['ID'] 		= $row->TIPO_ITEM_ID;
				$data[$i]['NOME']		= Database()->real_escape_string($row->TIPO_ITEM_NOME);
				$data[$i]['PREZZO'] 	= $row->PREZZO;
				$data[$i]['ON_TRUE'] 	= !empty($row->FRASE_SUCCESSO) ? $row->FRASE_SUCCESSO : $fraseSucc;
				$data[$i]['ON_FALSE'] 	= $row->FRASE_INSUCCESSO !== null ? $row->FRASE_INSUCCESSO : $fraseInsucc;
				$data[$i]['QUANTITA']	= $row->QUANTITA;
				$i++;
			}

			return $data;
		}

		protected $Equips = array();
		protected $Items = array();

		public function showItemsEquipToSell(){
			$Equips = $this->getArrayEquipsToSell();
			$Items = $this->getArrayItemsToSell();

			$x = count($Equips);
			$y = count($Items);
			$n = $x + $y;

			if($n == 0)
				return false;

			$this->Items  = $Items;
			$this->Equips = $Equips;

			$Equips = array_merge($Equips, $Items);

			shuffle($Equips);

			$key = new Keyboard();
			$key->push('- Ho terminato -');
			for($i = 0; $i < $n; $i++){
				$e = $Equips[$i];
				$key->push('- '.$e['NOME'].' -'."\n".$e['PREZZO'].'£ - x'.$e['QUANTITA']);
			}

			//write('Ecco cosa vendo:');
			$this->setKeyboard($key);
			$this->getUtente()->setUtenteStatoId(18);
			return true;
		}

		public function redirectToQuest($arr){
			$Ut = $this->getUtente();


			/*Struttura Array Parametro
			$arr = array(
				'questId' => $questId,
				'boolTime' => $boolTime,
				'frasePocoTempoPassato' => $frasePocoTempoPassato,
				'fraseAssegnaQuest' => $fraseAssegnaQuest,
				'fraseOnCleared' => $fraseOnCleared,
				'fraseOnNotCleared' => $fraseOnNotCleared
			);
			*/

			$questId = $arr['questId'];
			$time = $arr['boolTime'];
			$fraseTime = $arr['frasePocoTempoPassato'];
			$fraseAssegna = $arr['fraseAssegnaQuest'];
			$onTrue = $arr['fraseOnCleared'];
			$onFalse = $arr['fraseOnNotCleared'];
			

			$cleared = $Ut->hasClearedQuest($questId); 

			if($cleared){
				//QUEST GIA FATTA IN PASSATO
				if($time){
					//QUEST GIA FATTA PER IL LIMITE DI TEMPO
					$flagRifare = false;
					write($fraseTime);
				}else
					$flagRifare = true;
			}else
				$flagRifare= true;

			if($flagRifare){
				$res = $Ut->startQuest($questId);

				if($res){
					//QUEST NON ATTIVA, LA ASSEGNO
					write($fraseAssegna);
					$Ut->notifyStartQuest($questId);
				}else{
					//QUEST GIA ATTIVA, CONTROLLO
					$this->checkQuest($questId, $onTrue, $onFalse);
				}
			}
		}

		public function checkQuest($questId, $onTrue, $onFalse){
			$Ut = $this->getUtente();

			$className = 'Quest'.$questId;
			$Quest = new $className($Ut);

			if($Quest->check()){
				write($onTrue);
				$Quest->clear();
			}else{
				write($onFalse);
			}
		}

		public function printImg(){
			if($this->getData('IMG_PATH') != '')
				write('<a href = "'.$this->getData('IMG_PATH').'"> </a>');
		}

		protected $xml;
		protected $arrXML;

		public function getXMLRisposta($text, $flag){
			$click = $this->arrXML['opzioni'];

			if(count($this->arrXML['opzioni']) > 1)
			{
				foreach($click as $opzione){
					if($opzione['@attributes']['stato'] == $flag){
						$trovato = $opzione;
						break;
					}	
				}
			}else
				$trovato = $click;

			$click = $trovato;

			//$this->utente->sendMessage('prima controllo '.$flag);

			if($click !== null)
				$click = $click['click'];

			if(count($click) == 0)
					return false;
			
			//$this->utente->sendMessage('prima ciclo '.$click[0]['scelta']);

				foreach($click as $opz){
					//$this->utente->sendMessage($opz['scelta'] == $text);
					if($opz['scelta'] == $text){
						$bool = $opz['@attributes']['da-programmare'] == 'true' ? true : false;
						if($bool){
							$variabili = $opz['funzione'];
							//$this->getUtente()->sendMessage(print_r($variabili, TRUE));
						}
						else
							$variabili = array();
						$visibile = $opz['@attributes']['controllo-visibile'] == 'true' ? true : false;
						$risposta = $opz['risposta'];
						return array(
									'risposta' => $risposta,
									'id' => $opz['@attributes']['id'],
									'flag' => $opz['@attributes']['vai-a-stato'],
									'custom' => $bool,
									'controlloVisibile' => $visibile,
									'variabili' => $variabili
								);
					}
				}
			//$this->utente->sendMessage('fine');
			return false;
		}

		public function filterText($text){
			$text = str_replace('_npc.nome_', '<b>'.$this->getData('NOME').'</b>', $text);
			$text = str_replace('\n', "\n", $text);
			return $text;
		}

		public function getXMLKeyboard($flag){
			$xml = $this->arrXML;
	
				//$click = $xml['menu']['opzioni'][$flag];

			$click = $this->arrXML['opzioni'];

			if(count($this->arrXML['opzioni']) > 1)
			{
				foreach($click as $opzione){
					if($opzione['@attributes']['stato'] == $flag){
						$trovato = $opzione;
						break;
					}	
				}
			}else
				$trovato = $click;

			$click = $trovato;

				if($click !== null)
				$click = $click['click'];

			if($click === null || count($click) == 0)
					return false;
	
				$Keyboard = new Keyboard();
				foreach($click as $opz){
					if($opz['@attributes']['controllo-visibile'] == 'true'){
						if($this->{'isVisibile_'.$this->XMLMenu.'_'.$opz['@attributes']['id']}($opz['controlloVisibile']))
							$Keyboard->push($opz['scelta']);
					}else{
						$Keyboard->push($opz['scelta']);
					}
				}
	
			return $Keyboard;
		}

		protected $XMLFraseIniziale;
		protected $XMLMenu;

		public function tryToGetXML($menu = "base"){
			$this->XMLMenu = $menu;
			$path = 'classes/npc/xml/Npc'.$this->getData('ID').'.xml';
			if(file_exists($path)){
				$this->xml = simplexml_load_file($path);
				$xml = &$this->xml;

				$json = json_encode($xml);
				$array = json_decode($json,TRUE);
				//$this->XMLFraseIniziale = $array['menu']['fraseIniziale'];
				
				if(count($array['menu']) == 1){
					$this->arrXML = $array['menu'];
					$this->XMLFraseIniziale = $array['menu']['fraseIniziale'];
				}
				else{
					foreach($array['menu'] as $mn){
						//$this->getUtente()->sendMessage($mn['@attributes']['id'].' = '.$menu);
						if($mn['@attributes']['id'] == $menu){
							$this->arrXML = $mn;
							$this->XMLFraseIniziale = $mn['fraseIniziale'];
							break;
						}
					}

					/*
					$menu = 0;
					$this->arrXML = $array['menu'][$menu];
					$this->XMLFraseIniziale = $array['menu'][$menu]['fraseIniziale'];
					*/
				}

				$this->goForXML();
				return true;
			}else{
				return false;
			}
		}

		public function goForXML(){
			$text = $this->getText();
			$flag = $this->getFlag();

			//$this->utente->sendMessage($flag);

			if($flag == 0)
			{
				write($this->filterText($this->XMLFraseIniziale));
				$this->setKeyFlagStatus($this->getXMLKeyboard(1), 1, 18);
			}
			else
			{
				//$flagPrec = $this->arrXML['menu']['opzioni'][$flag]['vengo-da'];
				$risp = $this->getXMLRisposta($text, $flag);
				if($risp !== false)
				{
					if($risp['custom'])
					{
						$this->{'custom_'.$this->XMLMenu.'_'.$risp['id']}($risp['variabili']);
					}
					else
					{
						write($this->filterText($risp['risposta']));
						$this->setKeyFlagStatus($this->getXMLKeyboard($risp['flag']), $risp['flag'], 18);
					}
				}
				else
				{
					write("Scegli un opzione valida");
					$this->setKeyFlagStatus($this->getXMLKeyboard($flag), $flag, 18);
				}
			}	
		}

		public function getXMLVar($id, $risp){
			//$this->getUtente()->sendMessage($risp[0]['@attributes']['id']);
			/*
			foreach($risp as $var){
				//$this->getUtente()->sendMessage(print_r($risp, TRUE));
				if($var['@attributes']['id'] == $id)
					return $var['val'];
			}
			*/

			//$this->getUtente()->sendMessage(print_r($risp, TRUE));
			$n = count($risp);

			
			if($n == 1){
				foreach($risp['variabile'] as $var){
					if($var['@attributes']['id'] == $id)
						return $this->filterText($var['val']);
					}
			}


			for($i = 0; $i < $n; $i++)
				//$this->getUtente()->sendMessage($risp['variabile'][$i]['@attributes']['id'] .' = '. $id);
				if($risp['variabile'][$i]['@attributes']['id'] == $id)
					return $this->filterText($risp['variabile'][$i]['val']);

			return false;
		}

	}