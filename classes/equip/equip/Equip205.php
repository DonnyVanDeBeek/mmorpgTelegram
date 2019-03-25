<?php
	//TUBA A VAPORE
	class Equip205 extends Equip{
		private $equipId = 205;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}