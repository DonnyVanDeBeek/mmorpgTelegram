<?php
	//STOCCO
	class Equip142 extends Equip{
		private $equipId = 142;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}