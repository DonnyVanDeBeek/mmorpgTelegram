<?php
	//GUANTO MAGICO
	class Equip251 extends Equip{
		private $equipId = 251;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}