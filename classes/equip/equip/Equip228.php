<?php
	//DENTE DI VIPERA
	class Equip228 extends Equip{
		private $equipId = 228;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}