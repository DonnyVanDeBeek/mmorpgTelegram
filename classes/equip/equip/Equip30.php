<?php
	//DENTE DI RAKT
	class Equip30 extends Equip{
		private $equipId = 30;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}