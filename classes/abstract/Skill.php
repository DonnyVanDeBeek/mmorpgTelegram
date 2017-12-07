<?php
	Class Skill{
		private $skillId;
		private $skillNome;
		private $skillClasseId;
		private $skillDesc;
		private $skillCooldown;
		private $skillLivelloSblocco;
		private $skillNum;
		
		private $db;
		
		private $tableName = 'BOT_RPG_SKILL';
		
		public function __construct($nomeSkill){
			global $con;
			$this->db = $con->getDB();
			
			$this->skillNome = $nomeSkill;
			if($this->doesExist()){
				$q = "SELECT * FROM ".$this->tableName." WHERE SKILL_ID = ".$this->getIdByThisName();
				$res = $this->db->query($q);
				$row = $res->fetch_object();
				
				$this->skillId             = $row->SKILL_ID;
				$this->skillNome           = $row->SKILL_NOME;
				$this->skillClasseId       = $row->SKILL_CLASSE_ID;
				$this->skillDesc           = $row->SKILL_DESC;
				$this->skillCooldown       = $row->SKILL_COOLDOWN_SECOND;
				$this->skillLivelloSblocco = $row->SKILL_LIVELLO_SBLOCCO;
				$this->skillNum            = $row->SKILL_NUM;
			}
		}
		
		//GETTERS
		public function getSkillId(){
			return $this->skillId;
		}
		
		public function getSkillNome(){
			return $this->skillNome;
		}
		
		public function getSkillClasseId(){
			return $this->skillClasseId;
		}
		
		public function getSkillCooldown(){
			return $this->skillCooldown;
		}
		
		public function getSkillLivelloSblocco(){
			return $this->skillLivelloSblocco;
		}
		
		public function getSkillNum(){
			return $this->skillNum;
		}
		
		public function getSkillDesc(){
			return $this->skillDesc;
		}
		
		//Functiions
		public function doesExist(){
			$q = "SELECT COUNT(*) AS C FROM ".$this->tableName." WHERE SKILL_NOME = '".$this->skillNome."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}
		
		public function getIdByThisName(){
			$q = "SELECT SKILL_ID FROM ".$this->tableName." WHERE SKILL_NOME = '".$this->skillNome."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->SKILL_ID;
		}
	}