<?php
	//PICCONE DA MINATORE
	class Equip135 extends Equip{
		private $equipId = 135;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}