<?php
	class Quest2 extends Quest{
		private $id = 2;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->id);
		}

		public function check(){
			$Ut = $this->getUtente();
			if($Ut->getMemo('QUEST_2_CONSEGNA_LETTERA_ADAM') !== false){
				return true;
			}else{
				return false;
			}
		}

		public function clear(){
			parent::clear();

			$Ut = $this->getUtente();

			$PicconeDaMinatore = 135;
			$livello = 5;
			$Ut->giveEquip($PicconeDaMinatore, $livello);
		}
	}