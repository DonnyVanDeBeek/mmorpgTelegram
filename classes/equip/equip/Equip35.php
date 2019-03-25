<?php
	//CIPOLLOTTO DA TASCHINO
	class Equip35 extends Equip{
		private $equipId = 35;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}