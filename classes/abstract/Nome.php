<?php
	Class Nome{
		private $nomeId;
		private $nomeNome;
		
		private $tableName = 'BOT_RPG_NOME';
		
		private $db;
		
		public function __construct($id){
			global $con;
			$this->db = $con->getDB();
			
			$q = "SELECT * FROM ".$this->tableName." WHERE NOME_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			
			$this->nomeId 	= $row->NOME_ID;
			$this->nomeNome	= $row->NOME_NOME;
		}
		
		public function getNomeId(){
			return $this->nomeId;
		}
		
		public function getNomeNome(){
			return $this->nomeNome;
		}
	}