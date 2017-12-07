<?php
	Class Mob extends TipoMob{
		protected $mobId;
		protected $mobTipoMobId;
		protected $mobSottluogoId;
		protected $mobLevel;
		protected $mobUtenteId;
		protected $mobHp;
		protected $mobNomeProprio;

		private $tableName = 'BOT_RPG_MOB';

		protected $db;

		public function __construct($id){
			global $con;
			$this->db = &$con->getDB();

			$q = "SELECT * FROM ". $this->tableName ." WHERE MOB_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->mobId 			= $row->MOB_ID;
			$this->mobTipoMobId 	= $row->MOB_TIPO_MOB_ID;
			$this->mobLevel		    = $row->MOB_LIVELLO;
			$this->mobUtenteId 		= $row->MOB_UTENTE_ID;
			$this->mobHp 			= $row->MOB_HP;
			$this->mobSottluogoId 	= $row->MOB_SOTTOLUOGO_ID;
			$this->mobNomeProprio   = $row->MOB_NOME_PROPRIO;

			parent::__construct($this->mobTipoMobId);

		}

		//Getters
		public function getTotalStat($stat){
			$st = $this->{'getTipoMob'.ucfirst(strtoupper($stat))}();
			$stx = $this->{'getTipoMob'.ucfirst(strtoupper($stat)).'XLivello'}();
			$tot = $st + ($stx * $this->mobLevel);
			return $tot;
		}

		public function subisciDanno($dealer, $dmg){
			//$dmg = $dmg - $this->getTotalStat('COSTITUZIONE');
			$perc = log($this->getTotalStat('COSTITUZIONE'), 100000) * 100;
			$dmg = intVal($dmg * ((100 - $perc) / 100));
			if($dmg < 0) $dmg = 1;
			$this->setMobHp($this->getMobHp() - $dmg);
			return $dmg;
		}

		public function getMobHp(){
			return $this->mobHp;
		}

		public function getMobNomeProprio(){
			return $this->mobNomeProprio;
		}

		public function setMobHp($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_HP = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobHp = $a;
		}

		public function getMobLevel(){
			return $this->mobLevel;
		}

		public function getMobSottoluogoId(){
			return $this->mobSottluogoId;
		}

		public function getMobTipoMobId(){
			return $this->mobTipoMobId;
		}

		public function attacca($ut){
			$dmg = $ut->subisciDanno($this, $this->getTotalStat('FORZA'));
			return $dmg;
		}

		function getHowManyDroppableItems(){

		}


	}
