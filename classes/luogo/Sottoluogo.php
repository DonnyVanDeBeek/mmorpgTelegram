<?php
	Class Sottoluogo extends Luogo{
		private $sottoluogoId;
		private $sottoluogoNome;
		private $sottoluogoDesc;
		private $sottoluogoAmpiezza;
		private $sottoluogoCanTravel;
		private $sottoluogoConquistabile;
		private $sottoluogoPuntiConquista;
		private $sottoluogoImgPath;
		private $sottoluogoTelegramFileId;

		private $luogo_id;

		protected $utente;

		private $db;

		public function __construct($SOTTOLUOGO_ID){
			global $con;
			$this->db = $con->getDB();

			$q = "SELECT * FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_ID = ". $SOTTOLUOGO_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->sottoluogoId 		= $row->SOTTOLUOGO_ID;
			$this->luogo_id 			= $row->SOTTOLUOGO_LUOGO_ID;
			$this->sottoluogoNome 		= $row->SOTTOLUOGO_NOME;
			$this->sottoluogoDesc 		= $row->SOTTOLUOGO_DESC;
			$this->sottoluogoAmpiezza 	= $row->SOTTOLUOGO_AMPIEZZA;
			$this->sottoluogoCanTravel  = $row->SOTTOLUOGO_CAN_TRAVEL;
			$this->sottoluogoPuntiConquista = $row->SOTTOLUOGO_PUNTI_CONQUISTA;
			$this->sottoluogoConquistabile = $row->SOTTOLUOGO_CONQUISTABILE;
			$this->sottoluogoImgPath = $row->SOTTOLUOGO_IMGPATH;
			$this->sottoluogoTelegramFileId = $row->SOTTOLUOGO_TELEGRAM_FILE_ID;

			$q = "SELECT LUOGO_NOME FROM BOT_RPG_LUOGO, BOT_RPG_SOTTOLUOGO WHERE LUOGO_ID = SOTTOLUOGO_LUOGO_ID AND SOTTOLUOGO_ID = ". $this->sottoluogoId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			parent::__construct($this->luogo_id);
		}

		public function getSottoluogoNome(){
			return $this->sottoluogoNome;
		}

		public function getSottoluogoDesc(){
			return $this->sottoluogoDesc;
		}

		public function getSottoluogoId(){
			return $this->sottoluogoId;
		}

		public function getId(){
			return $this->sottoluogoId;
		}

		public function getTelegramFileId(){
			return $this->sottoluogoTelegramFileId;
		}

		public function setTelegramFileId($id){
			$sId = $this->getSottoluogoId();
			$sql = "UPDATE BOT_RPG_SOTTOLUOGO SET SOTTOLUOGO_TELEGRAM_FILE_ID = '$id' WHERE SOTTOLUOGO_ID = $sId";
			Database()->query($sql);
		}

		public function hasTelegramFileId(){
			if($this->getTelegramFileId() != 'null')
				return true;
			else
				return false;
		}

		public function getImgPath(){
			return $this->sottoluogoImgPath;
		}

		public function hasImgPath(){
			if($this->getImgPath() != 'null')
				return true;
			else
				return false;
		}

		public function getSottoluogoAmpiezza(){
			return $this->sottoluogoAmpiezza;
		}

		public function randAvailableX(){
			return rand(0, $this->sottoluogoAmpiezza - 1);
		}

		public function randAvailableY(){
			return rand(0, $this->sottoluogoAmpiezza - 1);
		}

		public function printUtenti(){
			global $emoji;
			$msg = '';
			$msg .= 'Persone presenti in '. $this->sottoluogoNome . '('.$this->getLuogoNome().')' . "\n\n";
			$q = "SELECT UTENTE_NICK, TIMESTAMPDIFF(SECOND, NOW(), UTENTE_DATA_LAST_COMMAND) AS LC FROM BOT_RPG_UTENTE WHERE UTENTE_SOTTOLUOGO_ID = ".$this->sottoluogoId. " ORDER BY TIMESTAMPDIFF(SECOND, NOW(), UTENTE_DATA_LAST_COMMAND) DESC LIMIT 50";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$msg .= ($row->LC > -600 && !is_null($row->LC)) ? $emoji['LARGE_BLUE_CIRCLE'] : $emoji['LARGE_RED_CIRCLE'];
				$msg .= ' ';
				$msg .= $row->UTENTE_NICK;
				$msg .= "\n";
			}
			return $msg;
		}

		public function spawn(&$ut){
			//$ut->clearAllMobHere();
			$ut->setX($this->randAvailableX());
			$ut->setY($this->randAvailableY());
			//$db = new Functions();
			$n = rand(0, 5);
			//$id = $ut->sendMessage('Cercando rogne...');
			for($i = 0; $i < $n; $i++)
				$this->randomSpawn($ut);
			//$ut->deleteMessage($id);
			//$db->spostaMob($ut);
			//$ut->spawnUserInRandomPositionOfSottoluogo();
		}

		public function stepIn(){
			$this->utente->setUtenteSottoluogoId($this->getSottoluogoId());
			write('<b>'.$this->getSottoluogoNome()."</b>\n\n".$this->getSottoluogoDesc());
		}

		public function setUtente(&$ut){
			$this->utente = $ut;
		}

		public function randomSpawn(&$ut){
			$ul = $ut->getUtenteLevel();
			$osc = 2;
			$lvl = rand( ($ul <= $osc) ? 1 : ($ul - $osc), $ul + $osc );

			$nome = rand(100, 77000);
			$gaus = 0;
			$pm = 2;
			$pa = 2;
			$x  = $this->randAvailableX();
			$y  = $this->randAvailableY();

			$arrMob = Functions::getRandomSpawnBySottoluogoId($this->getSottoluogoId());

			if($arrMob === false)
				return false;

			$mobId = $arrMob['MOB_ID'];
			$lvl = $arrMob['MOB_LVL'];

			$sum = Functions::getTipoMobMaxHp($mobId, $lvl);

			//".Functions::getMaxIdMob().",

			$db = Database();

			$q = "INSERT INTO BOT_RPG_MOB VALUES (
						null,
						".$mobId.",
						".$this->getSottoluogoId().",
						".$lvl.",
						".$ut->getUtenteId().",
						".$sum.",
						'".$nome."',
						".$gaus.",
						".$pm.",
						".$pa.",
						".$x.",
						".$y.",
						".$ut->getId().",
						".$ut->getEntitaId().",
						0
						)";
			$db->query($q);

			$className = 'Mob'.$mobId;
			$Mob = new $className($db->insert_id);
			unset($Mob);

			return true;
		}

		public function drawMap(){
			$X0 = $this->getX();
			$Y0 = $this->getY();

			$alphab = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'Y', 'Z');
			$luogo = array();
			$i = 0;

			$height = 10;
			$width = 10;
			$sql = "SELECT LUOGO_NOME, LUOGO_X, LUOGO_Y FROM BOT_RPG_LUOGO WHERE (LUOGO_X BETWEEN $X0 - $width AND $X0 + $width) AND (LUOGO_Y BETWEEN $Y0 - $height AND $Y0 + $height) ORDER BY LUOGO_Y DESC, LUOGO_X";
			$res = Database()->query($sql);
			//global $ut;
			//$ut->sendMessage($sql);
			while($row = $res->fetch_object()){
				$luogo[$i]['NOME'] = $row->LUOGO_NOME;
				$luogo[$i]['X']	   = $row->LUOGO_X - $X0;
				$luogo[$i]['Y']	   = $row->LUOGO_Y - $Y0;
				$i++;
			}

			$n = count($luogo);

			$map = '';
			$nomi = '';
			$c = 0;
			$printed = false;

			$amp = 10;

			$map .= "<code>";
			$map .= ' '.str_repeat('_', $amp*2);
			$map .= "\n";

			for($i = $amp - 1; $i > -$amp; $i--){
				$map .= "|";
				for($j = -$amp; $j < $amp; $j++){
					for($k = 0; $k < $n; $k++){
						if($luogo[$k]['Y'] == $i && $luogo[$k]['X'] == $j){
							$map .= $alphab[$c];
							$nomi .= '('.$alphab[$c].') '.$luogo[$k]['NOME']."\n\n";
							$c++;
							$printed = true;
						}
					}
					if(!$printed){
						$map .= ' ';
					}
					$printed = false;
				}
				$map .= "|\n";
			}

			$map .= ' '.str_repeat('¯', $amp*2);
			$map .= "</code>";

			//global $ut;
			//$ut->sendMessage($nomi."\n".$map);

			return $map."\n".$nomi;
		}

		public function getUtente(){
			return $this->utente;
		}

		/*
		public function isThereAnyone($x, $y, &$ut){

		}

		public function isThereAnyMob($x, $y, &$ut){

		}
		*/

		public function getNearSottoluoghiArrayId(){
			$sql = "SELECT SBOCCO_SOTTOLUOGO_ID FROM BOT_RPG_SOTTOLUOGO_SBOCCHI WHERE PARTENZA_SOTTOLUOGO_ID = ".$this->getSottoluogoId();
			$res = Database()->query($sql);
			$arr = array();
			while($row = $res->fetch_object()){
				$arr[] = $row->SBOCCO_SOTTOLUOGO_ID;
			}
			return $arr;
		}

		public function getNearSottoluoghiArrayNomi(){
			/*
			$res = array();
			$arr = $this->getNearSottoluoghiArrayId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				$Sottoluogo = new Sottoluogo($arr[$i]);
				$res[] = $Sottoluogo->getSottoluogoNome();
			}
			return $res;
			*/
			$sql = "SELECT DISTINCT(SOTTOLUOGO_NOME) FROM BOT_RPG_SOTTOLUOGO_SBOCCHI, BOT_RPG_SOTTOLUOGO WHERE SBOCCO_SOTTOLUOGO_ID = SOTTOLUOGO_ID AND PARTENZA_SOTTOLUOGO_ID = ".$this->getSottoluogoId();
			$res = Database()->query($sql);
			$arr = array();
			while($row = $res->fetch_object()){
				$arr[] = $row->SOTTOLUOGO_NOME;
			}
			return $arr;
		}

		public function getNearSottoluoghiVisibiliArrayNomi($sottoluogoId){
			$sql = "SELECT DISTINCT(SOTTOLUOGO_NOME), SOTTOLUOGO_ID AS ID FROM BOT_RPG_SOTTOLUOGO_SBOCCHI, BOT_RPG_SOTTOLUOGO WHERE SBOCCO_SOTTOLUOGO_ID = SOTTOLUOGO_ID AND PARTENZA_SOTTOLUOGO_ID = ".$sottoluogoId;
			$res = Database()->query($sql);
			$arr = array();
			while($row = $res->fetch_object()){
				$static = 'Sottoluogo'.$row->ID;
				if($static::isVisibile())
					$arr[] = $row->SOTTOLUOGO_NOME;
			}
			return $arr;
		}

		public function isSottoluogoNear($sottoluogoId){
			$arr = $this->getNearSottoluoghiArrayId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				if($arr[$i] == $sottoluogoId)
					return true;
			}
			return false;
		}

		public function summonMob($array){
			$tipoMobId = $array['ID'];
			$sottoluogoId = $this->getSottoluogoId();
			$livello = $array['LVL'];
			$utenteId = $array['UTENTE_ID'];
			$mobHp = $array['HP'];
			$nomeProprioId = isset($array['NOME_ID']) ? $array['NOME_ID'] : rand(100, 80000);
			$flagTarget = 99;
			$pm = 5;
			$pa = 5;
			$x = $array['X'];
			$y = $array['Y'];
			$targetId = $array['TARGET_ID'];
			$targetEntitaId = $array['TARGET_ENTITA_ID'];
			$pet = isset($array['PET']) ? $array['PET'] : 0;
			$Functions = new Functions();
			$Functions->spawnSpecificMob(
				$tipoMobId, 
				$sottoluogoId, 
				$livello, 
				$utenteId, 
				$mobHp, 
				$nomeProprioId, 
				$flagTarget, 
				$pm, 
				$pa, 
				$x, 
				$y,
				$targetId,
				$targetEntitaId,
				$pet
			);
		}

		public function canTravel(){
			$sottoluogoId = $this->getSottoluogoId();
			$sql = "SELECT SOTTOLUOGO_CAN_TRAVEL AS T FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_ID = $sottoluogoId";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			//write('$row->T = '.$row->T);
			if($row->T != 0)
				return true;
			else
				return false;
		}

		public function scappa(){
			write($this->utente->getNome().' scampa il pericolo!'."\n");
			return true;
		}

		//Azioni
		public function esplorazione(){
			if($this->getUtente()->getId() != 12 && $this->getUtente()->getId() != 13){
				if($this->getUtente()->staEsplorando()){
					write('Potrai esplorare di nuovo alle ore '.$this->getUtente()->getTimeNextEsplorazione());
					return false;
				}
			}

			$flag = false;
			$esplId = null;
			$id = $this->getId();

			$sql = "SELECT TIPO_ESPLORAZIONE_ID, TIPO_ESPLORAZIONE_PERCENTUALE FROM BOT_RPG_TIPO_ESPLORAZIONE WHERE TIPO_ESPLORAZIONE_SOTTOLUOGO_ID = $id ORDER BY RAND()";
			$res = Database()->query($sql);

			if($res->num_rows == 0){
				write('Non c\'è nulla da esplorare qui!');
				return false;
			}

			while($row = $res->fetch_object()){
				$r = rand(0, 10000000);
				//$r : 10000000 = $row->perc : 100;
				$perc = ($r*100)/10000000;
				if($perc <= $row->TIPO_ESPLORAZIONE_PERCENTUALE){
					$flag = true;
					$esplId = $row->TIPO_ESPLORAZIONE_ID;
				}
			}

			if($flag){
				$className = 'Esplorazione'.$esplId;
				$ut = $this->getUtente();
				$Esp = new $className($ut);
				if($Esp->start()){
					$sec = $Esp->getData('DURATA_SECONDI');
					$this->getUtente()->iniziaEsplorazione($sec, $esplId);
				}else{
					write('Non hai trovato nulla!'."\n");
				}
			}else{
				write('Non hai trovato nulla!'."\n");
			}

			return $flag;
		}

		public function viaggioParte(&$ut, &$destinazione){

		}

		public function viaggioArriva(&$ut, &$partenza){
			
		}

		public function isVisibile(){
			return true;
		}

		public function canAttempToStepIn(){
			return $this->isVisibile();
		}


	}
