<?php
	//ASCIA DA LANCIO
	class Item206 extends Item{
		private $itemId = 206;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

        public function throw(Danno &$Danno){
            if(!$this->togliItem())
             return false;

            $dmg = 150;

            $Danno->setDmg($dmg);
            $Danno->setTipo('TAGLIENTE');

            $Danno->send();
        }
	}
