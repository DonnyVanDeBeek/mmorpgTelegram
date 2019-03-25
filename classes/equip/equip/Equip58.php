<?php
	//"MANGIAR SANO CON ANGELO PARODI"
	class Equip58 extends Equip{
		private $equipId = 58;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}