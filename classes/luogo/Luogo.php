<?php
	Class Luogo extends Database{
		protected $luogoId;
		protected $luogoNome;
		protected $luogoDesc;
		protected $x;
		protected $y;
		
		public function __construct($id){	
			$this->getDB();
			$q = "SELECT * FROM BOT_RPG_LUOGO WHERE LUOGO_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			
			$this->luogoId 	 = $row->LUOGO_ID;
			$this->luogoNome = $row->LUOGO_NOME;
			$this->luogoDesc = $row->LUOGO_DESC;
			$this->x 		 = $row->LUOGO_X;
			$this->y 	 	 = $row->LUOGO_Y;
			
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
		
		public function distanceFrom($L){
			return sqrt(pow($L->getY() - $this->getY(), 2) + pow($L->getX() - $this->getX(), 2));
		}
		
		public function getRandomSottoluogoId(){
			$q = "SELECT SOTTOLUOGO_ID FROM BOT_RPG_SOTTOLUOGO, BOT_RPG_LUOGO WHERE LUOGO_ID = SOTTOLUOGO_LUOGO_ID AND LUOGO_ID = ". $this->luogoId ." LIMIT 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->SOTTOLUOGO_ID;
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
							$time .= $anni . ' anni, ';
							$day = intVal($day % 365);
						}
						$time .= $day . ' giorni, ';
					}
					
					$time .= $hour . ' ore e ';
				}
				$time .= $minute . ' minuti';
				$msg .= $row->LUOGO_NOME . ' ' . $time . "\n";
			}
			
			return $msg;
		}
	}