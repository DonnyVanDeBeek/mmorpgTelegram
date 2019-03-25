<?php
	//GATTO A NOVE CODE
	class Equip66 extends Equip{
		private $equipId = 66;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}