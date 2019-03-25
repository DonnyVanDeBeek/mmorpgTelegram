<?php
	Class Mob91 extends Mob{
		//BANDITO TAGLIAGOLE
		public function __construct($id){
			parent::__construct($id);
		}

		public function assegnaEquip(){
			$Livello = 5;
			$Tagliagole = 98;
			$this->giveEquip($Tagliagole, $Livello);
			
			$Livello = 10;
			$Tagliagole = 98;
			$this->giveEquip($Tagliagole, $Livello);
		}

}