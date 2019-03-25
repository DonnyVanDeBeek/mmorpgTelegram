<?php
	//SASSO
	class Item109 extends Item{
		private $itemId = 109;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function throw(Danno &$Danno){
			$Danno->setDmg(rand(10,20));
			$Danno->send();
		}
	}