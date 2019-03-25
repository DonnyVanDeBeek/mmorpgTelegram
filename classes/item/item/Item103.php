<?php
	//COLTELLO DA LANCIO
	class Item103 extends Item{
		private $itemId = 103;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function throw(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			$dmg = 100;

			$Danno->setDmg($dmg);
			$Danno->setTipo('PERFORANTE');

			$Danno->send();
		}
	}
