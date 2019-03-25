<?php
	//UNGUENTO DI ERBE
	class Item121 extends Item{
		private $itemId = 121;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();
			
			$Bruciatura = 1;
			$this->getUtente()->removeOvertime($Bruciatura);

			write('Spalmi l\'unguendo sul tuo corpo, rimuovendo eventuali bruciature');
			return true;
		}
	}