<?php
	//COPRICAPO LUPESCO
	class Equip78 extends Equip{
		private $equipId = 78;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}