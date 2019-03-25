<?php
	Class Mob79 extends Mob{
		//TAGLIAGOLE
		public function __construct($id){
			parent::__construct($id);
		}

		public function assegnaEquip(){
			$Livello = 10;
			$BacioDiDama = 188;
			$this->giveEquip($BacioDiDama, $Livello);
		}
	}