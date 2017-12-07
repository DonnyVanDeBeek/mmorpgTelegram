<?php
	Class Classe{
		protected $classeId;
		protected $classeNome;
		protected $classeDesc;
		protected $classeForza;
		protected $classeIntelligenza;
		protected $classeSaggezza;
		protected $classeCarisma;
		protected $classeDestrezza;
		protected $classeCostituzione;
		protected $classeHp;

		protected $db;

		private $tableName = 'BOT_RPG_CLASSE';

		public function __construct($id){
			global $con;
			$this->db = &$con->getDB();

			$q = "SELECT * FROM ".$this->tableName." WHERE CLASSE_ID = ".$id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->classeId             = $row->CLASSE_ID;
			$this->classeNome           = $row->CLASSE_NOME;
			$this->classeDesc           = $row->CLASSE_DESC;
			$this->classeForza          = $row->CLASSE_FORZA;
			$this->classeIntelligenza   = $row->CLASSE_INTELLIGENZA;
			$this->classeSaggezza       = $row->CLASSE_SAGGEZZA;
			$this->classeCarisma        = $row->CLASSE_CARISMA;
			$this->classeDestrezza      = $row->CLASSE_DESTREZZA;
			$this->classeCostituzione   = $row->CLASSE_COSTITUZIONE;
			$this->classeHp				= $row->CLASSE_HP;
		}

		public function getClasseId(){
			return $this->classeId;
		}

		public function getClasseNome(){
			return $this->classeNome;
		}

		public function getClasseDesc(){
			return $this->classeDesc;
		}

		public function getClasseForza(){
			return $this->classeForza;
		}

		public function getClasseIntelligenza(){
			return $this->classeCarisma;
		}

		public function getClasseCostituzione(){
			return $this->classeCostituzione;
		}

		public function getClasseDestrezza(){
			return $this->classeDestrezza;
		}

		public function getClasseCarisma(){
			return $this->classeCarisma;
		}

		public function getClasseSaggezza(){
			return $this->classeSaggezza;
		}

		public function getClasseHp(){
			return $this->classeHp;
		}
	}
