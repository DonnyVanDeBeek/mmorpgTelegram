<?php
	//SPADA CON FORMULE MATEMATICHE
	class Equip40 extends Equip{
		private $equipId = 40;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}