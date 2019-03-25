<?php
	//BACIO DI DAMA
	class Equip188 extends Equip{
		private $equipId = 188;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}