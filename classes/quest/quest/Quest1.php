<?php
	class Quest1 extends Quest{
		private $id = 1;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->id);
		}

		public function check(){
			$Ut = $this->getUtente();
			$CarneCrudaDiCinghiale = 27;
			$quantita = 10;
			if($Ut->togliItem($CarneCrudaDiCinghiale, $quantita)){
				return true;
			}else
				return false;
		}

		public function clear(){
			parent::clear();

			$Mordheau = 96;
			$this->getUtente()->learnSkill($Mordheau, true);
		}
	}