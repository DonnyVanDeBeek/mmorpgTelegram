<?php
	//BOMBA ALCHEMICA
	class Item96 extends Item{
		private $itemId = 96;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function throw(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			$dmg = 100;

			$Danno->setTipo('MAGICO');
			$Danno->send();
		}
	}
