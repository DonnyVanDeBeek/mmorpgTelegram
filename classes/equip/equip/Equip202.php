<?php
	//DISCIPLINA
	class Equip202 extends Equip{
		private $equipId = 202;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}