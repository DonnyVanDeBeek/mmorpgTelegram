<?php
	//CAPPELLO GNOMESCO
	class Equip118 extends Equip{
		private $equipId = 118;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}