<?php
	//ARCHIBUGIO
	class Equip111 extends Equip{
		private $equipId = 111;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}