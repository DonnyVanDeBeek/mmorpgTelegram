<?php
	//PICCA 
	class Equip48 extends Equip{
		private $equipId = 48;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}