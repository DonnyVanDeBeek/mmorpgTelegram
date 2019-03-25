<?php
	//ANTIDOTO
	class Item19 extends Item{
		private $itemId = 19;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$ut = $this->OBJUtente;
			$velenoId = 4;

			if(!$ut->hasTipoOverTime($velenoId)){
				write('Non sei avvelenato!');
				return false;
			}

			if($this->togliItem(1)){
				write($ut->getNome().' beve l\'antidoto.');
				$ut->removeOvertime($velenoId);
				return true;
			}
		}
	}