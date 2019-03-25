<?php
	//SPARABULBI
	class Equip199 extends Equip{
		private $equipId = 199;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}