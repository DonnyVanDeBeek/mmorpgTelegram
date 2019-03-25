<?php
	//SPADA NELLA ROCCIA
	class Equip211 extends Equip{
		private $equipId = 211;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}