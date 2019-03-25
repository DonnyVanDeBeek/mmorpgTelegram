<?php
	//COLTELLACCIO DA CACCIATORE
	class Equip125 extends Equip{
		private $equipId = 125;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}