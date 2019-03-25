<?php
	class Quest0 extends Quest{
		private $id = 0;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->id);
		}

		public function check(){
			$Ut = $this->getUtente();
			$Cipolla = 1;
			$quantita = 10;
			if($Ut->togliItem($Cipolla, $quantita)){
				//$Ut->notifyTogliItem($Cipolla, $quantita);
				return true;
			}else
				return false;
		}

		public function clear(){
			parent::clear();
		}
	}