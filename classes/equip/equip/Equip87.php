<?php
	//DADI DELLA BUONA SORTE
	class Equip87 extends Equip{
		private $equipId = 87;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}