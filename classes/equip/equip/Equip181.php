<?php
	//ARMATURA DA ROMPICOGLIONI
	class Equip181 extends Equip{
		private $equipId = 181;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}