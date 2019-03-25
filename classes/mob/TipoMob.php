<?php
	class TipoMob extends Creatura{
		protected $tipoMobId;
		protected $tipoMobNome;
		protected $tipoMobDesc;
		protected $tipoMobExp;
		protected $tipoMobSoldi;
		protected $tipoMobImgPath;

		protected $entitaId = 1;

		protected $db;

		private $tableName = 'BOT_RPG_TIPO_MOB';

		public function __construct($id){
			//global $con;
			$this->db = Database();

			$q = "SELECT * FROM ". $this->tableName ." WHERE TIPO_MOB_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$this->tipoMobId					=	$row->TIPO_MOB_ID;
			$this->tipoMobNome                  =	$row->TIPO_MOB_NOME;
			$this->tipoMobDesc                  =	$row->TIPO_MOB_DESC;
			$this->tipoMobExp                   =	$row->TIPO_MOB_EXP;
			$this->tipoMobSoldi                 =	$row->TIPO_MOB_SOLDI;
			$this->tipoMobImgPath               =	$row->TIPO_MOB_IMGPATH;
			$this->tipoMobCategoria				= 	$row->TIPO_MOB_CATEGORIA_TIPO_MOB_ID;
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

		public function getArrayOfTipoMobLearnedSkillsId(){
			$q = "SELECT SKILL_ID FROM BOT_RPG_SKILL_TIPO_MOB WHERE TIPO_MOB_ID = ".$this->getTipoMobId();
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$data[] = $row->SKILL_ID;
			}
			return $data;
		}

		public function getStatFromTipoMob($statId){
			if(isset($this->arrStat[$statId]['tipoMob']))
				return $this->arrStat[$statId]['tipoMob'];

			$q = "SELECT VALUE, VALUE_XLVL FROM BOT_RPG_STAT_TIPO_MOB WHERE TIPO_MOB_ID = ".$this->getTipoMobId()." AND STAT_ID = ".$statId;
			$res = $this->db->query($q);
			if($res->num_rows == 0) return 0;
			$row = $res->fetch_object();
			$data = array();
			$data['VALUE'] = $row->VALUE;
			$data['VALUE_XLVL'] = $row->VALUE_XLVL;
			$this->arrStat[$statId]['tipoMob'] = $row->VALUE + ($row->VALUE_XLVL * $this->getMobLevel());
			return $this->arrStat[$statId]['tipoMob'];
			//return $data;
		}

		public function printStats(){
			$str = '';
			$sql = "SELECT STAT_ID, STAT_NOME FROM BOT_RPG_STAT";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$stat = $this->getStatFromTipoMob($row->STAT_ID);
				if($stat['VALUE'] != ''){
					$str .= '<b>'.strtoupper($row->STAT_NOME).'</b>:'."\n";
					$str .= 'BASE: '.$stat['VALUE']."\n";
					$str .= 'XLVL: '.$stat['VALUE_XLVL']."\n";
					$str .= "\n";
				}
			}
			return $str;
		}

		public function getRandTipoMobFrase(){
			$q = "SELECT FRASE_TESTO
				  FROM BOT_RPG_FRASE_TIPO_MOB FTM, BOT_RPG_FRASE F
				  WHERE TIPO_MOB_ID = ".$this->getTipoMobId().
				" AND FTM.FRASE_ID = F.FRASE_ID
				  ORDER BY RAND()
				  LIMIT 1";
			$res = $this->db->query($q);
			if($res->num_rows == 0) return "...";
			$row = $res->fetch_object();
			return $row->FRASE_TESTO;
		}

		public function getArrayOfSottoluogoSpawnId(){
			$q = "SELECT SOTTOLUOGO_ID FROM BOT_RPG_MOB_SPAWN WHERE TIPO_MOB_ID = ".$this->getTipoMobId();
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$data[] = $row->SKILL_ID;
			}
			return $data;
		}

		public function getCategoria(){
			return $this->tipoMobCategoria;
		}

	}
