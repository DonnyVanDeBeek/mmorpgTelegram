<?php
	//CASCO CON OCCHIALETTI
	class Equip195 extends Equip{
		private $equipId = 195;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}