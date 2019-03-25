<?php
	//SFERA DELLO SCAMBIO
	class Item228 extends Item{
		private $itemId = 228;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function throw(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			$Target = $Danno->getTarget();
			$Caster = $Danno->getCaster();

			$tmpX = $Target->getX();
			$tmpY = $Target->getY();

			$Target->setX($Caster->getX());
			$Target->setY($Caster->getY());

			$Caster->setX($tmpX);
			$Caster->setY($tmpY);

			write($Caster->getNome(). ' si scambia di posizione con '. $Target->getNome());

		}
	}
