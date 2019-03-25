<?php
	//BACCHETTA DI MANDRAGOLA
	class Equip43 extends Equip{
		private $equipId = 43;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}