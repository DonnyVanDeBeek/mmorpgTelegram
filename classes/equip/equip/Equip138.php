<?php
	//FALCIONE
	class Equip138 extends Equip{
		private $equipId = 138;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}