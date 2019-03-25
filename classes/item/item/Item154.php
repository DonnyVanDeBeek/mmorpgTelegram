<?php
	//DARDO ESPLOSIVO
	class Item154 extends Item{
		private $itemId = 154;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function scagliaDardo(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			$dmg = 30;
			$Danno->setDmg($dmg);
			$Danno->setTipo('ESPLOSIONE');
		}
	}
