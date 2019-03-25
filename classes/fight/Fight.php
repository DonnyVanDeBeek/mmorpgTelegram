<?php
	class Fight{
		private $prefix 	= 'BOT_RPG'; 
		private $tableName 	= 'FIGHT';		
		private $primaryKey = 'ID';
		
		protected $data;

		protected $Mobs = array();
		protected $Utenti = array();
		protected $Utente;
		protected $Sottoluogo;
		
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
			$this->Utente = $a;
		}

		public function getUtente(){
			return $this->Utente;
		}

		public function addUtente(&$a){
			$this->Utenti[] = $a;
		}

		public function setUtenti(&$a){
			$this->Utenti = $a;
		}

		public function getUtenti(){
			return $this->Utenti;
		}

		public function setSottoluogo(&$a){
			$this->Sottoluogo = $a;
		}

		public function getSottoluogo(){
			return $this->Sottoluogo;
		}

		public function setMobs(&$a){
			$this->Mobs = $a;
		}

		public function getMobs(){
			return $this->getMobs();
		}

		public function setDataDB($info, $value){
			$tableName 	= $this->tableName;
			$primaryKey	= $this->primaryKey;
			$sql = "UPDATE ".$tableName." SET ".$tableName.'_'.strtoupper($info)." = ".$value." WHERE ".$tableName.'_'.$primaryKey." = ".$this->getData($primaryKey);
			Database()->query($sql);
		}

		public function create($tipoFightId, $utenteId, $sottoluogoId, $maxUtenti = 1){
			$sql = "INSERT INTO BOT_RPG_FIGHT VALUES (null, ?, ?, CURRENT_TIMESTAMP, 0, ?, ?)";
			$sql = Database()->prepare($sql);
			$sql->bind_param('iiii', $utenteId, $tipoFightId, $sottoluogoId, $maxUtenti);
			$sql->execute();

			$className = 'Fight'.$tipoFightId;
			return new $className($sql->insert_id);
		}

		public function startPVE(){
			
		}

		public function initialize(){
			$Utenti = $this->getUtenti();

			$sl = $this->getSottoluogo();

			foreach($Utenti as $ut){
				$ut->doSendFinalMessage(FALSE);

				$sl->spawn($ut);

				if($ut->areThereMobs()){
					$ut->spawnPet();
					//setKey(kBattle());
					$ut->setUtenteStatoId(3);
					$msg = 'Ecco le Rogne!'."\n";
					$msg .= Functions::drawMap($ut);
					$ut->sendMessage($msg, kBattle());
				}else{
					$ut->sendMessage("Non hai trovato rogne.\n");
				}

			}
		}

		public function isTurnOfUtente(){
			$sql = "SELECT IS_TURNO FROM BOT_RPG_FIGHT_UTENTE WHERE UTENTE_ID = ? AND FIGHT_ID = ?";
			$sql = Database()->prepare($sql);
			$sql->bind_param('ii', $this->getUtente()->getId(), $this->getData('ID'));
			$res = $sql->execute();

			if($res->num_rows == 0)
				return FALSE;

			if($res->fetch_object()->IS_TURNO == 1)
				return true;
			else
				return false;
		}

		public function flow(){
			$ut = $this->getUtente();

			$ut->sendMessage($ut->getTargetMobId());

			if(!$this->isTurnOfUtente()){
				write('Non è il tuo turno!');
				return false;
			}

			if($ut->hasUsedSkill())
				$res = $ut->useSkill($mobId, $tipoMobId);
	
			if($ut->hasMoved() && $ut->movedDirection() !== null)
				$res = $ut->walk($ut->movedDirection());
	
			if($res == 0)
				$ut->battleFlow();
	
			if(!$ut->areThereMobs()){
				$ut->battleRecap();
				$ut->clearAllMobHere();
				setKey(kMenuPrincipale());
				$ut->setUtenteStatoId(0);
			}
		}



}