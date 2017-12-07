<?php
	Class Sottoluogo extends Luogo{
		private $sottoluogoId;
		private $sottoluogoNome;
		private $sottoluogoDesc;
		
		private $luogo_id;
		
		public function __construct($SOTTOLUOGO_ID){
			$this->getDB();
			$q = "SELECT * FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_ID = ". $SOTTOLUOGO_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			
			$this->sottoluogoId 	= $row->SOTTOLUOGO_ID;
			$this->luogo_id 		= $row->SOTTOLUOGO_LUOGO_ID;
			$this->sottoluogoNome 	= $row->SOTTOLUOGO_NOME;
			$this->sottoluogoDesc 	= $row->SOTTOLUOGO_DESC;
			
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
		
		public function spawnMob($mob){
			
		}
	}