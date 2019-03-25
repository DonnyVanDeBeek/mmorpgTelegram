<?php
	//TROMBONCINO
	class Equip173 extends Equip{
		private $equipId = 173;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}