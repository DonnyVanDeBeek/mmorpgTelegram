<?php
	//SIRINGA DI ESTRATTO PINEALE
	class Item120 extends Item{
		private $itemId = 120;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Ut = $this->getUtente();

			$perc = rand(1,10);

			write('Ti inietti la siringa!'."\n");

			if($perc > 7){
				$this->triggerDebuff($Ut);
			}

			if($perc <= 7){
				$this->triggerBuff($Ut);
			}

			return true;
		}

		public function triggerDebuff(&$Ut){
			$value = -75;
			$turni = 5;

			$stat = 'COSTITUZIONE';
			$Ut->giveBuff($stat, $value, $turni);
		}

		public function triggerBuff(&$Ut){
			$min = 10;
			$max = 20;
			$turni = 5;

			$stat = 'FORZA';
			$value = rand($min,$max);
			$Ut->giveBuff($stat, $value, $turni);

			$stat = 'MAGIA';
			$value = rand($min,$max);
			$Ut->giveBuff($stat, $value, $turni);

			$stat = 'DESTREZZA';
			$value = rand($min,$max);
			$Ut->giveBuff($stat, $value, $turni);
		}
	}