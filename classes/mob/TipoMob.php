<?php
	class TipoMob{
		protected $tipoMobId;
		protected $tipoMobNome;
		protected $tipoMobDesc;
		protected $tipoMobExp;
		protected $tipoMobSoldi;
		protected $tipoMobImgPath;
		protected $tipoMobForza;
		protected $tipoMobSaggezza;
		protected $tipoMobIntelligenza;
		protected $tipoMobCostituzione;
		protected $tipoMobDestrezza;
		protected $tipoMobCarisma;
		protected $tipoMobHp;
		protected $tipoMobHpXLivello;
		protected $tipoMobForzaXLivello;
		protected $tipoMobIntelligenzaXLivello;
		protected $tipoMobCostituzioneXLivello;
		protected $tipoMobDestrezzaXLivello;
		protected $tipoMobSaggezzaXLivello;
		protected $tipoMobCarismaXLivello;

		protected $db;

		private $tableName = 'BOT_RPG_TIPO_MOB';

		public function __construct($id){
			global $con;
			$this->db = &$con->getDB();

			$q = "SELECT * FROM ". $this->tableName ." WHERE TIPO_MOB_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->tipoMobId					=	$row->TIPO_MOB_ID;
			$this->tipoMobNome                  =	$row->TIPO_MOB_NOME;
			$this->tipoMobDesc                  =	$row->TIPO_MOB_DESC;
			$this->tipoMobExp                   =	$row->TIPO_MOB_EXP;
			$this->tipoMobSoldi                 =	$row->TIPO_MOB_SOLDI;
			$this->tipoMobImgPath               =	$row->TIPO_MOB_IMGPATH;
			$this->tipoMobForza                 =	$row->TIPO_MOB_FORZA;
			$this->tipoMobSaggezza              =	$row->TIPO_MOB_SAGGEZZA;
			$this->tipoMobIntelligenza          =	$row->TIPO_MOB_INTELLIGENZA;
			$this->tipoMobCostituzione          =	$row->TIPO_MOB_COSTITUZIONE;
			$this->tipoMobDestrezza             =	$row->TIPO_MOB_DESTREZZA;
			$this->tipoMobCarisma               =	$row->TIPO_MOB_CARISMA;
			$this->tipoMobHp                    =	$row->TIPO_MOB_HP;
			$this->tipoMobHpXLivello            =	$row->TIPO_MOB_HP_XLIVELLO;
			$this->tipoMobForzaXLivello         =	$row->TIPO_MOB_FORZA_XLIVELLO;
			$this->tipoMobIntelligenzaXLivello  =	$row->TIPO_MOB_INTELLIGENZA_XLIVELLO;
			$this->tipoMobCostituzioneXLivello  =	$row->TIPO_MOB_COSTITUZIONE_XLIVELLO;
			$this->tipoMobDestrezzaXLivello     =	$row->TIPO_MOB_DESTREZZA_XLIVELLO;
			$this->tipoMobSaggezzaXLivello      =	$row->TIPO_MOB_SAGGEZZA_XLIVELLO;
			$this->tipoMobCarismaXLivello       =	$row->TIPO_MOB_CARISMA_XLIVELLO;
		}

		public function getNome(){
			return $this->tipoMobNome;
		}

		public function getTipoMobId(){
			return $this->tipoMobId;
		}

		public function getTipoMobNome(){
			return $this->tipoMobNome;
		}

		public function getTipoMobDesc(){
			return $this->tipoMobDesc;
		}

		public function getTipoMobExp(){
			return $this->tipoMobExp;
		}

		public function getTipoMobSoldi(){
			return $this->tipoMobSoldi;
		}

		public function getTipoMobImgPath(){
			return $this->tipoMobImgPath;
		}

		public function getTipoMobForza(){
			return $this->tipoMobForza;
		}

		public function getTipoMobForzaXLivello(){
			return $this->tipoMobForzaXLivello;
		}

		public function getTipoMobIntelligenza(){
			return $this->tipoMobIntelligenzaXLivello;
		}

		public function getTipoMobIntelligenzaXLivello(){
			return $this->tipoMobIntelligenzaXLivello;
		}

		public function getTipoMobSaggezza(){
			return $this->tipoMobSaggezza;
		}

		public function getTipoMobSaggezzaXLivello(){
			return $this->tipoMobSaggezzaXLivello;
		}

		public function getTipoMobDestrezza(){
			return $this->tipoMobDestrezza;
		}

		public function getTipoMobDestrezzaXLivello(){
			return $this->tipoMob;
		}

		public function getTipoMobCostituzione(){
			return $this->tipoMobCostituzione;
		}

		public function getTipoMobCostituzioneXLivello(){
			return $this->tipoMobCostituzioneXLivello;
		}

		public function getTipoMobCarisma(){
			return $this->tipoMobCarisma;
		}

		public function getTipoMobCarismaXLivello(){
			return $this->tipoMobCarismaXLivello;
		}

		public function getTipoMobHp(){
			return $this->tipoMobHp;
		}

		public function getTipoMobHpXLivello(){
			return $this->tipoMobHpXLivello;
		}

	}
