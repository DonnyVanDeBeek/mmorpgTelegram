<?php
	//ARBALESTA
	class Equip163 extends Equip{
		private $equipId = 163;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}