<?php
	Class Mob60 extends Mob{
		//ORCO SEMPLICE
		public function __construct($id){
			parent::__construct($id);
		}

		public function assegnaEquip(){
			$Livello = 10;
			$SpadaAntimateria = 106;
			$this->giveEquip($SpadaAntimateria, $Livello);
		}
	}