<?php
	//ARCHIBUGIO CON BAIONETTA
	class Equip112 extends Equip{
		private $equipId = 112;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}