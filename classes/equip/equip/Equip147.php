<?php
	//MEDAGLIETTA ONORARIA DEGLI AMICI NOTTURNI
	class Equip147 extends Equip{
		private $equipId = 147;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}