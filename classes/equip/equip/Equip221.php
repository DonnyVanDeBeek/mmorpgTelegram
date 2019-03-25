<?php
	//COPRICAPO DEI FRATELLI SCARLATTI
	class Equip221 extends Equip{
		private $equipId = 221;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}