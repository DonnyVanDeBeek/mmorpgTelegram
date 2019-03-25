<?php
	//MAZZA CHIODATA
	class Equip201 extends Equip{
		private $equipId = 201;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}