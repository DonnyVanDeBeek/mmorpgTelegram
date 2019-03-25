<?php
	//DRAPPO DEL TAGLIAGOLE
	class Equip25 extends Equip{
		private $equipId = 25;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}