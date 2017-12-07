<?php
	Class Buff extends Database{
		private $buffato_id;
		private $forza;
		private $costituzione;
		private $intelligenza;
		private $saggezza;
		private $destreza;
		private $carisma;
		private $buffatore_id;
		private $timeActive;
		private $timeTurnBased;
		private $skill_id;
		
		public function __construct($buffatore, $buffato){
			$this->getDB();
			$this->buffato_id = $buffato;
			$this->buffatore_id = $buffatore;
			$this->forza = 0;
			$this->costituzione = 0;
			$this->intelligenza = 0;
			$this->saggezza = 0;
			$this->destrezza = 0;
			$this->carisma = 0;
			$this->timeActive = 0;
			$this->timeTurnBased = 0;
			$this->skill_id = 0;
		}
		
		public function send(){
			$q = "
				INSERT INTO BOT_RPG_BUFF 
				VALUES
				(".
					$this->buffato_id.", ".
					$this->buffatore_id.",
					DATE_ADD(NOW(), INTERVAL ".$this->timeActive." SECOND), ".
					$this->timeTurnBased.", ".
					$this->forza.", ".
					$this->saggezza.", ".
					$this->intelligenza.", ".
					$this->costituzione.", ".
					$this->destrezza.", ".
					$this->carisma.", ".
					$this->skill_id."
				)";
			$res = $this->db->query($q);
		}
		
		public function setForza($a){
			$this->forza = $a;
		}
		
		public function setCostituzione($a){
			$this->costituzione = $a;
		}
		
		public function setIntelligenza($a){
			$this->intelligenza = $a;
		}
		
		public function setSaggezza($a){
			$this->forza = $a;
		}
		
		public function setDestrezza($a){
			$this->forza = $a;
		}
		
		public function setCarisma($a){
			$this->forza = $a;
		}
		
		public function setTimeActive($a){
			$this->timeActive = $a;
		}
		
		public function setTimeTurnBased($a){
			$this->timeTurnBased = $a;
		}
		
		public function setSkillId($a){
			$this->skill_id = $a;
		}
		
	}