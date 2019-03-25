<?php
	//ASCIA GNOMICA
	class Equip117 extends Equip{
		private $equipId = 117;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		
	}