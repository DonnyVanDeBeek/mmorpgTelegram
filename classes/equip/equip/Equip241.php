<?php
	//PUGNALE INSANGUINATO
	class Equip241 extends Equip{
		private $equipId = 241;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}