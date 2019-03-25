<?php
	//ARCO ANCESTRALE
	class Equip90 extends Equip{
		private $equipId = 90;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}