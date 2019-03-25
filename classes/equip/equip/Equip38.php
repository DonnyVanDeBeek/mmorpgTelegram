<?php
	//SCIABOLA
	class Equip38 extends Equip{
		private $equipId = 38;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}