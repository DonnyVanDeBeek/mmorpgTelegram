<?php
	//SPADINO
	class Equip144 extends Equip{
		private $equipId = 144;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}