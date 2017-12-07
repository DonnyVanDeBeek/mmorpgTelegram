<?php
	Class Utente{
		protected $utenteId;
		protected $utenteTelegramId;
		protected $utenteNome;
		protected $utenteChatId;
		protected $utenteClasseId;
		protected $utenteStatoRegistrazioneId;
		protected $utenteSottoluogoId;
		protected $utenteStatoId;
		protected $utenteSoldi;
		protected $utentExp;
		protected $utenteDataRegistrazione;
		protected $utenteHp;
		protected $utentePve;

		protected $level;

		protected $OBJSottoluogo;
		protected $OBJClasse;

		//public static $db;

		protected $db;

		//Constructor
		public function __construct($UTENTE_ID){
			global $con;
			$this->db = &$con->getDB();

			$q = "SELECT * FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ". $UTENTE_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->utenteId								= $row->UTENTE_ID;
			$this->utenteTelegramId				= $row->UTENTE_TELEGRAMID;
			$this->utenteNome							= $row->UTENTE_NICK;
			$this->utenteChatId						= $row->UTENTE_CHATID;
			$this->utenteClasseId					= $row->UTENTE_CLASSE_ID;
			$this->utenteStatoRegistrazioneId 	= $row->UTENTE_STATO_REGISTRAZIONE_ID;
			$this->utenteSottoluogoId			= $row->UTENTE_SOTTOLUOGO_ID;
			$this->utenteStatoId				= $row->UTENTE_STATO_ID;
			$this->utenteSoldi					= $row->UTENTE_SOLDI;
			$this->utenteExp					= $row->UTENTE_EXP;
			$this->utenteDataRegistrazione		= $row->UTENTE_DATA_REGISTRAZIONE;
			$this->utenteHp						= $row->UTENTE_HP;
			$this->utentePve					= $row->UTENTE_PVE;

			$this->OBJSottoluogo = new Sottoluogo($this->getUtenteSottoluogoId());
			$this->OBJClasse	 = new Classe($this->getUtenteClasseId());

			$this->utenteLevel = $this->calculateLevel();

			$this->setUtenteHp($this->getUtenteHp());

		}

		public function getNome(){
			return $this->utenteNome;
		}

		//Getters
		public function getOBJSottoluogo(){
			return $this->OBJSottoluogo;
		}

		public function getOBJClasse(){
			return $this->OBJClasse;
		}

		public function getUtenteLevel(){
			return $this->utenteLevel;
		}

		public function getUtenteSoldi(){
			return $this->utenteSoldi;
		}

		public function getUtenteStatoId(){
			return $this->utenteStatoId;
		}

		public function getUtenteHp(){
			return $this->utenteHp;
		}

		public function getUtenteId(){
			return $this->utenteId;
		}

		public function getUtenteSottoluogoId(){
			return $this->utenteSottoluogoId;
		}

		public function getUtenteChatId(){
			return $this->utenteChatId;
		}

		public function getUtenteNome(){
			return $this->utenteNome;
		}

		public function getUtenteExp(){
			return $this->utenteExp;
		}

		public function getUtenteClasseId(){
			return $this->utenteClasseId;
		}

		//Fine Getters


		//Setters
		public function setUtenteStatoId($a){
			$this->utenteStatoId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_STATO_ID = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteSoldi($a){
			$this->soldi = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_SOLDI = ". $a ."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteHp($a){
			$this->utenteHp = $a;
			$this->utenteHp = ($this->getTotalStat('HP') < $this->utenteHp ? $this->getTotalStat('HP') : $this->utenteHp);
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_HP = ". $this->utenteHp ."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteExp($a){
			$this->utenteExp = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_EXP = ". $a . "
				WHERE UTENTE_ID = " . $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteSottoluogoId($id){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_SOTTOLUOGO_ID = ".$id."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
			$this->utenteSottoluogoId = $id;
		}
		//Fine Setters

		//Altri Getters

		public function getPercentualeStat($stat, $percentuale){
			$sta = $this->getTotalStat($stat);
			$perc = intVal(($sta * $percentuale) / 100);
			return $perc;
		}

		public function getTotalStat($stat){
			$tot = 0;

			$tot = $tot + $this->getStatFromClasse($stat);

			$tot = $tot + $this->getStatFromEquip($stat);

			if(strtoupper($stat) != 'HP')
				$tot = $tot + $this->getStatFromBuff($stat);

			return $tot;
		}

		public function isBuffed(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_BUFF
				WHERE TIMESTAMPDIFF(SECOND,NOW(),BUFF_DATA_SCADENZA) > 0
					AND BUFF_DURATA_TURNI > 0
					AND BUFF_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}

		public function getStatFromBuff($stat){
			$tot = 0;
			if($this->isBuffed()){
				$q = "
					SELECT BUFF_".strtoupper($stat)." AS STA
					FROM BOT_RPG_BUFF
					WHERE TIMESTAMPDIFF(SECOND,NOW(),BUFF_DATA_SCADENZA) > 0
						AND BUFF_DURATA_TURNI > 0
						AND BUFF_UTENTE_ID = ". $this->utenteId;
				$res = $this->db->query($q);
				while($row = $res->fetch_object()){
					$tot = $tot + $row->STA;
				}
			}
			return $tot;
		}

		public function getStatFromClasse($stat){
			/*
			$q = "
				SELECT CLASSE_".strtoupper($stat) ." AS STATS
				FROM BOT_RPG_CLASSE
				WHERE CLASSE_ID = ".$this->utenteClasseId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$tot = $row->STATS * $this->utenteLevel;
			return $tot;
			*/
			$method = 'getClasse'.ucfirst(strtolower($stat));
			return $this->getOBJClasse()->$method() * $this->utenteLevel;
		}

		public function getStatFromEquip($stat){
			$tot = 0;
			if($this->hasSomethingEquipped()){
				$q = "
					SELECT TIPO_EQUIP_".strtoupper($stat)." AS STA, EQUIP_LIVELLO AS LVL
					FROM BOT_RPG_UTENTE, BOT_RPG_TIPO_EQUIP, BOT_RPG_EQUIP
					WHERE UTENTE_ID = EQUIP_UTENTE_ID
						AND EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
						AND EQUIP_ATTIVO = 1
						AND UTENTE_ID = ". $this->utenteId;
				$res = $this->db->query($q);
				while($row = $res->fetch_object()){
					if($row->STA != 0)
						$tot = $tot + $row->STA + (intVal($row->STA/10) * $row->LVL);
				}
			}
			return $tot;
		}

		public function areThereMobs(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}

		public function isInViaggio(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_VIAGGIO
				WHERE TIMESTAMPDIFF(SECOND,NOW(),DATA_ARRIVO) > 0
					AND UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}

		public function getEquipInfo($EQUIP_ID){
			$str = '';
			$stats = array('forza', 'intelligenza', 'saggezza', 'destrezza', 'costituzione', 'carisma');
			$q = "
				SELECT *
				FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP
				WHERE EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
				AND EQUIP_ID = ". $EQUIP_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$str = ucfirst($row->TIPO_EQUIP_NOME). ' (+'.$row->EQUIP_LIVELLO.')' ."\n";
			for($i = 0; $i < 6; $i++){
				$stmt = 'TIPO_EQUIP_'.strtoupper($stats[$i]);
				if($row->{$stmt} != 0){
					if($row->{$stmt} > 0) $sign = '+';
					else $sign = '';
					$str .= $sign . ($row->{$stmt}  + ($row->EQUIP_LIVELLO * intVal($row->{$stmt}/10) )) . ' ' . ucfirst($stats[$i]) . "\n";
				}
			}
			return $str;
		}

		public function getIdsEquipActive(){
			$eqID = array();
			$q = "
				SELECT EQUIP_ID
				FROM BOT_RPG_UTENTE, BOT_RPG_EQUIP
				WHERE UTENTE_ID = EQUIP_UTENTE_ID
					AND EQUIP_ATTIVO = 1
					AND UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$eqID[] = $row->EQUIP_ID;
			}

			return $eqID;
		}

		public function hasSomethingEquipped(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_EQUIP
				WHERE EQUIP_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function getSkillsButtons(){
			$data = '';
			$q = "
				SELECT *
				FROM BOT_RPG_SKILL
				WHERE SKILL_LIVELLO_SBLOCCO <= ". $this->utenteLevel ."
					AND SKILL_CLASSE_ID = ". $this->utenteClasseId;
			$res = $this->db->query($q);
			$nr = $res->num_rows;
			$i = 1;
			while($row = $res->fetch_object()){
				$data .= '["'.$row->SKILL_NOME.'"]';
				if($i != $nr){
					$data .= ', ';
				}
				$i++;
			}
			return $data;
		}

		public function hasItemAlready($tipoItemId){
			$q = "SELECT COUNT(*) AS C, ITEM_QUANTITA AS QUAN FROM BOT_RPG_ITEM WHERE TIPO_ITEM_ID = ".$tipoItemId." AND UTENTE_ID = ".$this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else if($row->QUAN == 0) return false;
			else return true;
		}

		public function gainItem($tipoItemId){
			if($this->hasItemAlready($tipoItemId)){
				$q = "UPDATE BOT_RPG_ITEM SET ITEM_QUANTITA = ITEM_QUANTITA + 1 WHERE UTENTE_ID  = ".$this->utenteId;
			}else{
				$q = "INSERT INTO BOT_RPG_ITEM VALUES (".$tipoItemId.", ".$this->utenteId.", 1)";
			}
			$this->db->query($q);
		}
		//Fine altri getters

		//Metodi per telegram
		public function sendMessage($message){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/sendMessage?chat_id=".$this->utenteChatId."&text=".urlencode($message)."&parse_mode=HTML");
		}

		public function getProfilePhoto(){
			global $BT;
			return json_decode(file_get_contents('https://api.telegram.org/bot'.$BT.'/getUserProfilePhotos?user_id='.$this->getUtenteChatId()))->result->photos['0']['0']->file_id;
		}

		public function getFile($id){
			global $BT;
			return json_decode(file_get_contents("https://api.telegram.org/bot".$BT."/getFile?file_id=".$id))->result->file_path;
		}

		public function sendProfilePic(){
			global $BT;
			file_put_contents("tmp/file/ok.jpg", file_get_contents('https://api.telegram.org/file/bot'.$BT.'/'.$this->getFile($this->getProfilePhoto())));
			$bot_url    = "https://api.telegram.org/bot".$BT."/";
			$url        = $bot_url . "sendPhoto?chat_id=" . $this->getUtenteChatId();

			//imagepng(imagecreatefromstring(file_get_contents("tmp/file/mod".$this->getChatId()), "tmp/file/modf".$this->getChatId());

			$img = file_put_contents("tmp/file/mod".$this->getUtenteChatId().'.jpg', file_get_contents('http://www.lorenzodona.it/telegram/bot/rpg_bot/img.php?text='.$this->getUtenteNome().'&p='.$this->getFile($this->getProfilePhoto()).'&class='.$this->getOBJClasse()->getClasseNome()));

			$post_fields = array('chat_id'   => $this->getUtenteChatId(),
				'photo'     => new CURLFile(realpath("tmp/file/mod".$this->getUtenteChatId().".jpg"))
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type:multipart/form-data"
			));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			$output = curl_exec($ch);
		}



		//Fine metodi per telegram

		//Combattimento
		public function noTargetErr(){
			return 'Non puoi usare questa skill senza un target';
		}

		public function subisciDanno($dealer, $dmg){
			$dmg = $dmg - $this->getTotalStat('COSTITUZIONE');
			if($dmg < 0) $dmg = 0;
			$this->setUtenteHp($this->getUtenteHp() - $dmg);
			return $dmg;
		}

		public function respawn(){
			$this->setUtenteHp($this->getTotalStat('HP'));
		}

		public function attacca($mob){
			$dmg = $mob->getTotalStat('COSTITUZIONE') - $this->getTotalStat('FORZA');
			if($dmg >= 0) $dmg = -1;
			$mob->setUtenteHp($mob->getMobHp() - ($dmg * -1));
			return $dmg * -1;
		}

		public function lowerTurniBuff($numTurni){
			$q = "
				UPDATE BOT_RPG_BUFF
				SET BUFF_DURATA_TURNI = BUFF_DURATA_TURNI - ".$a."
				WHERE BUFF_UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function scanForMob(){
			$q = "
				SELECT MOB_ID
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->MOB_ID;
		}

		//Fine Combattimento

		//Spostamenti
		public function getTempoRimanenteViaggio(){
			$q = "
				SELECT DATA_ARRIVO
				FROM BOT_RPG_VIAGGIO
				WHERE TIMESTAMPDIFF(SECOND,NOW(),DATA_ARRIVO) > 0
					AND UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->DATA_ARRIVO;
		}

		public function viaggio($part, $dest){
			$durata = 600 * $part->distanceFrom($dest);
			$q = "
				INSERT INTO BOT_RPG_VIAGGIO
				VALUES (".
						$this->utenteId.", ".
						$part->getLuogoId().", ".
						$dest->getLuogoId().",
						NOW(),
						DATE_ADD(NOW(), INTERVAL ".$durata." SECOND)
						)";
			$this->db->query($q);
		}
		//Fine Spostamenti

		//Miscellaneous
		public function calculateLevel(){
			//$var = $this->xp / 10;
			$e = $this->utenteExp;
			for($i = 1; $e > 0; $i++){
				$e -= $i * 20;
			}
			return $i - 1;
		}

		public function printMobs(){
			if(!$this->areThereMobs()) return 'Non c\'è nessuno...';
			$msg = '';
			$q = "
				SELECT *
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$mob = new Mob($row->MOB_ID);
				$msg .= "<b>".$mob->getTipoMobNome()." ".$mob->getMobNomeProprio()." LVL ".$mob->getMobLevel()." </b><i>".$mob->getMobHp()."/".$mob->getTotalStat('HP')." HP</i>\n";
			}
			return $msg;
		}

		public function printUtenteInfo(){
			$ut = $this;
			$msg  = '';
			$msg .= ucfirst($ut->getUtenteNome());
			$msg .= ' (' . ucfirst($ut->getOBJClasse()->getClasseNome()) . ')';
			$msg .= "\n";
			$msg .= '<i>Livello '.$ut->calculateLevel().'</i>';
			$msg .= "\n";
			$msg .= $ut->getUtenteSoldi() . ' monete';
			$msg .= "\n\n";
			$msg .= '<b>Punti Vita</b>: '		. $ut->getUtenteHp() . '/' . $ut->getTotalStat('HP') . "\n";
			$msg .= '<b>Forza</b>: ' 			. $ut->getTotalStat('Forza') . "\n";
			$msg .= '<b>Costituzione</b>: ' 	. $ut->getTotalStat('Costituzione') . "\n";
			$msg .= '<b>Carisma</b>: ' 			. $ut->getTotalStat('Carisma') . "\n";
			$msg .= '<b>Intelligenza</b>: ' 	. $ut->getTotalStat('Intelligenza') . "\n";
			$msg .= '<b>Destrezza</b>: ' 		. $ut->getTotalStat('Destrezza') . "\n";
			$msg .= '<b>Saggezza</b>: ' 		. $ut->getTotalStat('Saggezza') . "\n";
			return $msg;
		}

		/*public function selectAllMobs(){
			$data = array();
			$q = "
				SELECT *
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId;."
					ORDER BY(MOB_BATTLE_ID)"
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$mob = new Mob($row->MOB_ID);
				$data[] = $mob->getNome() .'--L'.$mob->
		}*/
		//Fine Miscellaneous

	}
