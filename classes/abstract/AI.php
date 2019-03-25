<?php
	class AI{
		private $mode;
		private $dealer;
		private $target;
		private $msg = array();

		public function __construct($mode){
			$this->mode = $mode;
		}

		public function getMsg($name){
			return $this->msg[$name];
		}

		public function getTarget(){
			return $this->target;
		}

		public function setTarget(&$a){
			$this->target = $a;
		}

		public function getDealer(){
			return $this->dealer;
		}

		public function setDealer(&$a){
			$this->dealer = $a;
		}

		public function run(){
			switch(strtoupper($this->mode)){
				case 'AGGRESSIVE':
					$this->goAggressive();
				break;

				case 'MANTIENI_DISTANZA':
					$this->mantieniDistanza();
				break;

				case 'RANDOM':

				break;

				case 'PASSIVE':

				break;

				case 'DO_NOTHING':
					$this->doNothing();
			}
		}

		public function mantieniDistanza(){
			$dist = 5;
			if($this->getDealer()->getDistanceFrom($this->getTarget()) < $dist){
				if($this->getDealer()->moveAwayFrom($this->getTarget()))
					return true;
				else{
					$this->goAggressive();
				}
			}else{
				$this->goAggressive();
			}
		}

		public function goAggressive(){
			//PROVA A USARE UNA SKILL
			$skills = $this->dealer->getSkills();
			$n = count($skills);
			$flag = false;
			for($i = 0; $i < $n && !$flag; $i++){
				//$this->target->sendMessage('Qui arrivo');
				$flag = $this->dealer->useRandomSkill();
			}

			//$this->target->sendMessage($flag ? 'true' : 'false');

			//SE CI RIESCE SI FERMA; ALTRIMENTI VA IN DIREZIONE DEL NEMICO
			if($flag){
				return true;
			}else{
				$this->moveTowardsTarget();
			}
		}

		public function doNothing(){
			
		}

		public function moveTowardsTarget(){
			$tx = $this->target->getX();
			$ty = $this->target->getY();

			$dx = $this->dealer->getX();
			$dy = $this->dealer->getY();

			if($tx > $dx)
				$dir = 'EST';

			if($tx < $dx)
				$dir = 'OVEST';

			if($ty > $dy)
				$dir = 'SUD';

			if($ty < $dy)
				$dir = 'NORD';

			$this->dealer->muovi(1, $dir);
		}


	}