<?php
	class OverTime extends TipoOverTime{
		private $overTimeId;
		private $tipoOverTimeId;
		private $numeroTurni;
		private $value;
		private $targetId;

		private $tipoOverTime = 'null';

		private $cancelled = false;

		protected $Target;

		public function __construct($id = null, $entitaId = null){
			if($id === null) return 0;

			$sql = "SELECT * FROM BOT_RPG_OVERTIME WHERE OVERTIME_ID = $id AND ENTITA_ID = ".$entitaId;
			$res = Database()->query($sql);
			$row = $res->fetch_object();

			parent::__construct($row->TIPO_OVERTIME_ID);

			$this->setOverTimeId($row->OVERTIME_ID);
			$this->setTargetId($row->TARGET_ID);
			$this->setTipoOverTimeId($row->TIPO_OVERTIME_ID);
			$this->setNumTurni($row->NUM_TURNI);
			$this->setEntitaId($row->ENTITA_ID);
			$this->setValue($row->VALUE);
		}

		public function send(){
			$sql = "SELECT MAX(OVERTIME_ID) + 1 AS ID FROM BOT_RPG_OVERTIME";
			$maxId = Database()->query($sql)->fetch_object()->ID;

			if($this->getTipoOverTime() !== 'null'){
				$id = $this->getTipoOvertimeIdByName($this->getTipoOverTime());
				$sql = "SELECT TIPO_OVERTIME_NOME FROM BOT_RPG_TIPO_OVERTIME WHERE TIPO_OVERTIME_ID = ".$id;
				$row = Database()->query($sql)->fetch_object();
				$tipoOverTimeNome = $row->TIPO_OVERTIME_NOME;
			}
			else{
				$id = $this->getTipoOverTimeId();
				$tipoOverTimeNome = Functions::getOvertimeNomeById($id);
			}

			$this->setTipoOverTimeId($id);

			$this->Target->triggerOverTimeDealWithOverTime($this);
			$this->Target->dealWithOverTime($this); //da fare anche per i buff

			if($this->cancelled){
				return false;
			}

			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getTarget()->getId()." AND TIPO_OVERTIME_ID = $id AND ENTITA_ID = ".$this->getTarget()->getEntitaId();
			if(Database()->query($sql)->fetch_object()->C > 0){
				$sql = "SELECT VALUE, NUM_TURNI FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getTarget()->getId()." AND TIPO_OVERTIME_ID = $id AND ENTITA_ID = ".$this->getTarget()->getEntitaId();
				$res = Database()->query($sql);
				$row = $res->fetch_object();
				$newValue = $row->VALUE > $this->getValue() ? $row->VALUE : $this->getValue();

				$turni = $row->NUM_TURNI + $this->getNumTurni();
				$sql = "UPDATE BOT_RPG_OVERTIME SET VALUE = $newValue, NUM_TURNI = NUM_TURNI + ".$this->getNumTurni()." WHERE TARGET_ID = ".$this->getTarget()->getId()." AND TIPO_OVERTIME_ID = $id AND ENTITA_ID = ".$this->getTarget()->getEntitaId();
				//write('Lo stato <b>'.$tipoOverTimeNome.'</b> di '.$this->Target->getNome().' aumenta la sua durata di '.$this->getNumTurni().' turni per un totale di '.$turni.'!'."\n");
				write($this->Target->getNome().' -> <b>'. $tipoOverTimeNome ."(".$this->getNumTurni().")".'</b>');
			}else{
				$sql = "INSERT INTO BOT_RPG_OVERTIME 
						VALUES($maxId, ".
							$id.", ".
							$this->getTarget()->getId().", ".
							$this->getTarget()->getEntitaId().", ".
							$this->getNumTurni().", ".
							$this->getValue()."
						)";
				//write($this->Target->getNome() . ' subisce <b>'. $tipoOverTimeNome ."</b> per ".$this->getNumTurni()." turni!\n");
				write($this->Target->getNome().' -> <b>'. $tipoOverTimeNome ."(".$this->getNumTurni().")".'</b>');
			}
			Database()->query($sql);
		}

		public function trigger(){

		}

		public function buff(Danno &$Danno){

		}

		public function debuff(Danno &$Danno){
			
		}

		public function preTrigger(){
			
		}

		public function dealWithOverTime(OverTime &$OverTime){

		}

		public function getTipoOvertimeIdByName($name){
			$sql = "SELECT TIPO_OVERTIME_ID FROM BOT_RPG_TIPO_OVERTIME WHERE LOWER(TIPO_OVERTIME_NOME) = '".strtolower($name)."'";
			return Database()->query($sql)->fetch_object()->TIPO_OVERTIME_ID;
		}

		public function getOverTimeId(){
			return $this->overTimeId;
		}

		public function getTarget(){
			return $this->Target;
		}

		public function getTargetId(){
			return $this->targetId;
		}

		public function getTipoOverTimeId(){
			return $this->tipoOverTimeId;
		}

		public function getTipoOverTime(){
			return $this->tipoOverTime;
		}

		public function getNumTurni(){
			return $this->numTurni;
		}

		public function getValue(){
			return $this->value;
		}

		public function setTargetId($a){
			$this->targetId = $a;
		}

		public function setTarget(&$a){
			$this->Target = $a;
		}

		public function setEntitaId($a){
			$this->entitaId = $a;
		}

		public function setNumTurni($a){
			$this->numTurni = $a;
		}

		public function setTurni($a){
			$this->numTurni = $a;
		}

		public function setValue($a){
			$this->value = $a;
		}

		public function setOverTimeId($a){
			$this->overTimeId = $a;
		}

		public function setTipoOverTimeId($a){
			$this->tipoOverTimeId = $a;
		}

		public function setTipoOverTime($a){
			$this->tipoOverTime = $a;
		}

		public function diminuisciTurni($turni = 1){
			$this->setNumTurni($this->getNumTurni() - $turni);
			$sql = "UPDATE BOT_RPG_OVERTIME SET NUM_TURNI = NUM_TURNI - $turni WHERE OVERTIME_ID = ".$this->getOverTimeId();
			Database()->query($sql);
		}

		public function cancel(){
			$this->cancelled = true;
		}

		public function create(&$Target, $id, $val, $turni){
			$OT = new OverTime();
			$OT->setTipoOverTimeId($id);
			$OT->setValue($val);
			$OT->setNumTurni($turni);
			$OT->setTarget($Target);
			return $OT;
		}



		
	}