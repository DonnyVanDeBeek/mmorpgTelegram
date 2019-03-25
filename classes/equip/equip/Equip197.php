<?php
	//DE INFERII REGNI
	class Equip197 extends Equip{
		private $equipId = 197;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}