<?php
	//COTTA DI MAGLIA
	class Equip215 extends Equip{
		private $equipId = 215;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}