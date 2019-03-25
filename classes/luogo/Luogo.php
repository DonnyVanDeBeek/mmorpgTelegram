<?php
	Class Luogo{
		protected $luogoId;
		protected $luogoNome;
		protected $luogoDesc;
		protected $x;
		protected $y;
		protected $sottoluogoArrivoId;
		
		private $db;
		
		public function __construct($id){	
			global $con;
			$this->db = $con->getDB();
			
			$q = "SELECT * FROM BOT_RPG_LUOGO WHERE LUOGO_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			
			$this->luogoId 	 				= $row->LUOGO_ID;
			$this->luogoNome 				= $row->LUOGO_NOME;
			$this->luogoDesc 				= $row->LUOGO_DESC;
			$this->x 		 				= $row->LUOGO_X;
			$this->y 	 	 				= $row->LUOGO_Y;
			$this->luogoSottoluogoArrivoId 	= $row->LUOGO_SOTTOLUOGO_ARRIVO_ID;

			
		}
		
		public function getLuogoId(){
			return $this->luogoId;
		}
		
		public function getLuogoNome(){
			return $this->luogoNome;
		}
		
		public function getLuogoDesc(){
			return $this->luogoDesc;
		}
		
		public function getX(){
			return $this->x;
		}
		
		public function getY(){
			return $this->y;
		}

		public function getLuogoSottoluogoArrivoId(){
			return $this->luogoSottoluogoArrivoId;
		}
		
		public function distanceFrom($L){
			return sqrt(pow($L->getY() - $this->getY(), 2) + pow($L->getX() - $this->getX(), 2));
		}
		
		public function getRandomSottoluogoId(){
			$q = "SELECT SOTTOLUOGO_ID FROM BOT_RPG_SOTTOLUOGO, BOT_RPG_LUOGO WHERE LUOGO_ID = SOTTOLUOGO_LUOGO_ID AND LUOGO_ID = ". $this->luogoId ." LIMIT 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->SOTTOLUOGO_ID;
		}
		
		public function getArraySottoluogoColumn($col){
			$data = array();
			$q = "SELECT SOTTOLUOGO_".$col." AS COL FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_LUOGO_ID = ".$this->luogoId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->COL;
			}
			return $data;
		}
		
		public function doesSottoluogoNomeExist($sottoluogoNome){
			$q = "SELECT * FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_NOME = '".$sottoluogoNome."' AND SOTTOLUOGO_LUOGO_ID = ".$this->luogoId;
			$res = $this->db->query($q);
			return ($res->num_rows != 0) ? true : false;
		}
		
		public function printDistanceFromAllOtherLuogo(){
			$msg = '';
			$q = "SELECT * FROM BOT_RPG_LUOGO WHERE LUOGO_ID <> ". $this->luogoId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$L = new Luogo($row->LUOGO_ID);
				$distance = $this->distanceFrom($L);
				$minute = $distance * 10;
				$hour = intVal($minute/60);
				$minute = $minute % 60;
				$minute = intVal($minute);
				$time = '';
				if($hour > 0){
					if($hour > 24){
						$day = intVal($hour/24);
						$hour = intVal($hour % 24);
						if($day > 365){
							$anni = intVal($day/365);
							$time .= $anni . ' Year' . "\n";
							$day = intVal($day % 365);
						}
						$time .= $day . ' Day' . "\n";
					}
					
					$time .= $hour . ' Hour' . "\n";
				}
				$time .= $minute . ' Min' . "\n";
				$msg .= $row->LUOGO_NOME . "\n" . $time . "\n\n";
			}
			
			return $msg;
		}

		public function getNearLuoghiArrayId(){
			$sql = "SELECT SBOCCO_LUOGO_ID FROM BOT_RPG_LUOGO_SBOCCHI WHERE PARTENZA_LUOGO_ID = ".$this->getLuogoId();
			$res = Database()->query($sql);
			if(!$res)
				return array();
			$arr = array();
			while($row = $res->fetch_object()){
				$arr[] = $row->SBOCCO_LUOGO_ID;
			}
			return $arr;
		}

		public function getNearLuoghiArrayNomi(){
			$res = array();
			$arr = $this->getNearLuoghiArrayId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				$Luogo = new Luogo($arr[$i]);
				$res[] = $Luogo->getLuogoNome();
			}
			return $res;
		}

		public function printDistanceFromNearLuoghi(){
			$msg = '';
			$res = array();
			$arr = $this->getNearLuoghiArrayId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				$L = new Luogo($arr[$i]);
				$distance = $this->distanceFrom($L);
				$minute = $distance * 10;
				$hour = intVal($minute/60);
				$minute = $minute % 60;
				$minute = intVal($minute);
				$time = '';
				if($hour > 0){
					if($hour > 24){
						$day = intVal($hour/24);
						$hour = intVal($hour % 24);
						if($day > 365){
							$anni = intVal($day/365);
							$time .= $anni . ' Year' . "\n";
							$day = intVal($day % 365);
						}
						$time .= $day . ' Day' . "\n";
					}
					
					$time .= $hour . ' Hour' . "\n";
				}
				$time .= $minute . ' Min' . "\n";
				$msg .= $L->getLuogoNome() . "\n" . $time . "\n\n";
			}

			return $msg;
		}

		public function isLuogoNear($luogoId){
			$arr = $this->getNearLuoghiArrayId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				if($arr[$i] == $luogoId)
					return true;
			}
			return false;
		}
	}