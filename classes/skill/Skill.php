<?php
	//GUIDA
	//Se la skill prevede un danno, è necessario istanziare un nuovo oggetto Danno del tipo:
	//$da = new Danno();
	//Con i seguenti Metodi
	//setDmg(int) imposta il danno della skill
	//setDealer(OBJ) imposta colui che manda il danno, la classe dell'oggetto passato
	//come paramentro deve ereditare da dalla classe Utente. Di consuetudine si passerà
	//$this->caster come paramentro, ma potrebbero esserci delle eccezioni, seppur rare
	//setTipo(String) imposta il tipo del tanno che verrà applicato (Fisico, Magico, Puro...)
	//setElemento(String) imposta l'elemento della skill (Fuoco, Elettricita, Acqua, Aria...)
	//setDistanza(Int) la distanza tra i due
	//setVelocita(Int) la velocità della skill

	Class Skill{
		private $skillId;
		private $skillPA;
		private $skillDesc;
		private $skillNome;
		private $skillRange;
		private $skillCooldown;
		private $skillTargetRequired;
		private $skillLivelloSblocco;

		private $caster;
		private $target;
		//private $skillRange;
		private $skillRangeMin;

		protected $msg = array();

		protected $Equips = array();
		protected $categorieEquips = array();

		private $db;

		private $tableName = 'BOT_RPG_SKILL';

		public function __construct($id){
			//global $con;
			$this->db = Database();

			$q = "SELECT * FROM ".$this->tableName." WHERE SKILL_ID = ".$id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->skillId             = $row->SKILL_ID;
			$this->skillPA 			   = $row->SKILL_PA;
			$this->skillNome           = $row->SKILL_NOME;
			$this->skillDesc           = $row->SKILL_DESC;
			$this->skillCooldown       = $row->SKILL_COOLDOWN_TURNI;
			$this->skillTargetRequired = $row->SKILL_TARGET_REQUIRED;
			$this->skillLivelloSblocco = $row->SKILL_LIVELLO_SBLOCCO;
			$this->skillRange 		   = $row->SKILL_RANGE;
			$this->skillRangeMin	   = $row->SKILL_RANGE_MIN;

			$this->target = null;
		}

		public function getCooldown(){
			return $this->skillCooldown;
		}

		public function setCooldown(int $a){
			$this->skillCooldown = $a;
		}

		public function equipBuff(&$Danno){
			/*
			$Equips = $this->Equips;
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->buff($Danno);
				$Equips[$i]->buffCustom($Danno);
			}
			*/
		}

		public function overtimeBuff(&$Danno){
			/*
			$Overtimes = $this->Overtimes;
			$n = count($Overtimes);
			for($i = 0; $i < $n; $i++){
				$Overtimes[$i]->buff($Danno, $this->getTarget());
			}
			*/
		}

		public function equipOnAttack(){
			/*
			$Equips = $this->Equips;
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->onAttack($this->getTarget());
			}
			*/
		}

		public function getEquips(){
			return $this->Equips;
		}

		public function insertCooldown(){
			$n = $this->getCooldown();
			$cid = $this->caster->getId();
			$sid = $this->skillId;
			$eid = $this->caster->getEntitaId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_COOLDOWN_SKILL VALUES($cid, $sid, $eid, $n)";
			Database()->query($sql);
		}

		public function startCooldown($n){
			/*
			$cid = $this->caster->getId();
			$sid = $this->skillId;
			$eid = $this->caster->getEntitaId();
			$sql = "INSERT INTO BOT_RPG_UTENTE_COOLDOWN_SKILL VALUES($cid, $sid, $eid, $n)";
			Database()->query($sql);
			*/
		}

		public function loadEquips(){
			$sql = "SELECT CATEGORIA_EQUIP_NOME FROM BOT_RPG_SKILL_CATEGORIA_EQUIP AS SCE, BOT_RPG_CATEGORIA_EQUIP AS CE WHERE CE.CATEGORIA_EQUIP_ID = SCE.CATEGORIA_EQUIP_ID AND SKILL_ID = ".$this->getSkillId();
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$this->categorieEquips[] = $row->CATEGORIA_EQUIP_NOME;
			}

			$this->caster->loadEquips();
			$this->Equips = $this->caster->getEquipsOfCategorie($this->categorieEquips);
		}

		public function loadOvertimes(){
			unset($this->Overtimes);
			$this->Overtimes = $this->caster->getOverTimes();
		}

		//GETTERS
		public function getSkillPA(){
			return $this->skillPA;
		}

		public function getSkillId(){
			return $this->skillId;
		}

		public function getSkillNome(){
			return $this->skillNome;
		}

		public function getSkillCooldown(){
			return $this->skillCooldown;
		}

		public function getSkillLivelloSblocco(){
			return $this->skillLivelloSblocco;
		}

		public function getSkillDesc(){
			return $this->skillDesc;
		}

		public function getSkillTargetRequired(){
			return $this->skillTargetRequired;
		}

		public function getSkillRange(){
			return $this->skillRange;
		}

		public function getSkillRangeMin(){
			return $this->skillRangeMin;
		}

		public function setTarget(&$a){
			$this->target = $a;
		}

		public function setCaster(&$a){
			$this->caster = $a;
		}

		public function getTarget(){
			return $this->target;
		}

		public function getCaster(){
			return $this->caster;
		}

		public function getReadyToBeTriggered(){
			if($this->trigger()){
				$this->insertCooldown();
				return true;
			}

			return false;
		}

		public function trigger(){
			//$this->caster = $caster;
			//$this->target = $target;
			//return $this->{'S'.$this->skillId}();
		}

		public function getMobClass($MobId){
			$id = $MobId;
			$Mob = new Mob($id);
			$className = 'Mob'.$Mob->getTipoMobId();
			if(class_exists($className)){
				$Mob = new $className($id);
			}
			else{
				$Mob = new Mob($id);
			}
			return $Mob;
		}

		public function getErr($e){
			switch($e){
				case 'PA':
					$err = 'PA non sufficenti.';
				break;

				case 'NO_TARGET':
					$err = 'Questa skill ha bisogno di un target.';
				break;

				case 'LEVEL':
					$err = 'Il tuo livello non è abbastanza alto.';
				break;

				case 'DISTANCE':
					$err = 'Sei troppo lontano dal bersaglio!';
				break;

				case 'EQUIP':
					$err = 'Non hai l\'equipaggiamento giusto per lanciare questa skill'."\n\n";
					$err = 'Dovresti equipaggiare un equip che faccia parte delle seguenti categorie:'."\n\n";
					$arr = $this->categorieEquips;
					$n = count($arr);
					for($i = 0; $i < $n; $i++){
						$err .= '<b>'.$arr[$i].'</b>'."\n";
					}

					/*
					$arr = $this->caster->getOBJEquips();
					$n = count($arr);
					for($i = 0; $i < $n; $i++){
						$err .= $arr[$i]->getTipoEquipId()."\n";
					}
					*/
				break;

				case 'UNLOCK':
					$err = 'Non hai ancora sbloccato questa skill!';
				break;

				case 'MIN_DISTANCE':
					$err = "Sei troppo vicino al bersaglio per lanciare questa skill!";
				break;

				case 'COOLDOWN':
					$err = 'Questa skill è in cooldown per ancora '.$this->getTurniCooldown().' turni';
				break;

				default:
					$err = 'Impossibile lanciare la skill';
			}

			return $err . "\n";
		}

		public function getMsg($string){
			return $this->msg[$string];
		}

		public function targetExists(){
			if(is_null($this->target))
				return false;
			else
				return true;
		}

		public function checkEquips(){
			if($this->caster->getEntitaId() == 1) return true;
			$arr = $this->Equips;
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				//$this->caster->sendMessage($arr[$i]->getTipoEquipCategoriaNome().'dd');
				if($this->caster->hasEquipped($arr[$i]->getTipoEquipCategoriaNome()))
					return true;
			}
			if(count($this->categorieEquips) == 0)
				return true;
			else
				return false;
		}

		public function casterHasEnoughPA(){
			if($this->caster->getPA() < $this->getSkillPA())
				return false;
			else
				return true;
		}

		public function casterLevelIsEnough(){
			if($this->caster->getLevel() < $this->getSkillLivelloSblocco())
				return false;
			else
				return true;
		}

		public function targetIsInRange(){
			if($this->caster->getDistanceFrom($this->target) > $this->skillRange)
				return false;
			else
				return true;
		}

		public function targetIsInRangeMin(){
			if($this->caster->getDistanceFrom($this->target) >= $this->skillRangeMin)
				return true;
			else
				return false;
		}

		public function casterHasUnlocked(){
			if($this->caster->hasUnlockedSkill($this->getSkillId()))
				return true;
			else
				return false;
		}

		public function getTurniCooldown(){
			$casterId = $this->caster->getId();
			$entitaId = $this->caster->getEntitaId();
			$skillId = $this->skillId;
			$sql = "SELECT COOLDOWN_TURNI FROM BOT_RPG_UTENTE_COOLDOWN_SKILL WHERE COOLDOWN_UTENTE_ID = $casterId AND COOLDOWN_SKILL_ID = $skillId AND COOLDOWN_ENTITA_ID = $entitaId AND COOLDOWN_TURNI > 0";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->COOLDOWN_TURNI;
		}

		public function isInCooldown(){
			$casterId = $this->caster->getId();
			$entitaId = $this->caster->getEntitaId();
			$skillId = $this->skillId;
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE_COOLDOWN_SKILL WHERE COOLDOWN_UTENTE_ID = $casterId AND COOLDOWN_SKILL_ID = $skillId AND COOLDOWN_ENTITA_ID = $entitaId AND COOLDOWN_TURNI > 0";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function check(){
			if($this->getSkillTargetRequired() == 1){
				if(!$this->targetExists())		return false;
				if(!$this->targetIsInRange()) 	return false;
				if(!$this->targetIsInRangeMin())return false;
			}

			if($this->isInCooldown())			return false;
			if(!$this->casterHasUnlocked())		return false;
			if(!$this->checkEquips())			return false;
			//if(!$this->casterHasEnoughPA()) 	return false;
			if(!$this->casterLevelIsEnough()) 	return false;
			return true;
		}

		public function findErr(){
			if(!$this->casterHasUnlocked())		return $this->getErr('UNLOCK');

			if($this->getSkillTargetRequired() == 1){
				if(!$this->targetExists())		return $this->getErr('NO_TARGET');;
				if(!$this->targetIsInRange()) 	return $this->getErr('DISTANCE');
				if(!$this->targetIsInRangeMin())return $this->getErr('MIN_DISTANCE');
			}

			if($this->isInCooldown())			return $this->getErr('COOLDOWN');
			//if(!$this->casterHasEnoughPA()) 	return $this->getErr('PA');
			if(!$this->checkEquips())			return $this->getErr('EQUIP');
			if(!$this->casterLevelIsEnough()) 	return $this->getErr('LEVEL');

			return $this->getErr('DEFAULT');
		}

		public function getFrase($id){
			$skillId = $this->getSkillId();
			$sql = "SELECT FRASE_TESTO FROM BOT_RPG_SKILL_FRASE WHERE SKILL_ID = $skillId AND FRASE_ID = $id";
			$res = Database()->query($sql);
			if($res == 0)
				return "Frase Skill Mancante";
			$row = $res->fetch_object();
			return $this->filterFrase($row->FRASE_TESTO)."\n";
		}

		public function filterFrase($frase){
			$Caster = &$this->getCaster();
			$Target = &$this->getTarget();

			$frase = str_replace('_caster:nome_', $Caster->getNome(), $frase);
			$frase = str_replace('_target:nome_', $Target->getNome(), $frase);

			return $frase;
		}

		public function getVar($id){
			$skillId = $this->getSkillId();
			$sql = "SELECT VARIABLE_VALUE FROM BOT_RPG_SKILL_VARIABLE WHERE SKILL_ID = $skillId AND VARIABLE_ID = $id";
			$res = Database()->query($sql);
			if($res == 0){
				write("Variabile Skill Mancante");
				return 0;
			}
			$row = $res->fetch_object();
			return $row->VARIABLE_VALUE;
		}

		public function chose(){
			
		}

		public function loadVars(){

		}

		public function addFrase($id, $nome, $desc, $testo){
			$skillId = $this->getSkillId();
			$sql = "INSERT INTO BOT_RPG_SKILL_FRASE VALUES ($id, $skillId, '$nome', '$desc', '$testo')";
			Database()->query($sql);
		}

		public function addVar($id, $nome, $desc, $val){
			$skillId = $this->getSkillId();
			$sql = "INSERT INTO BOT_RPG_SKILL_VARIABLE VALUES ($skillId, $id, '$nome', '$desc', $val)";
			Database()->query($sql);
		}

	}
