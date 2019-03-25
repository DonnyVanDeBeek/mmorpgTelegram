<?php
	//FRECCIA INCENDIARIA
	class Item179 extends Item{
		private $itemId = 179;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function scagliaDardo(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			$OT = OverTime::create($Danno->getTarget(), 1, 10, 3);

			$dmg = 10;
			$Danno->setDmg($dmg);
			$Danno->setTipo('FISICO');
			$Danno->isRanged(true);
			$Danno->addOverTime($OT);
		}
	}
