<?php
	Class Utente extends Creatura{
		protected $utenteX;
		protected $utenteY;
		protected $utenteId;
		protected $utenteHp;
		protected $utentePA;
		protected $utentePM;
		protected $utenteExp;
		protected $utentePve;
		protected $utenteNome;
		protected $utenteNpcId;
		protected $utenteSoldi;
		protected $utenteChatId;
		protected $utenteRazzaId;
		protected $utenteStatoId;
		protected $utenteSkillId;
		protected $utenteEquipId;
		protected $utenteUtenteId;
		protected $utenteDirezione;
		protected $utenteStoryline;
		protected $utenteTelegramId;
		protected $utenteSottoluogoId;
		protected $utenteDataLastCommand;
		protected $utenteCategoriaEquipId;
		protected $utenteDataRegistrazione;
		protected $utenteStatoRegistrazioneId;

		protected $level;

		protected $saltaTurno;

		protected $entitaId = 0;

		protected $OBJEquips = array();

		//protected $OBJSottoluogo;
		protected $OBJClasse;


		protected $Target;
		//public static $db;

		protected $msg = array();

		protected $db;

		//Constructor
		public function __construct($UTENTE_ID){
			//global $con;
			//$this->db = &$con->getDB();
			$this->db = Database();

			$q = "SELECT * FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ". $UTENTE_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->utenteX						= &$row->UTENTE_X;
			$this->utenteY						= &$row->UTENTE_Y;
			$this->utentePA						= &$row->UTENTE_PA;
			$this->utentePM						= &$row->UTENTE_PM;
			$this->utenteId						= &$row->UTENTE_ID;
			$this->utenteHp						= &$row->UTENTE_HP;
			$this->utenteExp					= &$row->UTENTE_EXP;
			$this->utentePve					= &$row->UTENTE_PVE;
			$this->utenteNome					= &$row->UTENTE_NICK;
			$this->utenteSoldi					= &$row->UTENTE_SOLDI;
			$this->utenteNpcId					= &$row->UTENTE_NPC_ID;
			$this->utenteChatId					= &$row->UTENTE_CHATID;
			$this->utenteEquipId                = &$row->UTENTE_EQUIP_ID;
			$this->utenteRazzaId				= &$row->UTENTE_RAZZA_ID;
			$this->utenteStatoId				= &$row->UTENTE_STATO_ID;
			$this->utenteSkillId				= &$row->UTENTE_SKILL_ID;
			$this->utenteDirezione				= &$row->UTENTE_DIREZIONE;
			$this->utenteStoryline 				= &$row->UTENTE_STORYLINE;
			$this->utenteUtenteId				= &$row->UTENTE_UTENTE_ID;
			$this->utenteTelegramId				= &$row->UTENTE_TELEGRAMID;
			$this->utenteSottoluogoId			= &$row->UTENTE_SOTTOLUOGO_ID;
			$this->utenteDataLastCommand		= &$row->UTENTE_DATA_LAST_COMMAND;
			$this->utenteCategoriaEquipId		= &$row->UTENTE_CATEGORIA_EQUIP_ID;
			$this->utenteDataRegistrazione		= &$row->UTENTE_DATA_REGISTRAZIONE;
			$this->utenteStatoRegistrazioneId 	= &$row->UTENTE_STATO_REGISTRAZIONE_ID;

			//$this->OBJSottoluogo = new Sottoluogo($this->getUtenteSottoluogoId());
			//$this->OBJClasse	 = new Classe($this->getUtenteClasseId());

			$this->utenteLevel = $this->calculateLevel();

			//$this->setUtenteHp($this->getUtenteHp());

		}

		public function getStoryline(){
			return $this->utenteStoryline;
		}

		public function setStoryline($a){
			$this->utenteStoryline = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_STORYLINE = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			Database()->query($q);
		}

		public function isDonny(){
			$id = $this->getId();
			if($id == 12)
				return true;
			else
				return false;
		}

		public function getUtenteUtenteId(){
			return $this->utenteUtenteId;
		}

		public function getSymbol(){
			return '#';
		}

		public function doesSaltaTurno(){
			return $this->saltaTurno;
		}

		public function setSaltaTurno($a){
			$this->saltaTurno = $a;
		}

		public function setUtenteUtenteId($a){
			$this->utenteUtenteId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_UTENTE_ID = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function getEntitaId(){
			return $this->entitaId;
		}

		public function getMsg($name){
            return $this->msg[$name];
        }

		///
		public function getNome(){
			//return $this->utenteNome;
			return $this->utenteTelegramId;
		}

		public function getId(){
			return $this->utenteId;
		}

		/*
		public function isVivo(){
			$a = $this->getUtenteHp() > 0;
			if($a > 0) return true;
			else return false;
		}
		*/

		public function isVivo(){
			$sql = "SELECT UTENTE_HP FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ".$this->getId();
			if(Database()->query($sql)->fetch_object()->UTENTE_HP > 0)
				return true;
			else
				return false;
		}
		///


		public function getUtenteSkillId(){
			return $this->utenteSkillId;
		}

		public function getTarget(){
			return $this->Target;
		}

		public function setTarget(&$a){
			$this->Target = $a;
		}

		//Getters
		/*
		public function getOBJSottoluogo(){
			return $this->OBJSottoluogo;
		}
		*/

		public function getUtenteX(){
			return $this->utenteX;
		}

		public function getUtenteY(){
			return $this->utenteY;
		}

		public function getUtentePM(){
			return $this->utentePM;
		}

		public function getUtentePA(){
			return $this->utentePA;
		}

		public function getDynamicId(){
			return $this->utentePA;
		}

		public function getOBJClasse(){
			return $this->OBJClasse;
		}

		public function getUtenteRazzaId(){
			return $this->utenteRazzaId;
		}

		public function getUtenteDataLastCommand(){
			return $this->utenteDataLastCommand;
		}

		public function getUtenteLevel(){
			return $this->utenteLevel;
		}

		public function getLevel(){
			return $this->getUtenteLevel();
		}

		public function getUtenteSoldi(){
			return $this->utenteSoldi;
		}

		public function getTargetId(){
			return $this->getId();
		}

		public function getSoldi(){
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

		public function getUtenteNpcId(){
			return $this->utenteNpcId;
		}

		public function getUtenteCategoriaEquipId(){
			return $this->utenteCategoriaEquipId;
		}

		public function getUtenteEquipId(){
			return $this->utenteEquipId;
		}

		public function getUtenteDirezione(){
			return $this->utenteDirezione;
		}

		public function getCategoria(){
			return 0;
		}

		//Fine Getters


		//Setters
		public function setDynamicId($a){
			$this->utentePA = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_PA = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteNpcId($a){
			$this->utenteNpcId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_NPC_ID = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtentePM($a){
			$this->utentePM = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_PM = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtentePA($a){
			$this->utentePA = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_PA = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteSkillId($a){
			$this->utenteSkillId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_SKILL_ID = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteStatoId($a){
			$this->utenteStatoId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_STATO_ID = " . $a . "
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function aumUtenteStatoRegistrazioneId(){
			$this->utenteStatoRegistrazioneId = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_STATO_REGISTRAZIONE_ID = UTENTE_STATO_REGISTRAZIONE_ID + 1
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
			$db = Database();
			$this->utenteHp = intVal($a);
			$this->utenteHp = ($this->getTotalStat('HP') < $this->utenteHp ? $this->getTotalStat('HP') : $this->utenteHp);
			/*
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_HP = ". $this->utenteHp ."
				WHERE UTENTE_ID = ". $this->utenteId;
			*/
			$q = "UPDATE BOT_RPG_UTENTE SET UTENTE_HP = ? WHERE UTENTE_ID = ?";
			$sql = $db->prepare($q);
			$sql->bind_param('ii', $this->utenteHp, $this->utenteId);
			$sql->execute();
			//$this->db->query($q);
		}

		public function setHp($a){
			$this->setUtenteHp($a);
		}

		public function getHp(){
			return $this->getUtenteHp();
		}

		public function setUtenteExp($a){
			$this->utenteExp = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_EXP = ". $a . "
				WHERE UTENTE_ID = " . $this->utenteId;
			$this->db->query($q);
		}

		public function setSottoluogoId($a){
			$this->setUtenteSottoluogoId($a);
		}

		public function setUtenteSottoluogoId($a){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_SOTTOLUOGO_ID = ".$a."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
			$this->utenteSottoluogoId = $a;
		}

		public function setUtenteCategoriaEquipId($a){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_CATEGORIA_EQUIP_ID = ".$a."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
			$this->utenteCategoriaEquipId = $a;
		}

		public function setUtenteEquipId($a){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_EQUIP_ID = ".$a."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
			$this->utenteEquipId = $a;
		}

		public function setUtenteDirezione($a){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_DIREZIONE = ".$a."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
			$this->utenteDirezione = $a;
		}

		//Fine Setters

		//Altri Getters

		public function getPercentualeStat($stat, $percentuale){
			$sta = $this->getTotalStat($stat);
			$perc = intVal(($sta * $percentuale) / 100);
			return $perc;
		}

		public function getStatFromPunti($statId){
			if(isset($this->arrStat[$statId]['punti']))
				return $this->arrStat[$statId]['punti'];

			if(!$this->hasAlreadyAddedPointsTo($statId)) return 0;
			$statXpunto = 1;
			$q = "SELECT NUM_PUNTI AS C
				  FROM  BOT_RPG_STAT_PUNTI
				  WHERE STAT_ID = ".$statId."
				  AND UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$this->arrStat[$statId]['punti'] = $row->C * $statXpunto;
			return $row->C * $statXpunto;
		}

		public function canAddPunti(){
			$q = "SELECT SUM(NUM_PUNTI) AS S FROM BOT_RPG_STAT_PUNTI WHERE UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->S < ($this->calculateLevel()*5 + 10)) return true;
			else return false;
		}

		public function hasAlreadyAddedPointsTo($statId){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_STAT_PUNTI WHERE UTENTE_ID = ".$this->getUtenteId()." AND STAT_ID = ".$statId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function puntiRimanenti(){
			$q = "SELECT SUM(NUM_PUNTI) AS S FROM BOT_RPG_STAT_PUNTI WHERE UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return ($this->calculateLevel()*5 + 10) - $row->S;
		}

		public function aggiungiPunto($stat){
			if(!$this->canAddPunti()) return 'Non hai punti da aggiungere!';

			$fu = new Functions();
			$statId = $fu->getStatIdFromName($stat);

			if($statId === false) return 'Non esiste una statistica del genere';

			if($this->hasAlreadyAddedPointsTo($statId))
				$q = "UPDATE BOT_RPG_STAT_PUNTI SET NUM_PUNTI = NUM_PUNTI + 1 WHERE UTENTE_ID = ".$this->getUtenteId()." AND STAT_ID = ".$statId;
			else
				$q = "INSERT INTO BOT_RPG_STAT_PUNTI VALUES(".$statId.", ".$this->getUtenteId().", 1)";
			$this->db->query($q);

			return 'Punto aggiunto con successo!' . "\n" . 'Punti rimanenti: ' . $this->puntiRimanenti();
		}

		/*
		public function getStatFrom($statId, $tableName){
			$q = "SELECT * FROM BOT_RPG_STAT_".strtoupper($tableName)." WHERE STAT_ID = ".$statId;
			if(strtoupper($tableName) != 'RAZZA')
				$q .= " AND UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			$row =

		}
		*/

		public function getStatFromRazza($statId){
			if(isset($this->razzaStat[$statId]))
				return $this->razzaStat[$statId];

			$q = "SELECT VALUE FROM BOT_RPG_STAT_RAZZA WHERE RAZZA_ID = ".$this->getUtenteRazzaId()." AND STAT_ID = ".$statId;
			$res = $this->db->query($q);
			if($res->num_rows == 0) return 0;
			$row = $res->fetch_object();
			$this->arrStat[$statId]['razza'] = $row->VALUE;
			return $row->VALUE;
		}

		public function getTotalStatNoBuff($stat){
			$tot = 0;
			$limit = 1000;

			$fu = new Functions();
			$statId = $fu->getStatIdFromName($stat);
			//$tot = $tot + $this->getStatFromClasse($stat);
			$tot = $tot + $this->getStatFromRazza($statId);
			$tot = $tot + $this->getStatFromPunti($statId);
			$tot = $tot + $this->getStatFromEquip($statId);
			//$tot = $tot + $this->getStatFromBuff($statId);

			//if($tot > $limit)
				//$tot = $limit;

			return $tot;
		}

		public function getTotalStatNoEquip($stat){
			$tot = 0;
			$limit = 1000;

			$fu = new Functions();
			$statId = $fu->getStatIdFromName($stat);
			//$tot = $tot + $this->getStatFromClasse($stat);
			$tot = $tot + $this->getStatFromRazza($statId);
			$tot = $tot + $this->getStatFromPunti($statId);
			//$tot = $tot + $this->getStatFromEquip($statId);
			$tot = $tot + $this->getStatFromBuff($statId);

			//if($tot > $limit)
				//$tot = $limit;

			return $tot;
		}

		protected $totalStat = array();
		protected $arrStat = array();

		public function setArrStat($statId, $tipo, $value){
			$this->arrStat[$statId][$tipo] = $value;
		}

		public function setTotalStat($statId, $value){
			$this->totalStat[$statId] = $value;
		}

		public function getTotalStat($stat){
			$tot = 0;
			$limit = 1000;

			$fu = new Functions();
			$statId = $fu->getStatIdFromName($stat);

			//if(isset($this->totalStat[$statId]))
				//return $this->totalStat[$statId];

			//$tot = $tot + $this->getStatFromClasse($stat);
			$tot = $tot + $this->getStatFromRazza($statId);
			$tot = $tot + $this->getStatFromPunti($statId);
			$tot = $tot + $this->getStatFromEquip($statId);
			$tot = $tot + $this->getStatFromBuff($statId);

			//if($tot > $limit)
				//$tot = $limit;

			return $tot;
		}

		public function getPA(){
			return $this->getUtentePA();
		}

		public function getPM(){
			return $this->getUtentePM();
		}

		public function setPA($a){
			return $this->setUtentePA($a);
		}

		public function setPM($a){
			return $this->setUtentePM($a);
		}

		public function isBuffed(){
			$q = "SELECT COUNT(*) AS C
				  FROM BOT_RPG_BUFF
			 	  WHERE TIMESTAMPDIFF(SECOND,NOW(),BUFF_DATA_SCADENZA) > 0
				  AND BUFF_DURATA_TURNI > 0
				  AND BUFF_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}


		public function getStatFromBuff($statId){
			if(isset($this->arrStat[$statId]['buff']))
				return $this->arrStat[$statId]['buff'];

			$sql = "
				SELECT SUM(VALUE) AS VAL, COUNT(*) AS C
				FROM BOT_RPG_STAT_BUFF
				WHERE STAT_ID = $statId
				AND UTENTE_ID = ".$this->getUtenteId()."
				AND SCADENZA > 0";
			//$this->sendMessage($sql);
			$res = Database()->query($sql);
			if($res === false) return 0;
			$row = $res->fetch_object();

			$val = $row->C > 0 ? $row->VAL : 0;
			$this->arrStat[$statId]['buff'] = $val;
			return $val;
		}
		/*
		public function getStatFromBuff($stat){
			if(strtoupper($stat) == 'HP' || !$this->isBuffed())
				return 0;
			$tot = 0;
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
			return $tot;
		}
		*/

		public function getStatFromClasse($stat){
			$method = 'getClasse'.ucfirst(strtolower($stat));
			return $this->getOBJClasse()->$method() * $this->utenteLevel;
		}

		public function getActiveEquipArrayColumn($col){
			$data = array();
			$col = strtoupper($col);
			$q = "SELECT EQUIP_$col AS V FROM BOT_RPG_EQUIP WHERE EQUIP_ATTIVO = 1 AND EQUIP_UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->V;
			}

			return $data;
		}

		public function hasTipoEquipAttivo($tipoEquipId){
			$id = $this->getId();
			$sql = "SELECT EQUIP_TIPO_EQUIP_ID FROM BOT_RPG_EQUIP WHERE EQUIP_TIPO_EQUIP_ID = $tipoEquipId AND EQUIP_ATTIVO = 1 AND EQUIP_UTENTE_ID = $id";
			$res = $this->db->query($sql);
			if($res->num_rows != 0)
				return true;
			else
				return false;
		}

		public function getEquipColumnById($id, $col){
			$col = strtoupper($col);
			$q = "SELECT EQUIP_$col AS V FROM BOT_RPG_EQUIP WHERE EQUIP_TIPO_EQUIP_ID = ".$id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->V;
		}

		public function getStatValFromTipoEquipId($equipId, $statId){
			$q = "SELECT VALUE FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$equipId." AND STAT_ID = ".$statId;
			$res = $this->db->query($q);
			if($res->num_rows == 0) return 0;
			$row = $res->fetch_object();
			return $row->VALUE;
		}

		public function getEquipRunaStat($id, $statId){
			$sql = "SELECT VALUE FROM BOT_RPG_STAT_EQUIP_RUNE WHERE EQUIP_ID = $id AND STAT_ID = $statId";
            $res = Database()->query($sql);
            if($res->num_rows != 1)
                return 0;
            else
                return $res->fetch_object()->VALUE;
		}

		public function areEquipsLoaded($bool = null){
			if(is_null($bool))
				return $this->OBJEquips['loaded'];
			else
				$this->OBJEquips['loaded'] = $bool;
		}



		public function getStatFromEquip($statId){
			if(isset($this->arrStat[$statId]['equip']))
				return $this->arrStat[$statId]['equip'];


			$this->loadEquips();

			$Equips = $this->getEquips();

			$tot = 0;
			$n = count($Equips);
			if($n == 0) return 0;
			for($i = 0; $i < $n; $i++){
				//$id = $Equips[$i]->getId();
				$Equip = $Equips[$i];
				$id = $Equip->getEquipId();
				$Equip->loadStats();
				$stat = $Equip->getTipoEquipStat($statId);
				//$Equip = new Equip($id);
				$stat = $this->getStatValFromTipoEquipId($Equip->getTipoEquipId(), $statId);
				$tot += $Equip->getEquipLivello() == 1 ? $stat : (int)($stat * $Equip->getEquipLivello()/9) + $stat;

				$tot += $this->getEquipRunaStat($id, $statId);
			}

			$this->arrStat[$statId]['equip'] = $tot;

			return $tot;


			/*
			$tot = 0;
			$activeEquipId = $this->getActiveEquipArrayColumn('ID');
			$n = count($activeEquipId);
			if($n == 0) return 0;
			for($i = 0; $i < $n; $i++){
				$id = $activeEquipId[$i];

				$Equip = new Equip($id);
				$stat = $this->getStatValFromTipoEquipId($Equip->getTipoEquipId(), $statId);
				$tot += $Equip->getEquipLivello() == 1 ? $stat : (int)($stat * $Equip->getEquipLivello()/9) + $stat;

				$tot += $this->getEquipRunaStat($id, $statId);
			}

			return $tot;
			*/

			/*
			$sql = "SELECT SUM(VALUE * EQUIP_LIVELLO)
					FROM BOT_RPG_UTENTE, BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP AS TE, BOT_RPG_STAT_TIPO_EQUIP AS STAT
					WHERE UTENTE_ID = 12
					AND EQUIP_UTENTE_ID = UTENTE_ID
					AND EQUIP_TIPO_EQUIP_ID = TE.TIPO_EQUIP_ID
					AND STAT_ID = 0
					AND EQUIP_ATTIVO = 1
					AND STAT.TIPO_EQUIP_ID = TE.TIPO_EQUIP_ID";
			*/



			/*
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
			*/
		}

		public function areThereMobs(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = ". $this->utenteId."
					AND MOB_PET = 0";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}

		public function getNumberMobHere(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->C;
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

		public function printEquip(){
			if($this->hasSomethingEquipped()){
				$ids = array();

				$msg = 'Equipaggiamento indossato' . "\n\n";
				$ids = $this->getIdsEquipActive();
				$n = count($ids);
				for($i = 0; $i < $n; $i++){
					$msg .= $this->getEquipInfo($ids[$i]) . "\n";
				}

				/*
				$msg .= 'Equipaggiamento non indossato' . "\n";
				$ids = $this->getIdsEquipNotActive();
				$n = count($ids);
				for($i = 0; $i < $n; $i++){
					$msg .= $this->getEquipInfo($ids[$i]) . "\n";
				}
				*/
			}else{
				$msg = $this->getNome().' non ha oggetti equipaggati!';
			}

			return $msg;
		}

		public function getIdsEquipNotActive(){
			$eqID = array();
			$q = "
				SELECT EQUIP_ID
				FROM BOT_RPG_UTENTE, BOT_RPG_EQUIP
				WHERE UTENTE_ID = EQUIP_UTENTE_ID
					AND EQUIP_ATTIVO = 0
					AND UTENTE_ID = ". $this->utenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$eqID[] = $row->EQUIP_ID;
			}

			return $eqID;
		}

		public function getEquipInfo($EQUIP_ID){
			$eq = new Equip($EQUIP_ID);

			$msg = '';
			$msg .= '<b>'.$eq->getTipoEquipNome() . '</b> ('.$eq->getEquipLivello().')' . "\n";

			$q = "SELECT * FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$eq->getTipoEquipId();
			$res = $this->db->query($q);
			if($res->num_rows == 0) return $msg . 'Questo equip non ha statistiche'."\n";
			while($row = $res->fetch_object()){
				$st = new Stat($row->STAT_ID);
				$value = $eq->getEquipLivello() == 1 ? $row->VALUE : (int)($row->VALUE * $eq->getEquipLivello()/9) + $row->VALUE;
				if($value != 0)
					$msg .= getEmojiStats()[strtoupper($st->getStatNome())].$st->getStatNome() ." <i>". $value . "</i>\n";
			}

			//$msg .= "\n";
			return $msg;






			/*
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
			*/


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
				WHERE EQUIP_UTENTE_ID = ". $this->utenteId."
				AND EQUIP_ATTIVO = 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function getSkillsButtons(){
			$data = '';
			$q = "SELECT *
				  FROM BOT_RPG_LEARNED_SKILL, BOT_RPG_SKILL
				  WHERE LEARNED_SKILL_SKILL_ID = SKILL_ID
				  AND LEARNED_SKILL_UTENTE_ID = ".$this->getUtenteId();
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
			if($data == '') $data = '["Non hai skill!"]';
			return $data;
		}

		public function hasItemAlready($tipoItemId){
			$q = "SELECT COUNT(*) AS C, ITEM_QUANTITA AS QUAN FROM BOT_RPG_ITEM WHERE TIPO_ITEM_ID = ".$tipoItemId." AND UTENTE_ID = ".$this->utenteId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else if($row->QUAN == 0) return true;
			else return true;
		}

		public function gainItem($tipoItemId, $n = 1){
			if($this->hasItemAlready($tipoItemId)){
				$q = "UPDATE BOT_RPG_ITEM SET ITEM_QUANTITA = ITEM_QUANTITA + $n WHERE TIPO_ITEM_ID = $tipoItemId AND UTENTE_ID  = ".$this->utenteId;
			}else{
				$q = "INSERT INTO BOT_RPG_ITEM VALUES (".$tipoItemId.", ".$this->utenteId.", $n)";
			}
			$this->db->query($q);

			//TipoItem = new TipoItem($tipoItemId);
			//write($this->getNome() . ' ha ottenuto: '."\n<b>". $TipoItem->getTipoItemNome() . '</b> <i>x'.$n.'</i>');
		}

		public function giveItem($tipoItemId, $n = 1, $notify = false){
			if($this->hasItemAlready($tipoItemId)){
				$q = "UPDATE BOT_RPG_ITEM SET ITEM_QUANTITA = ITEM_QUANTITA + $n WHERE TIPO_ITEM_ID = $tipoItemId AND UTENTE_ID  = ".$this->utenteId;
			}else{
				$q = "INSERT INTO BOT_RPG_ITEM VALUES (".$tipoItemId.", ".$this->utenteId.", $n)";
			}
			$this->db->query($q);

			if($notify){
				$this->initNotifyGiveItem();
				$this->notifyGiveItem($tipoItemId, $n);
			}

			//TipoItem = new TipoItem($tipoItemId);
			//write($this->getNome() . ' ha ottenuto: '."\n<b>". $TipoItem->getTipoItemNome() . '</b> <i>x'.$n.'</i>');
		}

		public function giveManyItems($arrItems, $notify = false){
			$n = count($arrItems);
			if($n == 0) return false;
			if($notify) $this->initNotifyGiveItem();
			for($i = 0; $i < $n; $i++){
				$this->giveItem($arrItems[$i]['ITEM_ID'], $arrItems[$i]['ITEM_QUANTITA']);
				if($notify)
					$this->notifyGiveItem($arrItems[$i]['ITEM_ID'], $arrItems[$i]['ITEM_QUANTITA']);
			}
		}
		//Fine altri getters

		//Metodi per telegram
		public function sendMessage($message, $keyboard = null){
			global $BT;
			/*
			$add = '';
			if($keyboard !== null){
				$add = '&reply_markup={ "keyboard": ['.urlencode($keyboard).'], "one_time_keyboard": false, "resize_keyboard" : true}';
			}
			return json_decode(file_get_contents("https://api.telegram.org/bot".$BT."/sendMessage?chat_id=".$this->utenteChatId."&text=".urlencode($message)."&parse_mode=HTML".$add))->result->message_id;
			*/
			//sleep(1);
			$botToken = $BT;

			if($keyboard === null){
				$params = [
      				'chat_id' => $this->getUtenteChatId(),
      				'text' => $message,
      				'parse_mode' => 'HTML',
  				];
			}else{
				$params = [
					'chat_id' => $this->getUtenteChatId(),
      				'text' => $message,
      				'parse_mode' => 'HTML',
      				'reply_markup' => '{ "keyboard": ['.$keyboard.'], "one_time_keyboard": false, "resize_keyboard" : true}',
				];
			}

  			$website = "https://api.telegram.org/bot".$botToken;
  			$chatId = $this->getUtenteChatId();  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
  			$ch = curl_init($website . '/sendMessage');
  			curl_setopt($ch, CURLOPT_HEADER, false);
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($ch, CURLOPT_POST, 1);
  			curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  			$result = curl_exec($ch);
  			curl_close($ch);
  			return json_decode($result);
		}

		public function sendImage($imgPath, $text){
			$chatId = $this->utenteChatId;
			global $BT;
			$botUrl = "https://api.telegram.org/bot" . $BT . "/sendPhoto";
			// change image name and path
			$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("$imgPath")), 'caption' => $text, 'parse_mode' => 'HTML');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
			curl_setopt($ch, CURLOPT_URL, $botUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			// read curl response
			$output = curl_exec($ch);
			return $output;
		}

		public function sendImageById($imgPath, $text){
			$chatId = $this->utenteChatId;
			global $BT;
			$botUrl = "https://api.telegram.org/bot" . $BT . "/sendPhoto";
			// change image name and path
			$postFields = array('chat_id' => $chatId, 'photo' => $imgPath, 'caption' => $text, 'parse_mode' => 'HTML');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
			curl_setopt($ch, CURLOPT_URL, $botUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			// read curl response
			$output = curl_exec($ch);
			return $output;
		}


		public function sendVoice($voiceId){
			global $BT;
			$caption = '&caption=@testrpg_bot';
			file_get_contents("https://api.telegram.org/bot".$BT."/sendVoice?chat_id=".$this->utenteChatId."&voice=".$voiceId);
		}

		public function sendAudio($audioId){
			global $BT;
			$caption = '&caption=@testrpg_bot';
			file_get_contents("https://api.telegram.org/bot".$BT."/sendAudio?chat_id=".$this->utenteChatId."&audio=".$audioId);
		}

		public function sendPhoto($photoId){
			global $BT;
			$caption = '&caption=@testrpg_bot';
			file_get_contents("https://api.telegram.org/bot".$BT."/sendPhoto?chat_id=".$this->utenteChatId."&photo=".$photoId);
		}

		public function sendVideo($photoId){
			global $BT;
			$caption = '&caption=@testrpg_bot';
			file_get_contents("https://api.telegram.org/bot".$BT."/sendVideo?chat_id=".$this->utenteChatId."&video=".$photoId);
		}

		public function sendDocument($photoId){
			global $BT;
			$caption = '&caption=@testrpg_bot';
			file_get_contents("https://api.telegram.org/bot".$BT."/sendDocument?chat_id=".$this->utenteChatId."&document=".$photoId);
		}

		public function editMessage($messageId, $message){
		global $BT;
		file_get_contents("https://api.telegram.org/bot".$BT."/editMessageText?message_id=".$messageId."&chat_id=".$this->utenteChatId."&text=".urlencode($message)."&parse_mode=HTML");
		}

		public function deleteMessage($messageId){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/deleteMessage?chat_id=".$this->utenteChatId."&message_id=".$messageId);
		}

		public function sendChatAction($action){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/sendChatAction?chat_id=".$this->utenteChatId."&action=".$action);
		}

		public function answerCallBackQuery($cbqId, $cbqText){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/answerCallBackQuery?callback_query_id=".$cbqId."&text=".urlencode($cbqText)."&cache_time=5&show_alert=false");
		}

		public function sendKeyboard($keyboard){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/ReplyKeyboardMarkup?chat_id=".$this->utenteChatId.'&reply_markup={ "keyboard": ['.$keyboard.'], "one_time_keyboard": false, "resize_keyboard" : true}');
			//return "https://api.telegram.org/bot".$BT."/ReplyKeyboardMarkup?chat_id=".$this->utenteChatId."&keyboard=".$keyboard;
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

			$nome = str_replace(' ', '%21', $this->getUtenteNome());

			$img = file_put_contents("tmp/file/mod".$this->getUtenteChatId().'.jpg', file_get_contents('http://www.lorenzodona.it/telegram/bot/rpg_bot/img.php?text='.$nome.'&p='.$this->getFile($this->getProfilePhoto()).'&class=UOMO'));

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

		public function clearAllMobHere(){
			$sql = "SELECT MOB_ID FROM BOT_RPG_MOB WHERE MOB_UTENTE_ID = ".$this->getUtenteId()." AND MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId();
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$Mob = new Mob($row->MOB_ID);
				$Mob->deleteAll();
				unset($Mob);
			}

			$sql = "DELETE FROM BOT_RPG_MOB WHERE MOB_UTENTE_ID = ".$this->getUtenteId()." AND MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId();
			Database()->query($sql);
		}

		private $dannoSubito = 0;

		public function subisciDanno(Danno &$da){
			if(!$this->isVivo()){
				return false;
			}

			if($da->getFrase() !== null)
				write($da->getFrase());

			if($da->canBeDodged()){
				if($this->dodge($da->getPrecisione())){
					$da->setDodged(true);
					return false;
				}
			}

			$da->setDodged(false);

			$this->loadEquips();

			$this->triggerEquipsDebuff($da);

			$this->triggerOvertimesDebuff($da);

			$subisciDanno = $this->chooseDamage($da->getTipo());
			$dmg = $this->{$subisciDanno}($da);

			//write('equips: '.count($da->getEquips()));
			if(count($da->getEquips()) > 0){
				//write('entro');
				 $this->subisciEquips($da->getEquips());

			}

			$this->triggerEquipsOnGetHitten($da);

			if(count($da->getOverTimes()) > 0) $this->subisciOverTimes($da->getOverTimes());

			if(count($da->getBuff()) > 0) $this->buff($da->getBuff());

			$cd = $da->getCollateralDamage();
			$n = count($cd);
			if($n > 0){
				for($i = 0; $i < $n; $i++){
					if($cd[$i]->getTarget()->isVivo())
						$cd[$i]->send();
				}
			}

			/*
			if(!$this->isVivo()){
				$this->die();
				return true;
			}
			*/

			return $dmg;
		}

		public function die(){
			global $emoji;
			write('Sei morto ' . $emoji['SKULL']);
			$this->setUtenteHp(0);
			$this->svuotaAccumuloSoldi();
			$this->svuotaAccumuloExp();

			/*
			write($this->getNome().' è stato sconfitto '.$emoji['SKULL'] . "\n");
			$this->sendMessage('Game Over'.$emoji['SKULL'], kRespawn());
			$this->setUtenteStatoId(4);
			*/
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
			$durata = 60 * $part->distanceFrom($dest);
			$q = "
				INSERT INTO BOT_RPG_VIAGGIO
				VALUES (".
						$this->utenteId.", ".
						$part->getLuogoId().", ".
						$dest->getLuogoId().",
						NOW(),
						DATE_ADD(NOW(), INTERVAL ".$durata." SECOND)
						)";
			Database()->query($q);
		}
		//Fine Spostamenti

		public function calculateRealLevel(){
			$sql = "SELECT UTENTE_EXP FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ".$this->getId();
			$e = Database()->query($sql)->fetch_object()->UTENTE_EXP;
			$this->utenteExp = $e;
			return $this->calculateLevel();
		}

		//Miscellaneous
		public function calculateLevel(){
			//$var = $this->xp / 10;
			$maxLevel = 100;
			$const = 0.1;
			$XP = $this->utenteExp;
			/*
			$e = $this->utenteExp;
			for($i = 1; $e > 0; $i++){
				$e -= $i * 100;
			}

			$lvl = $i - 1;
			*/

			$lvl = floor(1 + sqrt($XP)*$const);

			if($lvl <= $maxLevel)
				return $lvl;
			else
				return $maxLevel;
		}

		function calcPercToNextLevel(){
			$exp = $this->utenteExp;
			$nextLevel = $this->xpToNextLevelFromLevel($this->calculateLevel());


		}

		function calcXP($L){
			$const = 0.1;
    		$XPsqrt = ($L - 1) / $const;
    		$XP = $XPsqrt * $XPsqrt;
    		return $XP;
		}

		function xpToNextLevelFromLevel($L){
			$const = 0.1;
    		$XPNsqrt = ($L) / $const;
    		$XPsqrt = ($L - 1) / $const;
    		return ($XPNsqrt * $XPNsqrt) - ($XPsqrt * $XPsqrt);
		}

		public function printMobs(){
			if(!$this->areThereMobs()) return 'Non c\'è nessuno...';
			$msg = '';
			$q = "
				SELECT 	MOB_ID, TIPO_MOB_NOME, NOME_NOME, MOB_LIVELLO, MOB_HP
				FROM BOT_RPG_MOB, BOT_RPG_NOME, BOT_RPG_TIPO_MOB
				WHERE MOB_TIPO_MOB_ID = TIPO_MOB_ID
					AND NOME_ID = MOB_NOME_PROPRIO_ID
					AND MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$mob = new Mob($row->MOB_ID);
				//$msg .= "<b>".$mob->getTipoMobNome()." ".$mob->getOBJNome()->getNomeNome()." LVL ".$mob->getMobLevel()." </b><i>".$mob->getMobHp()." HP</i>\n";
				$msg .= "<b>".$row->TIPO_MOB_NOME." ".$row->NOME_NOME." LVL ".$row->MOB_LIVELLO." </b><i>".$row->MOB_HP." HP ".$this->getDistanceFrom($mob)." Metri</i>\n\n";
			}
			return $msg;
		}

		public function canCraftEquip($equipId){
			$q = "SELECT CRAFT_TIPO_ITEM_ID, CRAFT_QUANTITA FROM BOT_RPG_CRAFT_TIPO_EQUIP WHERE CRAFT_TIPO_EQUIP_ID = ".$equipId;
			$res = $this->db->query($q);
			$nr = $res->num_rows;
			if($nr == 0)
				return false;
			$tot = 0;
			while($row = $res->fetch_object()){
				$q1 = "SELECT COUNT(*) AS C
				FROM BOT_RPG_ITEM
				WHERE TIPO_ITEM_ID = ".$row->CRAFT_TIPO_ITEM_ID."
				AND UTENTE_ID = ".$this->getUtenteId()."
				AND ITEM_QUANTITA >= ".$row->CRAFT_QUANTITA;
				$res1 = $this->db->query($q1);
				$row1 = $res1->fetch_object();
				$tot += $row1->C;
			}

			if($tot == $nr) return true;
			else return false;
		}

		public function selectAllReceipts(){
			$data = array();
			$q = "SELECT DISTINCT(CRAFT_TIPO_EQUIP_ID), TIPO_EQUIP_NOME FROM BOT_RPG_CRAFT_TIPO_EQUIP, BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_ID = CRAFT_TIPO_EQUIP_ID";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
					$data[] = $row->TIPO_EQUIP_NOME;
			}

			return $data;
		}

		public function selectAllCraftableItems(){
			$data = array();
			$q = "SELECT DISTINCT(CRAFT_TIPO_EQUIP_ID), TIPO_EQUIP_NOME FROM BOT_RPG_CRAFT_TIPO_EQUIP, BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_ID = CRAFT_TIPO_EQUIP_ID";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				if($this->canCraftEquip($row->CRAFT_TIPO_EQUIP_ID)){
					$data[] = $row->TIPO_EQUIP_NOME;
				}
			}

			if(count($data) == 0) $data[0] = 'Non puoi craftare nulla!';

			return $data;
		}

		public function notifyTogliItem($tipoItemId, $n = 1){
			$name = Functions::getTipoItemNameById($tipoItemId);
			write("> $name -$n");
		}

		public function togliItem($tipoItemId, $n = 1){
			$db = Database();
			$q = "UPDATE BOT_RPG_ITEM SET ITEM_QUANTITA = ITEM_QUANTITA - $n WHERE TIPO_ITEM_ID = $tipoItemId AND ITEM_QUANTITA - $n >= 0 AND UTENTE_ID = ".$this->getUtenteId();
			$res = $db->query($q);
			if($db->affected_rows == 0)
				return false;
			else
				return true;
		}

		public function craftEquip($tipoEquipId){
			if(!$this->canCraftEquip($tipoEquipId)){
				write('Non puoi craftare questo item!');
				return false;
			}
			$q = "SELECT * FROM BOT_RPG_CRAFT_TIPO_EQUIP WHERE CRAFT_TIPO_EQUIP_ID = ".$tipoEquipId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$ar = $this->togliItem($row->CRAFT_TIPO_ITEM_ID, $row->CRAFT_QUANTITA);
				if($ar == 0) $flag = false;
			}

			$this->giveEquip($tipoEquipId);
			$msg = 'Equip craftato con successo!';

			write($msg);
		}

		public function giveEquip($tipoEquipId, $level = 1){
			$q = "SELECT MAX(EQUIP_ID) + 1 AS M FROM BOT_RPG_EQUIP";
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$q = "INSERT INTO BOT_RPG_EQUIP VALUES(
					".$row->M.",
					".$this->getUtenteId().",
					".$tipoEquipId.",
					$level,
					0)";
			$this->db->query($q);

			//$Equip = new TipoEquip($tipoEquipId);
			//$msg .= $this->getNome() . ' ottiene ' . $Equip->getTipoEquipNome() . ' (+'.$level.')'."\n";
			//$this->msg['GIVE_EQUIP'] = $msg;
		}

		public function convertDigitToEmoji($digit){
			switch($digit){
        		case 0:
        			return ZERO;
        		break;

        		case 1:
        			return UNO;
        		break;

        		case 2:
        			return DUE;
        		break;

        		case 3:
        			return TRE;
        		break;

        		case 4:
        			return QUATTRO;
        		break;

        		case 5:
        			return CINQUE;
        		break;

        		case 6:
        			return SEI;
        		break;

        		case 7:
        			return SETTE;
        		break;

        		case 8:
        			return OTTO;
        		break;

        		case 9:
        			return NOVE;
        		break;
        	}
		}

		public function drawLevelInEmoji(){
			$lvl = (string)$this->calculateLevel();
			$n = strlen($lvl);
			$number = '';
   			for($i = 0; $i < $n; $i++){
   				$number .= $this->convertDigitToEmoji($lvl[$i]);
    		}

    		return $number;
		}

		public function drawNumberToEmoji($num){
			$n = strlen($num);
			$number = '';
   			for($i = 0; $i < $n; $i++){
   				$number .= $this->convertDigitToEmoji($num[$i]);
    		}

    		return $number;
		}


		public function printUtenteInfo(){
			$ut = &$this;

			$razza = Functions::getRazzaNomeById($this->getUtenteRazzaId());

			$msg  = '';
			$msg .= ucfirst($ut->getNome());
			$msg .= ' (' . ucfirst($razza) . ')';
			$msg .= "\n";
			$msg .= '<i>Livello</i> '.$this->drawLevelInEmoji();//$ut->calculateLevel().'</i>';
			$msg .= "\n";
			$msg .= $ut->getUtenteSoldi() . MONEY;
			$msg .= "\n\n";

			$msg .= HP.'<b>HP</b>: '		. $ut->getUtenteHp() . '/' . $ut->getTotalStat('HP') . "\n";

			$q = "SELECT STAT_NOME FROM BOT_RPG_STAT";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$statValue = $ut->getTotalStat($row->STAT_NOME);
				if(strtoupper($row->STAT_NOME) == 'ARMATURA') $armor = $statValue;
				if(strtoupper($row->STAT_NOME) == 'SALVAMAGIA') $salva = $statValue;
				if($row->STAT_NOME != 'HP' && $statValue != 0)
					$msg .= getEmojiStats()[strtoupper($row->STAT_NOME)].'<b>'.$row->STAT_NOME.'</b>: '.$statValue."\n";
			}

			$armor = ($this->getPercDannoExp($armor) - 100);
			$salva = ($this->getPercDannoExp($salva) - 100);

			$msg .= "\n";
			$msg .= $armor < 0 ? ARMATURA.' <b>'.round($armor,1).'% Danni Fisici</b>'."\n" : '';
			$msg .= $salva < 0 ? SALVAMAGIA.' <b>'.round($salva,1). '% Danni Magici</b>'."\n" : '';;

			return $msg;
		}

		public function selectAllMobs(){
			$data = array();
			$q = "
				SELECT *
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId."
					ORDER BY MOB_Y, MOB_X";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$mob = new Mob($row->MOB_ID);
				$data[] = $mob->getTipoMobNome() .'  '.$mob->getOBJNome()->getNomeNome().'  LVL'.$mob->getMobLevel().'  '.$mob->getMobHp().'HP';
			}

			return $data;
		}

		public function selectAllMobsInRange(){
			$Skill = new Skill($this->getUtenteSkillId());
			$arr = $this->selectAllMobsId();
			$n = count($arr);
			$data = array();
			for($i = 0; $i < $n; $i++){
				$Mob = new Mob($arr[$i]);
				$dist = $this->getDistanceFrom($Mob);
				if($dist <= $Skill->getSkillRange() && $dist >= $Skill->getSkillRangeMin()){
					$data[] = $Mob->getTipoMobNome() .'  '.$Mob->getOBJNome()->getNomeNome().'  LVL'.$Mob->getMobLevel().'  '.$Mob->getMobHp().'HP';
				}
			}

			return $data;
		}

		public function selectAllTipoMobsId(){
			$data = array();
			$q = "
				SELECT MOB_TIPO_MOB_ID
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId."
					ORDER BY MOB_Y, MOB_X";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->MOB_TIPO_MOB_ID;
			}

			return $data;
		}

		public function selectAllMobsId(){
			$data = array();
			$q = "
				SELECT MOB_ID, MOB_Y, MOB_X
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId."
					ORDER BY MOB_Y, MOB_X";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->MOB_ID;
			}

			return $data;
		}

		public function selectAllMobsMultidimensionalArrayIdXY(){
			$data = array();
			$i = 0;
			$q = "
				SELECT MOB_ID, MOB_Y, MOB_X
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
					AND MOB_UTENTE_ID = " . $this->utenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[$i]['ID'] = $row->MOB_ID;
				$data[$i]['X'] = $row->MOB_X;
				$data[$i]['Y'] = $row->MOB_Y;
				$i++;
			}

			return $data;
		}

		public function updateUtenteDataLastCommand(){
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_DATA_LAST_COMMAND = NOW()
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function printItems(){
			$str = '';
			$q = "SELECT * FROM BOT_RPG_ITEM WHERE UTENTE_ID = ".$this->utenteId." AND ITEM_QUANTITA > 0";
			$res = $this->db->query($q);
			$this->sendMessage($res->num_rows);
			if($res->num_rows < 1) return 'Non possiedi alcun item!';
			while($row = $res->fetch_object()){
				$ti = new Item($this, $row->TIPO_ITEM_ID);
				$str .= ucfirst(strtolower($ti->getTipoItemNome())) . ' x'. $ti->getItemQuantita() . "\n";
				unset($ti);
			}
			$this->sendMessage($str);
			//write($str);
			return $str;
		}

		public function selectItemsInRange($start, $end){
			$data = array();
			$id = $this->getId();
			$q = "SELECT I.TIPO_ITEM_ID, ITEM_QUANTITA, TI.TIPO_ITEM_NOME FROM BOT_RPG_ITEM I, BOT_RPG_TIPO_ITEM TI WHERE UTENTE_ID = $id AND ITEM_QUANTITA > 0 AND TI.TIPO_ITEM_ID = I.TIPO_ITEM_ID LIMIT $start,$end";
			$res = $this->db->query($q); //or $this->sendMessage($q);
			while($row = $res->fetch_object()){
				//$ti = new TipoItem($row->TIPO_ITEM_ID);
				$string = $this->drawNumberToEmoji($row->ITEM_QUANTITA)."\n".ucfirst(strtolower($row->TIPO_ITEM_NOME));
				$data[] = $string;
			}

			return $data;
		}

		public function hasTipoEquip($id){
			$utId = $this->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_EQUIP WHERE EQUIP_UTENTE_ID = $utId AND EQUIP_TIPO_EQUIP_ID = $id";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0)
				return true;
			else
				return false;
		}

		public function showEquipsInRangeForCraft($num, $start){
			$msg = '';
			$q = "SELECT DISTINCT(CRAFT_TIPO_EQUIP_ID) AS ID, TIPO_EQUIP_NOME FROM BOT_RPG_CRAFT_TIPO_EQUIP, BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_ID = CRAFT_TIPO_EQUIP_ID LIMIT $num OFFSET $start";
			$res = Database()->query($q);
			$i = 0;
			while($row = $res->fetch_object()){
					$data[$i]['CRAFTABLE'] = false;
					//$symbolOwn = REAL_RED_CROSS;
					$symbolCraft = BANNED;
					$canCraft = false;
					if($this->canCraftEquip($row->ID)){
						$data[$i]['CRAFTABLE'] = true;
						$canCraft = true;
						//$symbolOwn = GREEN_CHECKMARK;
						$symbolCraft = HAMMER_AND_WRENCH;
					}

					$symbolOwn = REAL_RED_CROSS;
					$hasTipoEquip = false;
					if($this->hasTipoEquip($row->ID)){
						$symbolOwn = GREEN_CHECKMARK;
						$hasTipoEquip = true;
					}

					$data[$i]['TIPO_EQUIP_ID']	 = $row->ID;
					$data[$i]['TIPO_EQUIP_NOME'] = $row->TIPO_EQUIP_NOME;

					$i++;

					$part = '> <b>'.$row->TIPO_EQUIP_NOME.'</b>'."\n";
					$part .= $symbolOwn.$symbolCraft;
					//$part = '> '.$part;
					$part .= "\n";
					$part .= '/'.$row->ID;
					$part .= "\n---\n";

					$msg .= $part;

			}

			write($msg);
		}


		public function showItemsInRange($num, $start){
			$data = array();
			$id = $this->getId();
			$q = "SELECT I.TIPO_ITEM_ID, ITEM_QUANTITA, TI.TIPO_ITEM_NOME FROM BOT_RPG_ITEM I, BOT_RPG_TIPO_ITEM TI WHERE UTENTE_ID = $id AND ITEM_QUANTITA > 0 AND TI.TIPO_ITEM_ID = I.TIPO_ITEM_ID LIMIT $num OFFSET $start";//ORDER BY LENGTH(TI.TIPO_ITEM_NOME)
			$res = $this->db->query($q); //or $this->sendMessage($q);
			if($res->num_rows == 0){
				write('Scompartimento non esistente');
				return false;
			}
			$msg = '';
			while($row = $res->fetch_object()){
				//$ti = new TipoItem($row->TIPO_ITEM_ID);
				$string = '> <b>'.$row->TIPO_ITEM_NOME.'</b> <i>x'.$row->ITEM_QUANTITA.'</i>'."\n/" .$row->TIPO_ITEM_ID;//$this->drawNumberToEmoji($row->ITEM_QUANTITA);
				$msg .= $string."\n---\n";
			}

			write($msg);
		}

		public function selectAllItems(){
			$data = array();
			$q = "SELECT TIPO_ITEM_ID, ITEM_QUANTITA FROM BOT_RPG_ITEM WHERE UTENTE_ID = ".$this->utenteId." AND ITEM_QUANTITA > 0";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$ti = new TipoItem($row->TIPO_ITEM_ID);
				$string = $this->drawNumberToEmoji($row->ITEM_QUANTITA)."\n".ucfirst(strtolower($ti->getTipoItemNome()));
				$data[] = $string;
			}

			return $data;
		}

		public function getMobIdByButtonText($txt){
			$arr = explode("  ", $txt);
			//$hp = array_pop($arr);
			//$lv = array_pop($arr);
			//$nomeProprio = array_pop($arr);

			$nomeTipo = $arr[0];

			if(isset($arr[1]))
				$nomeProprio = $arr[1];
			else{
				write('Qualcosa è andato storto');
				return false;
			}

			/*
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				$nomeTipo .= $arr[$i] . ' ';
			}
			$nomeTipo = trim($nomeTipo);
			*/

			//$nomeTipo = implode(' ', $arr);
			//$this->sendMessage("\"" . $nomeTipo . "\" \"" . $nomeProprio . "\""); //) \"" . $lv . "\" \"" . $hp . "\"");

			//bab = [Orco, A, B, Johnny, lvl65, 40hp]
			//hp = array_pop(bab) // bab == [orco, A, B] jhonny] lvl65]; hp = 40hp
			$q = "
			SELECT MOB_ID
			FROM BOT_RPG_MOB, BOT_RPG_NOME, BOT_RPG_TIPO_MOB
			WHERE TIPO_MOB_ID = MOB_TIPO_MOB_ID
				AND MOB_NOME_PROPRIO_ID = NOME_ID
				AND MOB_UTENTE_ID = ".$this->utenteId."
				AND MOB_SOTTOLUOGO_ID = ".$this->utenteSottoluogoId."
				AND LOWER(NOME_NOME) = '".$this->db->real_escape_string(strtolower($nomeProprio))."'
				AND LOWER(TIPO_MOB_NOME) = '".$this->db->real_escape_string(strtolower($nomeTipo))."'
				LIMIT 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->MOB_ID;
		}

		public function giveSoldi($x){
			if($x == 0) return false;
			$this->setUtenteSoldi($this->getUtenteSoldi() + $x);
			//write('<b>'.$this->getNome() . ' ottiene ' . $x . ' monete d\'oro!</b>'."\n");
		}

		public function giveExp($x, $notify = false){
			if($x == 0) return false;
			if($notify) $this->notifyGiveExp($x);
			$lvl1 = $this->calculateLevel();
			$this->setUtenteExp($this->getUtenteExp() + $x);
			$lvl2 = $this->calculateLevel();
			//write('<b>'.$this->getNome() . ' guadagna '. $x . ' exp!</b>'."\n");
			//$this->sendMessage($lvl2.' and '.$lvl1);
			//if($lvl2 > $lvl1)
				//write('<b>LEVEL UP! '.$lvl1.' -> '.$lvl2.'</b>'."\n");
		}

		public function togliSoldi($x){
			if($this->getSoldi() < $x)
				return false;

			$this->setUtenteSoldi($this->getSoldi() - $x);
			return true;
		}

		public function takeSoldi($x){
			if(($this->getUtenteSoldi() - $x) < 0)
				$x = $this->getUtenteSoldi();
			$this->setUtenteSoldi($this->getUtenteSoldi() - $x);
			return $x;
		}

		public function takeExp($x){
			if(($this->getUtenteExp() - $x) < 0)
				$x = $this->getUtenteExp();
			$this->setUtenteExp($this->getUtenteExp() - $x);
		}

		public function createParty(){
			$q = "INSERT INTO MOB_RPG_PARTY VALUES(".$this->utenteId.", 0, ".$this->utenteId.")";
			$this->db->query($q);
		}

		public function joinParty($partyOwnerId){
			$q = "INSERT INTO MOB_RPG_PARTY VALUES(".$partyOwnerId.", 1, ".$this->utenteId.")";
			$this->db->query($q);
		}

		public function acceptPartyMember($id){
			$q = "UPDATE BOT_RPG_PARTY SET PARTY ACCETTATO = 0 WHERE PARTY_OWNER_ID = ".$this->utenteId." AND PARTY_UTENTE_ID = ".$id;
			$this->db->query($q);
		}

		public function leaveParty($id){
			$q = "DELETE FROM BOT_RPG_PARTY WHERE PARTY_UTENTE_ID = ".$this->utenteId;
			$this->db->query($q);
		}

		public function IsInParty(){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_PARTY WHERE PARTY_UTENTE_ID = ".$this->utenteId;
			$res = $this->db->query($q);
			if($row->C != 0) return true;
			else return false;
		}
		//Fine Miscellaneous

		public function setUtenteX($a){
			$this->utenteX = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_X = ". $a ."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function setUtenteY($a){
			$this->utenteY = $a;
			$q = "
				UPDATE BOT_RPG_UTENTE
				SET UTENTE_Y = ". $a ."
				WHERE UTENTE_ID = ". $this->utenteId;
			$this->db->query($q);
		}

		public function isAMobThere($x, $y){
			$arr = $this->selectAllMobsMultidimensionalArrayIdXY();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				if($arr[$i]['X'] == $x && $arr[$i]['Y'] == $y){
					return true;
				}
			}

			return false;
		}

		public function walk($dir){
			$this->triggerPreOvertimes();

			if(!$this->isMovable())
				return 0;

			if($this->muovi(1, $dir))
				return 0;
			else
				return 1;
		}

		public function muovi($n, $where){
			$flag = false;
			$sl = new Sottoluogo($this->getUtenteSottoluogoId());
			switch(strtoupper($where)){
				case 'NORD':
					if($this->getUtenteY() - $n < 0) break;
					if($this->isAMobThere($this->getX(), $this->getY() - $n)) break;
					$this->setUtenteY($this->getUtenteY() - $n);
					$flag = true;
				break;

				case 'SUD':
					if($this->getUtenteY() + $n > $sl->getSottoluogoAmpiezza() - 1) break;
					if($this->isAMobThere($this->getX(), $this->getY() + $n)) break;
				    $this->setUtenteY($this->getUtenteY() + $n);
					$flag = true;
				break;

				case 'OVEST':
					if($this->getUtenteX() - $n < 0) break;
					if($this->isAMobThere($this->getX() - $n, $this->getY())) break;
					$this->setUtenteX($this->getUtenteX() - $n);
					$flag = true;
				break;

				case 'EST':
					if($this->getUtenteX() + $n > $sl->getSottoluogoAmpiezza() - 1) break;
					if($this->isAMobThere($this->getX() + $n, $this->getY())) break;
					$this->setUtenteX($this->getUtenteX() + $n);
					$flag = true;
				break;
			}
			if($flag){
				write($this->getNome()." si sposta verso ".strtolower($where)."\n");
				//$this->setUtentePM($this->getUtentePM() - 1);
				return true;
			}else{
				write('Movimento non consentito'."\n");
				return false;
			}

			//return $msg."\n\n";
		}

		public function setX($a){
			$this->setUtenteX($a);
		}

		public function setY($a){
			$this->setUtenteY($a);
		}

		public function getY(){
			return $this->getUtenteY();
		}

		public function getX(){
			return $this->getUtenteX();
		}

		public function getSottoluogoId(){
			return $this->getUtenteSottoluogoId();
		}

		/*
		public function rimuoviEquip($equipId){
			$q = "UPDATE BOT_RPG_EQUIP SET EQUIP_ATTIVO = 0 WHERE EQUIP_ID = $equipId";
			$this->db->query($q);
			$msg = 'Equip rimosso con successo';
			return $msg;
		}
		*/

		public function getEquipIdByTipoEquipNomeAndEquipLevel($tipoEquipNome, $equipLevel, $num = null){
			$q = "SELECT EQUIP_ID
				  FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP
				  WHERE
						EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
					AND
					 	TIPO_EQUIP_NOME = '$tipoEquipNome'
					AND
					 	EQUIP_LIVELLO = $equipLevel
					AND
						EQUIP_UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			if($num === null){
				$row = $res->fetch_object();
				return $row->EQUIP_ID;
			}else{
				$i = 0;
				while($row = $res->fetch_object()){
					if($i == $num){
						return $row->EQUIP_ID;
					}else{
						$i++;
					}
				}
			}
		}

		public function selectAllEquipActive(){
			$fu = new Functions();
			$ids = $this->getIdsEquipActive();
			$n = count($ids);
			$ea = array();
			for($i = 0; $i < $n; $i++)
				$ea[] = $fu->getEquipButtonStringById($ids[$i]);
			return $ea;
		}

		public function selectAllEquipNotActive(){
			$fu = new Functions();
			$ids = $this->getIdsEquipNotActive();
			$n = count($ids);
			$ea = array();
			for($i = 0; $i < $n; $i++)
				$ea[] = $fu->getEquipButtonStringById($ids[$i]);
			return $ea;
		}

		public function getEquipIdByEquipButtonString($str){
			$arr = explode(' (+', $str);
			$tipoEquipNome = $arr[0];
			$equipLivello = substr($arr[1], 0, -1);
			$msg = $this->getEquipIdByTipoEquipNomeAndEquipLevel($tipoEquipNome, $equipLivello);
			return $msg;
		}

		public function canEquipBeActivated($equipId){
			//$Equip = new Equip($equipId);
			$className = 'Equip'.Functions::getTipoEquipIdByEquipId($equipId);
			$Equip = new $className($this, $equipId);
			$catId = $Equip->getTipoEquipCategoriaId();
			$id = $this->getId();

			$pdc = $Equip->getParteDelCorpoData();
			$pdcId = $pdc['ID'];
			$pdcQuantita = $pdc['QUANTITA'];

			$sql = "
				SELECT SUM(QUANTITA) AS S
				FROM BOT_RPG_EQUIP E, BOT_RPG_TIPO_EQUIP TE, BOT_RPG_CATEGORIA_EQUIP CE, BOT_RPG_PARTE_DEL_CORPO PDC, BOT_RPG_PARTE_DEL_CORPO_CATEGORIA_EQUIP PDCCE
					WHERE E.EQUIP_TIPO_EQUIP_ID = TE.TIPO_EQUIP_ID
					AND TE.TIPO_EQUIP_CATEGORIA_EQUIP_ID = CE.CATEGORIA_EQUIP_ID
					AND CE.CATEGORIA_EQUIP_ID = PDCCE.CATEGORIA_EQUIP_ID
					AND PDCCE.PARTE_DEL_CORPO_ID = PDC.PARTE_DEL_CORPO_ID
					AND EQUIP_ATTIVO = 1
					AND PDC.PARTE_DEL_CORPO_ID = $pdcId
					AND E.EQUIP_UTENTE_ID  = $id;
			";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			$val = is_null($row->S) ? 0 : $row->S;

			$arrayPDCUomo = array(
				'0' => 2,
				'1' => 2,
				'2' => 2,
				'3' => 2,
				'4' => 2,
				'5' => 1,
				'6' => 1,
				'7' => 1,
				'8' => 1,
				'9' => 2,
				'10' => 1,
				'11' => 2
			);

			$arrayPDCNano = array();
			$arrayPDCGnomo = array();
			$arrayPDCLeone = array();

			if($pdcQuantita + $val <= $arrayPDCUomo[$pdcId]){
				return $Equip->canBeActivated();
			}else{
				write('Non puoi equipaggiarlo se prima non rimuovi qualcosa dal tuo equipaggiamento!'."\n");
				return false;
			}
		}

		public function attivaEquip($equipId){
			if(!$this->canEquipBeActivated($equipId)){
				return false;
			}

			$q = "UPDATE BOT_RPG_EQUIP SET EQUIP_ATTIVO = 1 WHERE EQUIP_ID = $equipId AND EQUIP_UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			$eq = new Equip($equipId);
			$msg = 'Hai equipaggiato: '."\n".$eq->getTipoEquipNome().' (+'.$eq->getEquipLivello().')';
			write($msg);

			return true;
		}

		public function rimuoviEquip($equipId){
			$q = "UPDATE BOT_RPG_EQUIP SET EQUIP_ATTIVO = 0 WHERE EQUIP_ID = $equipId AND EQUIP_UTENTE_ID = ".$this->getUtenteId();
			$this->db->query($q);
			$eq = new Equip($equipId);
			$msg = 'Hai rimosso dal tuo equipaggiamento: '."\n".$eq->getTipoEquipNome().' (+'.$eq->getEquipLivello().')';
			write($msg);
			return true;
		}

		public function rimuoviTuttoEquip(){
			$q = "UPDATE BOT_RPG_EQUIP SET EQUIP_ATTIVO = 0 WHERE EQUIP_UTENTE_ID = ".$this->getUtenteId();
			$this->db->query($q);
			$msg = 'Equip interamente rimosso con successo';
			return $msg;
		}

		public function isThereAnyEnemy($x, $y){
			return $this->isThereAnyMob($x, $y);
		}

		public function isThereAnyMob($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_MOB
				  WHERE
				  	MOB_X = $X
				  AND
					MOB_Y = $Y
				  AND
				  	MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId()."
				  AND
				  	MOB_UTENTE_ID = ".$this->getUtenteId()."
				  AND
				  	MOB_HP > 0";
			$res = $this->db->query($q);
			if($res->num_rows < 1) return false;
			else return true;
		}

		public function getUserObjInRange($range){
			return array();
		}

		public function getMobObjInRange($range){
			$utenteId = $this->getId();
			$X = $this->getX();
			$Y = $this->getY();
			$sottoluogoId = $this->getSottoluogoId();
			/*
			$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID
					FROM BOT_RPG_MOB
					WHERE MOB_SOTTOLUOGO_ID = $sottoluogoId
					AND MOB_UTENTE_ID = $utenteId
					AND MOB_HP > 0
					AND ((MOB_X = $X AND MOB_Y = $Y)
					OR (MOB_X <= $X + $range AND MOB_Y = $Y)
					OR (MOB_X >= $X - $range AND MOB_Y = $Y)
					OR (MOB_Y <= $Y + $range AND MOB_X = $X)
					OR (MOB_Y >= $Y - $range AND MOB_X = $X)
					OR (MOB_X <= $X + $range AND MOB_Y <= $Y + $range)
					OR (MOB_X >= $X - $range AND MOB_Y <= $Y + $range)
					OR (MOB_X >= $X - $range AND MOB_Y >= $Y - $range)
					OR (MOB_X <= $X + $range AND MOB_Y >= $Y - $range))
					";
			*/
			$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID
					FROM BOT_RPG_MOB
					WHERE MOB_SOTTOLUOGO_ID = $sottoluogoId
					AND MOB_UTENTE_ID = $utenteId
					AND MOB_HP > 0
					";
			$res = Database()->query($sql); //die($sql);
			$data = array();
			while($row = $res->fetch_object()){
				$className = 'Mob'.$row->MOB_TIPO_MOB_ID;
				$Mob = new $className($row->MOB_ID);
				if($this->getDistanceFrom($Mob) <= $range)
					$data[] = &$Mob;
				unset($Mob);
			}

			return $data;
		}

		public function getMobIdsHere($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_MOB
				  WHERE
				  	MOB_X = $X
				  AND
					MOB_Y = $Y
				  AND
				  	MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId()."
				  AND
				  	MOB_UTENTE_ID = ".$this->getUtenteId()."
				  AND
				  	MOB_HP > 0";
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$data[] = $row->MOB_ID;
			}
			return $data;
		}

		public function getMobArrOBJHere($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_MOB
				  WHERE
				  	MOB_X = $X
				  AND
					MOB_Y = $Y
				  AND
				  	MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId()."
				  AND
				  	MOB_UTENTE_ID = ".$this->getUtenteId()."
				  AND
				  	MOB_HP > 0";
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$className = 'Mob'.$row->MOB_TIPO_MOB_ID;
				$Mob = new $className($row->MOB_ID);
				$data[] = &$Mob;
				unset($Mob);
			}
			return $data;
		}

		public function isThereAnyUt($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_UTENTE
				  WHERE
				  	UTENTE_X = $X
				  AND
					UTENTE_Y = $Y
				  AND
				  	UTENTE_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId();
			$res = $this->db->query($q);
			if($res->num_rows > 0) return true;
			else return false;
		}

		public function hasEquipped($nomeCategoriaEquip){
			if(!$this->hasSomethingEquipped()) return false;
			$fu = new Functions();
			if(!$fu->doesCategoriaEquipNameExist($nomeCategoriaEquip)) return false;
			$tipoEquipCategoriaId = $fu->getCategoriaEquipIdByName($nomeCategoriaEquip);
			$eqIds = $this->getActiveEquipArrayColumn('ID');
			$n = count($eqIds);
			for($i = 0; $i < $n; $i++){
				$eq = new Equip($eqIds[$i]);
				if($eq->getTipoEquipCategoriaId() == $tipoEquipCategoriaId)
					return true;
			}

			return false;
		}

		public function hasUnlockedSkill($skillId){
			$q = "SELECT *
				  FROM BOT_RPG_LEARNED_SKILL
				  WHERE
				  	LEARNED_SKILL_SKILL_ID = ".$skillId." AND LEARNED_SKILL_UTENTE_ID = ".$this->getUtenteId();
			$res = $this->db->query($q);
			if($res->num_rows == 0) return false;
			else return true;
		}

		public function learnSkill($skillId, $notify = false){
			$level = 1;
			$id = $this->getId();
			$sql = "INSERT INTO BOT_RPG_LEARNED_SKILL VALUES($skillId, $id, $level, 0)";
			$res = Database()->query($sql);
			if(!$res)
				return false;
			else{
				if($notify){
					$this->initNotifyLearnSkill();
					$this->notifyLearnSkill($skillId);
				}
				return true;
			}
		}



		public function initNotifyLearnSkill(){
			write('Hai imparato:');
		}

		public function notifyLearnSkill($id){
			$nome = Functions::getSkillNomeById($id);
			write("> $nome\n");
		}

		public function aumSkillUsata($skillId){
			$id = $this->getId();
			$sql = "UPDATE BOT_RPG_LEARNED_SKILL SET LEARNED_SKILL_NUM_USATA = LEARNED_SKILL_NUM_USATA + 1 WHERE LEARNED_SKILL_SKILL_ID = $skillId AND LEARNED_SKILL_UTENTE_ID = $id";
			Database()->query($sql);
			return true;
		}

		public function arrayNpcsIdSameSottoluogo(){
			$data = array();
			$sql = "SELECT NPC_ID FROM BOT_RPG_NPC WHERE NPC_SOTTOLUOGO_ID = ".$this->getSottoluogoId()." ORDER BY RAND()";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$data[] = $row->NPC_ID;
			}

			return $data;
		}

		public function selectAllNpcHere(){
			$data = array();
			$arrayIds = $this->arrayNpcsIdSameSottoluogo();
			$n = count($arrayIds);
			//$this->sendMessage("1");
			for($i = 0; $i < $n; $i++){
				//$this->sendMessage("2");
				$Npc = new Npc($arrayIds[$i]);
				$data[] = $Npc->getData('NOME');
			}

			return $data;
		}

		public function howManyItemsLikeThis($tipoItemId){
			$sql = "
				SELECT ITEM_QUANTITA
				FROM BOT_RPG_ITEM
				WHERE TIPO_ITEM_ID = ".$tipoItemId."
				AND UTENTE_ID = ".$this->getUtenteId();
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return 0;

			return $res->fetch_object()->ITEM_QUANTITA;
		}

		public function getNumTipoItem($tipoItemId){
			$sql = "
				SELECT ITEM_QUANTITA
				FROM BOT_RPG_ITEM
				WHERE TIPO_ITEM_ID = ".$tipoItemId."
				AND UTENTE_ID = ".$this->getUtenteId();
			$res = Database()->query($sql);

			if($res->num_rows == 0)
				return 0;

			return $res->fetch_object()->ITEM_QUANTITA;
		}

		public function hasTipoItem($tipoItemId){
			$sql = "
				SELECT ITEM_QUANTITA
				FROM BOT_RPG_ITEM
				WHERE TIPO_ITEM_ID = ".$tipoItemId."
				AND UTENTE_ID = ".$this->getUtenteId();
			$res = Database()->query($sql);
			if($res->num_rows == 0) return false;
			if($res->fetch_object()->ITEM_QUANTITA > 0)
				return true;
			else
				return false;
		}

		public function isSameSottoluogoNpc($Npc){
			if($this->getSottoluogoId() == $Npc->getData('SOTTOLUOGO_ID')){
				return true;
			}else{
				return false;
			}
		}

		public function spawnUserInRandomPositionOfSottoluogo(){
			$Sottoluogo = new Sottoluogo($this->getSottoluogoId());
			$this->setY($Sottoluogo->randAvailableY());
			$this->setX($Sottoluogo->randAvailableX());
		}

		public function getEquipsOfCategorie($equipCategorie){
			$arr = $this->OBJEquips;
			$n = count($arr);
			$k = count($equipCategorie);
			$data = array();
			for($i = 0; $i < $n; $i++){
				for($j = 0; $j < $k; $j++){
					//$this->sendMessage($arr[$i]->getTipoEquipCategoriaNome().'='.$equipCategorie[$j]);
					if(strtoupper($arr[$i]->getTipoEquipCategoriaNome()) == strtoupper($equipCategorie[$j]))
						$data[] = &$arr[$i];
				}
			}

			return $data;
		}

		/*
		public function subisciEquips($Equips){
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->onHit($this);
			}
		}
		*/
		public function triggerEquipsEffect(){
			$arr = $this->OBJEquips;
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				$arr[$i]->effect();
			}
		}

		public function triggerEquipsDebuff(Danno &$Danno){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->debuff($Danno);
			}
		}

		public function triggerEquipsBuff(Danno &$Danno){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->buff($Danno);
			}
		}

		public function triggerEquipsOnGetHitten(&$Dealer){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->onGetHitten($Dealer);
			}
		}

		public function triggerEquipsOnAttack(&$target, $equipCategoria){
			$arr = $this->OBJEquips;
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				if(strtoupper($arr[$i]->getTipoEquipCategoriaNome()) == strtoupper($equipCategoria))
					$arr[$i]->onAttack($target);
			}
		}

		public function triggerEquipsOnDefense(&$dealer){
			$arr = $this->OBJEquips;
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				$str .= $arr[$i]->onDefense($dealer);
			}

			return $str;
		}

		public function getOBJEquips(){
			return $this->OBJEquips;
		}

		public function getEquips(){
			return $this->OBJEquips;
		}


		public function loadEquips(){
			//unset($this->OBJEquips);
			if(count($this->getEquips()) > 0)
				return;

			$arrIds = $this->getActiveEquipArrayColumn('ID');
			$arrTipo = $this->getActiveEquipArrayColumn('TIPO_EQUIP_ID');

			$n = count($arrIds);
			for($i = 0; $i < $n; $i++){
				$className = 'Equip'.$arrTipo[$i];
				$Eq = new $className($this, $arrIds[$i]);
				$this->OBJEquips[] = &$Eq;
				unset($Eq);
			}

		}

		public function sendSticker($stickerId){
			global $BT;
			file_get_contents("https://api.telegram.org/bot".$BT."/sendSticker?chat_id=".$this->utenteChatId."&sticker=".$stickerId);
		}

		public function buff($Buff){
			$n = count($Buff);
			for($i = 0; $i < $n; $i++){
				$Buff[$i]->send();
			}
		}

		public function hasOvertime(){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getUtenteId()." AND ENTITA_ID = ".$this->getEntitaId()." AND NUM_TURNI > 0";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function getOvertimeCol($col){
			$data = array();
			$sql = "SELECT $col AS DATA FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getUtenteId()." AND ENTITA_ID = ".$this->getEntitaId()." AND NUM_TURNI > 0";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$data[] = $row->DATA;
			}

			return $data;
		}

		public function triggerOvertimes(){
			if(!$this->hasOvertime()) return 0;

			if($this->ots !== null){
				$OTS = $this->ots;
				$n = count($OTS);
				for($i = 0; $i < $n; $i++){
					$OTS[$i]->trigger();
				}

				return true;
			}

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->trigger();
				unset($OT);
			}
		}

		private $ots = null;
		public function getOverTimes(){
			$data = array();
			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$data[] = &$OT;
				unset($OT);
			}

			$this->ots = $data;
			return $data;
		}

		public function removeDebuff($stat){
			$id = $this->getId();
			$statId = Functions::getStatIdFromName($stat);
			$sql = "DELETE FROM BOT_RPG_STAT_BUFF WHERE UTENTE_ID = $id AND VALUE < 0 AND STAT_ID = $statId";
			Database()->query($sql);
		}

		public function removeAllOvertime(){
			$sql = "DELETE FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getId()." AND ENTITA_ID = ".$this->getEntitaId();
			Database()->query($sql);
		}

		public function triggerOvertimesDebuff(Danno &$Danno){
			if(!$this->hasOvertime()) return 0;

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->debuff($Danno);
				unset($OT);
			}
		}

		public function triggerOvertimesBuff(Danno &$Danno){
			if(!$this->hasOvertime()) return 0;

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->buff($Danno);
				unset($OT);
			}
		}

		public function subisciEquips($Equips){
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				//write('entro');
				$Equips[$i]->onHit($this);
			}
		}

		public function subisciOverTimes($OverTimes){
			$n = count($OverTimes);
			for($i = 0; $i < $n; $i++){
				$OverTimes[$i]->send();
			}
		}

		public function isMyTurnInDuel(){
			$id = $this->getUtenteId();
			$sql = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_DUELLO
				WHERE (
					DUELLO_UTENTE_ID 	= $id
							OR
					DUELLO_ENEMY_ID 	= $id
				)
				AND
					DUELLO_UTENTE_TURNO_ID = $id
				AND
					DUELLO_TERMINATO = 1
			";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function drawDuelMap(){
			$id = $this->getUtenteUtenteId();
			$razzaId = Functions::getUtenteRazzaIdById($id);
			$className = 'Razza'.$razzaId;
			$en = new $className($id);

			$X1 = $this->getX();
			$Y1 = $this->getY();

			$X2 = $en->getX();
			$Y2 = $en->getY();

			//$this->sendMessage("x1:$X1 x2:$X2 y1:$Y1 y2:$Y2");

			$sl = new Sottoluogo($this->getUtenteSottoluogoId());
			$n = $sl->getSottoluogoAmpiezza();

			$msg .= "<code>";
			$msg .= ' '.str_repeat('_', $n);
			$msg .= "\n";
			for($i = 0; $i < $n; $i++){
				$msg .= "|";
				for($k = 0; $k < $n; $k++){
					if($X1 == $X2 && $Y1 == $Y2 && $Y1 == $i && $X1 == $k){
						$msg .= '?';
						$flag = true;
					}
					else{
						if($k == $X2 && $i == $Y2){
							$msg .= '!';
							$flag = true;
						}

						if($k == $X1 && $i == $Y1){
							$msg .= 'P';
							$flag = true;
						}
					}
					if(!$flag) $msg .= ' ';//$emoji['WHITE_MEDIUM_SQUARE'];
					$flag = false;
				}
				//for($m = 0; $m < $stampati; $m++){
					//$msg .= ' ';
				//}
				$stampati = 0;
				$msg .= "|\n";//$emoji['BLACK_MEDIUM_SQUARE'];
			}
			$msg .= ' '.str_repeat('¯', $n);//¯
			$msg .= "</code>";

			$msg .= "\n\n".'(!) '.$en->getNome()."\n".$en->getUtenteHp().' HP'."\n".$this->getDistanceFrom($en).' metri';
			return $msg;

		}

		public function addMobUcciso($tipoMobId){
			$id = $this->getId();
			$sId = $this->getUtenteSottoluogoId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_UCCIDE_MOB VALUES(
				$id,
				$tipoMobId,
				CURRENT_TIMESTAMP,
				$sId
			)";
			Database()->query($sql);
		}

		public function getNumTipoMobUccisi($tipoMobId){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE_UCCIDE_MOB WHERE TIPO_MOB_ID = $tipoMobId AND UTENTE_ID = ".$this->getId();
			return Database()->query($sql)->fetch_object()->C;
		}

		public function selectAllLearnedSkillsYouHaveRightEquipsFor(){
			$sql = "SELECT S.SKILL_ID FROM BOT_RPG_SKILL S, BOT_RPG_LEARNED_SKILL LS
				WHERE LS.LEARNED_SKILL_UTENTE_ID = ".$this->getId()."
				AND S.SKILL_ID = LS.LEARNED_SKILL_SKILL_ID";
		}

		public function isSkillInCooldown($skillId){
			$utenteId = $this->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RGP_UTENTE_COOLDOWN_SKILL WHERE COOLDOWN_SKILL_ID = $skillId AND COOLDOWN_UTENTE_ID = $utenteId AND COOLDOWN_TURNI > 0 AND COOLDOWN_ENTITA_ID = ".$this->getEntitaId();
			$row = Database()->query($sql)->fetch_object()->C;
			if($C < 1) return false;
			else return $C;
		}

		public function lowerCooldowns(){
			$sql = "UPDATE BOT_RPG_UTENTE_COOLDOWN_SKILL SET COOLDOWN_TURNI = COOLDOWN_TURNI - 1 WHERE COOLDOWN_UTENTE_ID = ".$this->getId()." AND COOLDOWN_ENTITA_ID = ".$this->getEntitaId()." AND COOLDOWN_TURNI > 0";
			Database()->query($sql);

			$sql = "DELETE FROM BOT_RPG_UTENTE_COOLDOWN_SKILL WHERE COOLDOWN_UTENTE_ID = ".$this->getId()." AND COOLDOWN_ENTITA_ID = ".$this->getEntitaId()." AND COOLDOWN_TURNI < 1";
			Database()->query($sql);
		}

		protected $enemies = array();
		public function loadEnemies(){
			$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID FROM BOT_RPG_MOB WHERE MOB_UTENTE_ID = ".$this->getId()." AND MOB_SOTTOLUOGO_ID = ".$this->getUtenteSottoluogoId();
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$className = 'Mob'.$row->MOB_TIPO_MOB_ID;
				$Mob = new $className($row->MOB_ID);
				$this->enemies[] = &$Mob;
				unset($Mob);
			}
		}

		public function getEnemies(){
			if(count($this->enemies) == 0)
				$this->loadEnemies();
			
				return $this->enemies;
		}

		public function isMemoSet($string){
			$string = strtoupper($string);
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE_MEMO WHERE MEMO_TESTO = '$string' AND MEMO_UTENTE_ID = ".$this->getId();
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0){
				return true;
			}else{
				return false;
			}
		}

		public function getMemo($string){
			$string = strtoupper($string);
			$id = Functions::getMemoIdByName($string);
			if($id === false)
				$id = Functions::createMemo($string);

			$sql = "SELECT MEMO_VALUE FROM BOT_RPG_UTENTE_MEMO_V2 WHERE MEMO_ID = $id AND MEMO_UTENTE_ID = ".$this->getId();
			$res = Database()->query($sql);
			if($res->num_rows > 0){
				$row = $res->fetch_object();
				return $row->MEMO_VALUE;
			}else{
				return false;
			}
		}

		public function setMemo($string, $val){
			$db = Database();
			$id = $this->getId();
			$string = strtoupper($string);
			$memoId = Functions::getMemoIdByName($string);
			if($memoId === false){
				$memoId = Functions::createMemo($string);
			}

			$sql = "DELETE FROM BOT_RPG_UTENTE_MEMO_V2 WHERE MEMO_ID = $memoId AND MEMO_UTENTE_ID = $id";
			$db->query($sql);

			$sql = "INSERT INTO BOT_RPG_UTENTE_MEMO_V2 VALUES ($id, $memoId, '$val')";
			$db->query($sql);
		}

		public function deleteSpecificMemo($string){
			$id = $this->getId();
			$sql = "DELETE FROM BOT_RPG_UTENTE_MEMO WHERE MEMO_TESTO = '$string' AND MEMO_UTENTE_ID = $id";
			$db->query($sql);
		}

		public function getAllOwnedCategorieEquipNome(){
			$sql = "SELECT DISTINCT(CATEGORIA_EQUIP_ID), CATEGORIA_EQUIP_NOME FROM BOT_RPG_CATEGORIA_EQUIP, BOT_RPG_TIPO_EQUIP, BOT_RPG_EQUIP WHERE EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID AND CATEGORIA_EQUIP_ID = TIPO_EQUIP_CATEGORIA_EQUIP_ID AND EQUIP_UTENTE_ID = ".$this->getId();
			$res = Database()->query($sql);
			$data = array();
			while($row = $res->fetch_object()){
				$data[] = $row->CATEGORIA_EQUIP_NOME;
			}
			return $data;
		}

		public function getButtonEquipOwnedByCategoriaId($catId){
			$sql = "SELECT EQUIP_ID AS ID, TIPO_EQUIP_NOME AS NOME, EQUIP_LIVELLO AS LVL FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP, BOT_RPG_CATEGORIA_EQUIP
					WHERE EQUIP_UTENTE_ID = ".$this->getId()."
					AND   EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
					AND   CATEGORIA_EQUIP_ID = TIPO_EQUIP_CATEGORIA_EQUIP_ID
					AND   CATEGORIA_EQUIP_ID = $catId";
			$res = Database()->query($sql);
			$buttons = array();
			while($row = $res->fetch_object()){
				$buttons[] = $row->NOME . ' (+'.$row->LVL.')';
			}
			return $buttons;
		}

		public function printEquipOwnedByCategoriaId($catId){
			$sql = "SELECT EQUIP_ID AS ID, TIPO_EQUIP_NOME AS NOME, EQUIP_LIVELLO AS LVL FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP, BOT_RPG_CATEGORIA_EQUIP
					WHERE EQUIP_UTENTE_ID = ".$this->getId()."
					AND   EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
					AND   CATEGORIA_EQUIP_ID = TIPO_EQUIP_CATEGORIA_EQUIP_ID
					AND   CATEGORIA_EQUIP_ID = $catId";
			$res = Database()->query($sql);
			$msg = '';
			while($row = $res->fetch_object()){
				$msg .= '<b>'.$row->NOME . '</b> (+'.$row->LVL.')'."\n".'/'.$row->ID;
				$msg .= "\n\n";
			}

			write($msg);
		}

		public function showEquipInfo($equipId){

		}

		public function printKilledMobsOfAllTime(){
			$id = $this->getId();
			$limit = 5;
			$msg = $this->getNome() . ' ha sconfitto: '."\n";
			$sql = "SELECT TM.TIPO_MOB_ID, TM.TIPO_MOB_NOME, COUNT(*) AS C FROM BOT_RPG_UTENTE_UCCIDE_MOB UUM, BOT_RPG_TIPO_MOB TM WHERE TM.TIPO_MOB_ID = UUM.TIPO_MOB_ID AND UTENTE_ID = $id GROUP BY(TM.TIPO_MOB_ID) ORDER BY(C) DESC LIMIT $limit";
			$res = Database()->query($sql);
			if($res->num_rows == 0){
				write($this->getNome().' non ha mai sconfitto alcun mob!'."\n");
				return 0;
			}
			while($row = $res->fetch_object()){
				$msg .= '><b>'.$row->TIPO_MOB_NOME.'</b> x'.$row->C."\n";
			}

			write($msg);
		}

		public function printKilledMobsToday(){
			$id = $this->getId();
			$limit = 5;
			$msg = 'Oggi: '."\n";
			$sql = "SELECT TM.TIPO_MOB_ID, TM.TIPO_MOB_NOME, COUNT(*) AS C FROM BOT_RPG_UTENTE_UCCIDE_MOB UUM, BOT_RPG_TIPO_MOB TM WHERE TM.TIPO_MOB_ID = UUM.TIPO_MOB_ID AND UTENTE_ID = $id AND YEAR(CURDATE()) = YEAR(DATA) AND MONTH(CURDATE()) = MONTH(DATA) AND DAY(CURDATE()) = DAY(DATA) GROUP BY(TM.TIPO_MOB_ID) ORDER BY(C) DESC LIMIT $limit";
			$res = Database()->query($sql);
			if($res->num_rows == 0){
				write($this->getNome().' non ha sconfitto mob oggi.'."\n");
				return 0;
			}
			while($row = $res->fetch_object()){
				$msg .= '><b>'.$row->TIPO_MOB_NOME.'</b> x'.$row->C."\n";
			}

			write($msg);
		}

		public function getHowManyTipoItemId($tipoItemId){
			$id = $this->getId();
			$sql = "SELECT ITEM_QUANTITA FROM BOT_RPG_ITEM WHERE UTENTE_ID = $id AND TIPO_ITEM_ID = $tipoItemId";
			$res = Database()->query($sql);
			if($res->num_rows == 0) return 0;
			$row = $res->fetch_object();
			return $row->ITEM_QUANTITA;
		}

		public function addFriend(&$friend){
			$id = $this->getId();
			$friendId = $friend->getId();
			if($friendId == $id){
				write('Non puoi chiedere l\'amicizia a te stesso!');
				return false;
			}

			if($friend->isFriend($this)){
				$sql = "UPDATE BOT_RPG_FRIENDLIST SET RICAMBIATA = 1, DATA_INIZIO = NOW() WHERE UTENTE_UNO_ID = $friendId AND UTENTE_DUE_ID = $id";
			}else{
				$sql = "INSERT INTO BOT_RPG_FRIENDLIST VALUES($id, $friendId, NOW(), 0)";
			}

			Database()->query($sql);
			write("Hai aggiunto ".$friend->getNome()." alla tua lista amici.\n");
			return true;
		}

		public function isFriend(&$friend){
			$id = $this->getId();
			$friendId = $friend->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_FRIENDLIST WHERE (UTENTE_UNO_ID = $id OR UTENTE_DUE_ID = $id) AND (UTENTE_DUE_ID = $friendId OR UTENTE_UNO_ID = $friendId)";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0)
				return true;
			else
				return false;
		}

		public function areWeBothFriend(&$friend){
			//return $this->isFriend($friend) && $friend->isFriend($this);
			$id = $this->getId();
			$friendId = $friend->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_FRIENDLIST WHERE (UTENTE_UNO_ID = $id OR UTENTE_DUE_ID = $id) AND (UTENTE_DUE_ID = $friendId OR UTENTE_UNO_ID = $friendId) AND RICAMBIATA = 1";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0)
				return true;
			else
				return false;
		}

		public function showScheda(){
			write($this->printUtenteInfo());
			write($this->printBuffs());
			write('');
			$this->printKilledMobsOfAllTime();
			$this->printKilledMobsToday();
		}

		public function printFriends(){
			$i = 0;
			$j = 0;
			$id = $this->getId();
			$ricambiata 	= array();
			$NONricambiata	= array();

			$sql = "SELECT UTENTE_DUE_ID AS ID, UTENTE_NICK AS NICK, UTENTE_DATA_LAST_COMMAND AS DATA, SOTTOLUOGO_NOME AS SOTTOLUOGO, LUOGO_NOME AS LUOGO, RICAMBIATA
					FROM BOT_RPG_FRIENDLIST, BOT_RPG_UTENTE, BOT_RPG_SOTTOLUOGO, BOT_RPG_LUOGO
					WHERE UTENTE_UNO_ID = $id
					AND UTENTE_DUE_ID = UTENTE_ID
					AND UTENTE_SOTTOLUOGO_ID = SOTTOLUOGO_ID
					AND SOTTOLUOGO_LUOGO_ID = LUOGO_ID";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				if($row->RICAMBIATA == 1){
					$ricambiata[$i]['ID'] = $row->ID;
					$ricambiata[$i]['NICK'] = $row->NICK;
					$ricambiata[$i]['DATA'] = $row->DATA;
					$ricambiata[$i]['LUOGO'] = $row->LUOGO;
					$ricambiata[$i]['SOTTOLUOGO'] = $row->SOTTOLUOGO;
					$i++;
				}else{
					$NONricambiata[$i]['ID'] = $row->ID;
					$NONricambiata[$i]['NICK'] = $row->NICK;
					$NONricambiata[$i]['DATA'] = $row->DATA;
					$NONricambiata[$i]['LUOGO'] = $row->LUOGO;
					$NONricambiata[$i]['SOTTOLUOGO'] = $row->SOTTOLUOGO;
					$j++;
				}
			}

			$sql = "SELECT UTENTE_UNO_ID AS ID, UTENTE_NICK AS NICK, UTENTE_DATA_LAST_COMMAND AS DATA, SOTTOLUOGO_NOME AS SOTTOLUOGO, LUOGO_NOME AS LUOGO, RICAMBIATA
					FROM BOT_RPG_FRIENDLIST, BOT_RPG_UTENTE, BOT_RPG_SOTTOLUOGO, BOT_RPG_LUOGO
					WHERE UTENTE_DUE_ID = $id
					AND UTENTE_UNO_ID = UTENTE_ID
					AND UTENTE_SOTTOLUOGO_ID = SOTTOLUOGO_ID
					AND SOTTOLUOGO_LUOGO_ID = LUOGO_ID";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				if($row->RICAMBIATA == 1){
					$ricambiata[$i]['ID'] = $row->ID;
					$ricambiata[$i]['NICK'] = $row->NICK;
					$ricambiata[$i]['DATA'] = $row->DATA;
					$ricambiata[$i]['LUOGO'] = $row->LUOGO;
					$ricambiata[$i]['SOTTOLUOGO'] = $row->SOTTOLUOGO;
					$i++;
				}else{
					$NONricambiata[$i]['ID'] = $row->ID;
					$NONricambiata[$i]['NICK'] = $row->NICK;
					$NONricambiata[$i]['DATA'] = $row->DATA;
					$NONricambiata[$i]['LUOGO'] = $row->LUOGO;
					$NONricambiata[$i]['SOTTOLUOGO'] = $row->SOTTOLUOGO;
					$j++;
				}
			}

			$i = 0;
			$n = count($ricambiata);
			if($n > 0)
				write('<b>Lista amici</b>'."\n");
			for($i = 0; $i < $n; $i++){
				//$now = new DateTime();
				//$lastCommand = $ricambiata['DATA'];
				//$interval = $lastCommand->diff($now);
				//$emoji = $now->sub($interval) >
				write($ricambiata[$i]['NICK']."\n".$ricambiata[$i]['LUOGO']."\n".'('.$ricambiata[$i]['SOTTOLUOGO'].')'."\n");
			}

			$i = 0;
			$n = count($NONricambiata);
			if($n > 0)
				write("\n".'<i>Richiesta in sospeso</i>'."\n");
			for($i = 0; $i < $n; $i++){
				write($NONricambiata[$i]['NICK']."\n");
			}

		}

		public function changeFocus($a, $b){
			return false;
		}

		public function isThereAnyUser($X, $Y){
			return false;
		}

		public function getUserOBJHere($X, $Y){
			$data = array();
			return $data;
		}

		public function lowerBuff(){
			$id = $this->getId();
			$sql = "UPDATE BOT_RPG_STAT_BUFF SET SCADENZA = SCADENZA - 1 WHERE UTENTE_ID = $id";
			Database()->query($sql);
		}

		public function printBuffs(){
			$str = '';
			$str .= $this->getNome().' <b>Buff</b> & <b>Debuff</b>';
			$err = $this->getNome().' non ha buff/debuff';

			$turno = '';

			$id = $this->getId();
			$sql = "SELECT STAT_NOME, VALUE, SCADENZA FROM BOT_RPG_STAT_BUFF SB, BOT_RPG_STAT S WHERE S.STAT_ID = SB.STAT_ID AND UTENTE_ID = $id AND SCADENZA > 0 ORDER BY SCADENZA DESC";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return $err;
			while($row = $res->fetch_object()){
				if($turno != $row->SCADENZA){
					$ch = $row->SCADENZA == 1 ? 'O' : 'I';
					$str .= "\n".'<i>'.$this->drawNumberToEmoji($row->SCADENZA).' TURN'.$ch.'</i>'."\n";
					$turno = $row->SCADENZA;
				}

				$sign = $row->VALUE < 0 ? '-' : '+';
				$str .= getEmojiStats()[strtoupper($row->STAT_NOME)].'<b>'.ucfirst(strtolower($row->STAT_NOME)).'</b>: '.$sign.abs($row->VALUE)."\n";
			}

			return $str;
		}

		public function hasTalkedToNpc($npcId){
			$id = $this->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE_TALK_NPC WHERE UTENTE_ID = $id AND NPC_ID = $npcId";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function getTargetsInRange($range){
			return array_merge($this->getMobObjInRange($range), $this->getUserObjInRange($range));
		}

		public function spawnPet(){
			$mobs = $this->selectAllMobsMultidimensionalArrayIdXY();
			$n = count($mobs);
			//$this->sendMessage($n);
			if($n == 0) return false;

			$sottoluogoId = $this->getSottoluogoId();

			$minDistance = 999;
			$targetId = 0;
			for($i = 0; $i < $n; $i++){
				$x = $mobs[$i]['X'];
				$y = $mobs[$i]['Y'];
				$Punto = new Punto($x, $y);
				$Punto->setSottoluogoId($sottoluogoId);
				$dist = $this->getDistanceFrom($Punto);
				if($dist < $minDistance){
					$minDistance = $dist;
					$targetId = $mobs[$i]['ID'];
				}
			}

			$id = $this->getId();
			$sql = "SELECT P.PET_TIPO_MOB_ID, UP.PET_NOME_ID, UP.PET_LIVELLO FROM BOT_RPG_PET P, BOT_RPG_UTENTE_PET UP WHERE P.PET_ID = UP.PET_ID AND UP.UTENTE_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0) return false;
			while($row = $res->fetch_object()){
				$pet = array(
					'ID' => $row->PET_TIPO_MOB_ID,
					'LVL' => $row->PET_LIVELLO,
					'NOME_ID' => $row->PET_NOME_ID,
					'X' => $this->getX(),
					'Y' => $this->getY(),
					'HP' => Functions::getTipoMobMaxHp($row->PET_TIPO_MOB_ID, $row->PET_LIVELLO),
					'TARGET_ID' => $targetId,
					'TARGET_ENTITA_ID' => 1,
					'PET' => 1
				);

				$this->summonMob($pet);
			}

			return true;
		}

		public function isStunned(){
			$turniStun = $this->getMemo('STUN');
			if($this->$turniStun > 0){
				$turniStun -= 1;
				write($ut->getNome().' è stunnato! Ancora per '.$turniStun.' turni'."\n");
				$this->setMemo('STUN', $turniStun);
				return true;
			}
			else
				return false;
		}

		public function isCrowdControlled(){
			return $this->isStunned();
		}

		public function accumulaSoldi($soldi){
			$this->setMemo('SOLDI_ACCUMULATI', $this->getMemo('SOLDI_ACCUMULATI') + $soldi);
		}

		public function accumulaExp($exp){
			$this->setMemo('EXP_ACCUMULATA', $this->getMemo('EXP_ACCUMULATA') + $exp);
		}

		public function svuotaAccumuloSoldi(){
			$this->setMemo('SOLDI_ACCUMULATI', 0);
		}

		public function svuotaAccumuloExp(){
			$this->setMemo('EXP_ACCUMULATA', 0);
		}

		public function aumentaTalentoCategoriaEquip($categoriaEquipId){
			$id = $this->getId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_CATEGORIA_EQUIP VALUES($id, $categoriaEquipId, 1) ON DUPLICATE KEY UPDATE VALUE = VALUE + 1";
			Database()->query($sql);
		}

		public function iniziaEsplorazione($sec, $tipoEsplorazioneId){
			$id = $this->getId();
			$sql = "INSERT INTO BOT_RPG_ESPLORAZIONE VALUES($id, NOW(), DATE_ADD(NOW(), INTERVAL $sec SECOND), $tipoEsplorazioneId)";
			Database()->query($sql);
		}

		public function staEsplorando(){
			$id = $this->getId();
			$sql = "SELECT 1 FROM BOT_RPG_ESPLORAZIONE WHERE UTENTE_ID = $id AND DATA_FINE > NOW()";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			else
				return true;
		}

		public function getTimeNextEsplorazione(){
			$id = $this->getId();
			$sql = "SELECT HOUR(DATA_FINE) H, MINUTE(DATA_FINE) M, SECOND(DATA_FINE) S, DAY(DATA_FINE) D, MONTH(DATA_FINE) MO, YEAR(DATA_FINE) Y FROM BOT_RPG_ESPLORAZIONE WHERE UTENTE_ID = $id AND DATA_FINE > NOW() ORDER BY (DATA_INIZIO) DESC LIMIT 1";
			$res = Database()->query($sql);
			$row = $res->fetch_object();

			$months = array('Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');

			if($row->H < 10)
				$row->H = '0'.$row->H;

			if($row->M < 10)
				$row->M = '0'.$row->M;

			return $row->H.':'.$row->M. ' del '.$row->D.' '.$months[$row->MO-1];
		}

		public function notifyGiveSoldi($soldi){
			write('Hai ottenuto '.$soldi.'£!');
		}

		public function notifyTakeSoldi($soldi){
			write('Hai perso '.$soldi.'£!');
		}

		public function notifyGiveExp($exp){
			write('Hai ottenuto '.$exp.' exp!');
		}

		public function initNotifyGiveItem(){
			write('Hai ottenuto:');
		}

		public function notifyGiveItem($tipoItemId, $quan = 1){
			$tipoItemNome = Functions::getTipoItemNameById($tipoItemId);
			$quantita = $quan > 1 ? ' x'.$quan : '';
			write('>'.$tipoItemNome.$quantita);
		}

		public function showOverTimes(){
			$msg = '<b>Stati di '.$this->getNome().'</b>'."\n\n";
			$id = $this->getId();
			$entitaId = $this->getEntitaId();
			$sql = "SELECT TIPO_OVERTIME_NOME, NUM_TURNI FROM BOT_RPG_OVERTIME O, BOT_RPG_TIPO_OVERTIME OO WHERE O.TIPO_OVERTIME_ID = OO.TIPO_OVERTIME_ID AND ENTITA_ID = $entitaId AND TARGET_ID = $id AND NUM_TURNI > 0 ORDER BY (NUM_TURNI) DESC";
			$res = Database()->query($sql);

			if($res->num_rows == 0){
				write('<b>'.$this->getNome().'</b> non ha stati attivi al momento');
				return false;
			}

			while($row = $res->fetch_object()){
				$msg .= '> '.$row->TIPO_OVERTIME_NOME.' ('.$row->NUM_TURNI.'T)'."\n\n";
			}

			write($msg);
			return true;
		}

		public function selectItemsDaIncastonare(){
			$data = array();
			$id = $this->getId();
			$categorieId = array(1);
			$n = count($categorieId);
			$sql = "SELECT I.TIPO_ITEM_ID, TI.TIPO_ITEM_NOME FROM BOT_RPG_ITEM I, BOT_RPG_TIPO_ITEM TI ";
			$sql .= "WHERE I.TIPO_ITEM_ID = TI.TIPO_ITEM_ID AND UTENTE_ID = $id AND ITEM_QUANTITA > 0 AND ( ";
			for($i = 0; $i < $n; $i++){
				$sql .= ' TIPO_ITEM_CATEGORIA_ITEM_ID = '.$categorieId[$i].' ';
				if($i != $n-1)
					$sql .= 'OR';
			}
			$sql .= ')';

			$res = Database()->query($sql);
			if($res->num_rows == 0){
				$data[] = 'Non hai item da incastonare!';
				//segnalaNotifica($sql);
				return $data;
			}

			$j = 0;
			while($row = $res->fetch_object()){
				//$data[$j]['ID'] 	= $row->TIPO_ITEM_ID;
				//$data[$j]['NOME']	= $row->TIPO_ITEM_NOME;
				$data[] = $row->TIPO_ITEM_NOME;
				$j++;
			}

			return $data;
		}

		public function selectItemsByCategorieId($categorieId){
			$data = array();
			$id = $this->getId();
			//$categorieId = array(1);
			$n = count($categorieId);
			$sql = "SELECT I.TIPO_ITEM_ID, TI.TIPO_ITEM_NOME FROM BOT_RPG_ITEM I, BOT_RPG_TIPO_ITEM TI ";
			$sql .= "WHERE I.TIPO_ITEM_ID = TI.TIPO_ITEM_ID AND UTENTE_ID = $id AND ITEM_QUANTITA > 0 AND ( ";
			for($i = 0; $i < $n; $i++){
				$sql .= ' TIPO_ITEM_CATEGORIA_ITEM_ID = '.$categorieId[$i].' ';
				if($i != $n-1)
					$sql .= 'OR';
			}
			$sql .= ')';

			$res = Database()->query($sql);
			if($res->num_rows == 0){
				//$data[] = 'Non hai item da incastonare!';
				//segnalaNotifica($sql);
				return $data;
			}

			$j = 0;
			while($row = $res->fetch_object()){
				//$data[$j]['ID'] 	= $row->TIPO_ITEM_ID;
				//$data[$j]['NOME']	= $row->TIPO_ITEM_NOME;
				$data[] = $row->TIPO_ITEM_NOME;
				$j++;
			}

			return $data;
		}

		public function printMostUsedSkills(){

		}

		public function hasClearedQuest($questId){
			$id = $this->getId();
			$sql = "SELECT UTENTE_ID FROM BOT_RPG_UTENTE_QUEST_CLEARED WHERE UTENTE_ID = $id AND QUEST_ID = $questId";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			else
				return true;
		}

		public function isQuestAlreadyStarted($questId){
			$id = $this->getId();
			$sql = "SELECT QUEST_ID FROM BOT_RPG_UTENTE_QUEST WHERE QUEST_ID = $questId AND UTENTE_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			else
				return true;
		}

		public function notifyStartQuest($questId){
			write('<b>QUEST ASSEGNATA:</b>');
			write('<b>'.Functions::getQuestNomeById($questId)."</b>\n");
		}

		public function startQuest($questId, $notify = false){
			if($this->isQuestAlreadyStarted($questId))
				return false;

			$id = $this->getId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_QUEST VALUES ($id, $questId, NOW())";
			$res = Database()->query($sql);

			if($notify)
				$this->notifyStartQuest($questId);

			return true;
		}

		public function clearQuest($questId){
			$id = $this->getId();
			if($this->hasClearedQuest($questId))
				$sql = "UPDATE BOT_RPG_UTENTE_QUEST_CLEARED SET NUM_CLEARED = NUM_CLEARED + 1, LAST_CLEARED = NOW() WHERE QUEST_ID = $questId AND UTENTE_ID = $id";
			else
				$sql = "INSERT INTO BOT_RPG_UTENTE_QUEST_CLEARED VALUES ($id, $questId, 1, NOW())";

			Database()->query($sql);
		}

		public function deleteQuest($questId){
			$id = $this->getId();
			$sql = "DELETE FROM BOT_RPG_UTENTE_QUEST WHERE UTENTE_ID = $id AND QUEST_ID = $questId";
			Database()->query($sql);
		}

		public function getLastClearQuest($questId){
			$id = $this->getId();
			$sql = "SELECT LAST_CLEARED FROM BOT_RPG_UTENTE_QUEST_CLEARED WHERE UTENTE_ID = $id AND QUEST_ID = $questId";
			$res = Database()->query($sql);
			if(!$res)
				return false;
			else
				return $res->fetch_object()->LAST_CLEARED;
		}

		public function printActiveQuests(){
			$id = $this->getId();
			$sql = "SELECT QUEST_NOME, QUEST_TESTO FROM BOT_RPG_UTENTE_QUEST UQ, BOT_RPG_QUEST Q WHERE UQ.QUEST_ID = Q.QUEST_ID AND UTENTE_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0){
				write('Non hai quest attive!');
				return false;
			}
			while($row = $res->fetch_object()){
				write('<b>'.strtoupper($row->QUEST_NOME).'</b>');
				write($row->QUEST_TESTO);
				write("\n\n");
			}
		}

		public function startGame(){
			$this->setUtenteSottoluogoId(10);
			$this->setUtenteNpcId(127);
			$this->setUtenteStatoId(17);
			$npc = new Npc127();
			$npc->setUtente($this);
			$npc->setText(null);
			$npc->talk();
			global $key;
			$key = $npc->getKeyboard();
		}

		public function useSkill($id, $tipoMobId){
			$ut = &$this;

			//$ut->setTarget($Mob);
			//prof_flag('USE_SKILL_1');
			//prof_flag('CREATE SKILL');
			$skillId = $ut->getUtenteSkillId();

			$className = 'Skill'.$skillId;
			$Skill = new $className();
			$Skill->setCaster($ut);

			//prof_flag('USE_SKILL_2');

			if($id !== null && $tipoMobId !== null){
				/*
				$className = 'Mob'.$tipoMobId;
				$Mob = new $className($id);
				$Skill->setTarget($Mob);
				*/

				$Mobs = $this->getEnemies();
				//$n = count($Mobs);
				foreach($Mobs as $Mob){
					if($Mob->getId() == $id){
						$Skill->setTarget($Mob);
						break;
					}
				}
			}


			//prof_flag('USE_SKILL_3');
			$Skill->loadEquips();
			$Skill->loadOvertimes();


			prof_flag('USE_SKILL_1');
			//prof_flag('TRIGGER SKILL');
			if($Skill->check()){
				$ut->triggerPreOvertimes();
				prof_flag('USE_SKILL_2');
				if($ut->isImpaired())
					return 0;
				prof_flag('USE_SKILL_3');
				if($Skill->getReadyToBeTriggered()){
					$ut->aumSkillUsata($skillId);
					return 0;
				}else{
					return 1;
				}
			}
			else{
				write($Skill->findErr());
				//$key = kBattle();
				//$ut->setUtenteStatoId(3);
				return 2;
			}
		}

		public function battleFlow(){
			$ut = &$this;

			prof_flag('BATTLE_FLOW_1');
			$ut->passive();
			$ut->triggerEquipsEffect();
			$ut->triggerOvertimes();

			prof_flag('BATTLE_FLOW_2');
			$ut->lowerCooldowns();
			$ut->lowerBuff();

			prof_flag('BATTLE_FLOW_3');
			//$arr = $ut->selectAllMobsId();
			//$arrTip = $ut->selectAllTipoMobsId();
			//$n = count($arr);
			//for($i = 0; $i < $n && $ut->isVivo(); $i++){
				/*
				$className = 'Mob'.$arrTip[$i];
				$Mob = new $className($arr[$i]);
				$Mob->battleFlow($this);
				unset($Mob);
				*/
			//}

			$Mobs = $this->getEnemies();
			foreach($Mobs as $Mob){
				if($ut->isVivo())
					$Mob->battleFlow($ut);
			}

			prof_flag('BATTLE_FLOW_4');

		}

		public function triggerOverTimeDealWithOverTime(OverTime &$OverTime){
			if(!$this->hasOvertime()) return 0;

			if($this->ots !== null){
				$OTS = $this->ots;
				$n = count($OTS);
				for($i = 0; $i < $n; $i++){
					$OTS[$i]->dealWithOverTime($OverTime);
				}

				return true;
			}

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->dealWithOverTime($OverTime);
				unset($OT);
			}
		}

		public function triggerPreOvertimes(){
			if(!$this->hasOvertime()) return 0;

			if($this->ots !== null){
				$OTS = $this->ots;
				$n = count($OTS);
				for($i = 0; $i < $n; $i++){
					$OTS[$i]->preTrigger();
				}

				return true;
			}

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->preTrigger();
				unset($OT);
			}
		}

		public function battleRecap(){
			$ut = &$this;
			write("Hai vinto la battaglia!\n");
			$exp = $ut->getMemo('EXP_ACCUMULATA');
			$soldi = $ut->getMemo('SOLDI_ACCUMULATI');
			$ut->giveSoldi($soldi);
			$ut->notifyGiveSoldi($soldi);
			$ut->giveExp($exp);
			$ut->notifyGiveExp($exp);
			$ut->svuotaAccumuloSoldi();
			$ut->svuotaAccumuloExp();
		}

		public function showTalentiCategoriaEquip(){
			$msg = '';
			$id = $this->getId();
			$sql = "SELECT CATEGORIA_EQUIP_ID AS CAT, VALUE AS VAL FROM BOT_RPG_UTENTE_CATEGORIA_EQUIP WHERE UTENTE_ID = $id ORDER BY VALUE DESC";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$catNome = Functions::getCategoriaEquipNameById($row->CAT);
				$lvl = intval($row->VAL/10);
				if($lvl == 0)
					$lvl = 1;
				//Functions::drawNumberToEmoji($lvl)
				$msg .= '<b>'.$catNome.'</b>'."\nLivello $lvl\n\n";
			}

			write($msg);
		}

		public function showSkills(){
			$id = $this->getId();
			$msg = '';

        	$sql = "SELECT DISTINCT(S.SKILL_ID) AS ID, S.SKILL_NOME AS NOME, CE.CATEGORIA_EQUIP_ID, CE.CATEGORIA_EQUIP_NOME
         	   FROM BOT_RPG_SKILL S, BOT_RPG_LEARNED_SKILL LS, BOT_RPG_UTENTE U, BOT_RPG_CATEGORIA_EQUIP CE, BOT_RPG_EQUIP E, BOT_RPG_TIPO_EQUIP TE, BOT_RPG_SKILL_CATEGORIA_EQUIP SCE
          	  WHERE S.SKILL_ID = LS.LEARNED_SKILL_SKILL_ID
        	    AND LS.LEARNED_SKILL_UTENTE_ID = U.UTENTE_ID
            	AND E.EQUIP_UTENTE_ID = U.UTENTE_ID
        	    AND E.EQUIP_TIPO_EQUIP_ID = TE.TIPO_EQUIP_ID
            	AND TE.TIPO_EQUIP_CATEGORIA_EQUIP_ID = CE.CATEGORIA_EQUIP_ID
            	AND E.EQUIP_ATTIVO = 1
           	 	AND SCE.SKILL_ID = S.SKILL_ID
            	AND SCE.CATEGORIA_EQUIP_ID = CE.CATEGORIA_EQUIP_ID
           	 	AND U.UTENTE_ID = $id;";
       	 	$res = Database()->query($sql);
        	while($row = $res->fetch_object()){
            	$msg .= $row->NOME."\n/".$row->ID."\n\n";
        	}

        	$sql = "
        		SELECT SKILL_ID AS ID, SKILL_NOME AS NOME
        		FROM BOT_RPG_SKILL S WHERE S.SKILL_ID NOT IN(SELECT SKILL_ID FROM BOT_RPG_SKILL_CATEGORIA_EQUIP)
        		AND S.SKILL_ID IN(SELECT LEARNED_SKILL_SKILL_ID FROM BOT_RPG_LEARNED_SKILL WHERE LEARNED_SKILL_UTENTE_ID = $id)";
        	$res = Database()->query($sql);
        	while($row = $res->fetch_object()){
            	$msg .= $row->NOME."\n/".$row->ID."\n\n";
        	}

        	write($msg);
		}

		public function redirectToNpc($npcId){

		}

		public function getTipoItemIdOwnedByCategoriaId($tipoItemCategoriaId){
			$id = $this->getId();
			$sql = "SELECT TI.TIPO_ITEM_ID, I.ITEM_QUANTITA, TI.TIPO_ITEM_NOME FROM BOT_RPG_ITEM I, BOT_RPG_TIPO_ITEM TI WHERE I.TIPO_ITEM_ID = TI.TIPO_ITEM_ID AND I.UTENTE_ID = $id AND TI.TIPO_ITEM_CATEGORIA_ITEM_ID = $tipoItemCategoriaId";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){

			}
		}

		public function scegliDardo(){
			$ScegliDardoNpc = 130;
			Functions::redirectToNpc($this, $ScegliDardoNpc);
		}

		public function scegliLanciabile(){
			$Npc = 131;
			Functions::redirectToNpc($this, $Npc);
		}

		public function getArrRarita(){
			$rarita = array(
				'Comune' => 1,
				'Non Comune' => 2,
				'Raro' => 3,
				'Epico' => 4,
				'Leggendario' => 5,
				'Fantasma' => 6,
			);

			return $rarita;
		}

		public function entraGilda($gildaId){
			$id = $this->getId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_GILDA VALUES($id, $gildaId, 0, NOW())";
			Database()->query($sql);
		}

		public function lasciaGilda(){
			$id = $this->getId();
			$sql = "DELETE FROM BOT_RPG_UTENTE_GILDA WHERE UTENTE_ID = $id";
			Database()->query($sql);
		}

		public function isInGilda(){
			$id = $this->getId();
			$sql = "SELECT GILDA_ID FROM BOT_RPG_UTENTE_GILDA WHERE UTENTE_ID = $id LIMIT 1";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			$row = $res->fetch_object();
			return $row->GILDA_ID;
		}

		protected $Gilda;

		public function setGilda(&$Gilda){
			$this->Gilda = $Gilda;
		}

		public function getGilda(){
			return $this->Gilda;
		}


		public function hasCavalcatura(){
			$id = $this->getId();
			$sql = "SELECT CAVALCATURA_ID, LIVELLO, NOME_ID, DATA_SCADENZA FROM BOT_RPG_UTENTE_CAVALCATURA WHERE UTENTE_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			$i = 0;
			$data = array();
			while($row = $res->fetch_object()){
				$data[$i]['LIVELLO'] 		= $row->LIVELLO;
				$data[$i]['NOME_ID'] 		= $row->NOME_ID;
				$data[$i]['DATA_SCADENZA'] 	= $row->DATA_SCADENZA;
				$data[$i]['CAVALCATURA_ID'] = $row->CAVALCATURA_ID;
				$i++;
			}

			return $data;
		}

		public function printCavalcature($arr){

		}

		public function hasEquipId($equipId){
			$id = $this->getId();
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_EQUIP WHERE EQUIP_ID = $equipId AND EQUIP_UTENTE_ID = $id";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function setGradoGildaId($gradoId){
			$id = $this->getId();
			$sql = "UPDATE BOT_RPG_UTENTE_GILDA SET GRADO = $gradoId WHERE UTENTE_ID = $id";
			Database()->query($sql);
		}

		public function getGildaGradoId(){
			$id = $this->getId();
			$sql = "SELECT GRADO FROM BOT_RPG_UTENTE_GILDA WHERE UTENTE_ID = $id";
			return Database()->query($sql)->fetch_object()->GRADO;
		}

		public function saveCommand($comando, $output, $tempoEsecuzione){
			$id = $this->getId();
			$statoId = $this->getUtenteStatoId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_COMANDO VALUES(null, ?,?,?,?, CURRENT_TIMESTAMP, ?)";
			$sql = Database()->prepare($sql);
			$sql->bind_param('issid', $id, $comando, $output, $statoId, $tempoEsecuzione);
			$sql->execute();
		}

		public function joinFight($battleId){
			$Fight = new Fight($battleId);

			$sql = "INSERT INTO BOT_RPG_FIGHT_UTENTE VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0)";
			$sql = Database()->prepare($sql);
			$sql->bind_param('ii', $battleId, $this->getId());
			$sql->execute();
		}

		public function leaveFight(){
			$sql = "DELETE FROM BOT_RPG_FIGHT_UTENTE WHERE UTENTE_ID = ?";
			$sql = Database()->prepare($sql);
			$sql->bind_param('i', $this->getId());
			$sql->execute();
		}

		public function isInFight(){
			$sql = "SELECT FIGHT_ID FROM BOT_RPG_FIGHT_UTENTE WHERE UTENTE_ID = ?";
			$sql = Database()->prepare($sql);
			$sql->bind_param('i', $this->getId());
			$res = $sql->execute();
			if($res->num_rows == 0)
				return false;
			else
				return $res->fetch_object()->FIGHT_ID;
		}



		protected $doSendFinalMessage = true;

		public function doSendFinalMessage($bool = null){
			if(!is_null($bool))
				$this->doSendFinalMessage = $bool;

			return $this->doSendFinalMessage;
		}

		protected $hasUsedSkill = FALSE;
		public function hasUsedSkill($bool = null){
			if(!is_null($bool))
				$this->hasUsedSkill = $bool;

			return $this->hasUsedSkill;
		}

		protected $hasMoved = FALSE;
		public function hasMoved($bool = null){
			if(!is_null($bool))
				$this->hasMoved = $bool;

			return $this->hasMoved;
		}

		protected $moveDirection = NULL;
		public function moveDirection($bool = null){
			if(!is_null($bool))
				$this->moveDirection = $bool;

			return $this->moveDirection;
		}

		protected $hasEnteredBattle = FALSE;
		public function hasEnteredBattle($bool = null){
			if(!is_null($bool))
				$this->hasEnteredBattle = $bool;

			return $this->hasEnteredBattle;
		}

		protected $targetMobid;
		public function setTargetMobId($a){
			$this->targetMobid = $a;
		}

		public function getTargetMobId(){
			return $this->targetMobid;
		}


	}
