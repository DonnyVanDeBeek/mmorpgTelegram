<?php
	//RUNA CAOTICA DELLA MAGIA
	class Item167 extends Item{
		private $itemId = 167;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function incastona(&$Equip){
			$this->togliItem();
			$value = rand(1, 20);
			$arr = array();
			$arr[] = array('statNome' => 'MAGIA', 'value' => $value);
			//$arr[] = array('statNome' => 'PRECISIONE', 'value' => $value);
			$Equip->addStatRuna($arr);
			return true;
		}
	}