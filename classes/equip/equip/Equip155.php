<?php
	//SCURE
	class Equip155 extends Equip{
		private $equipId = 155;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}