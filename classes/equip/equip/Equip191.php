<?php
	//SCARPONE
	class Equip191 extends Equip{
		private $equipId = 191;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}