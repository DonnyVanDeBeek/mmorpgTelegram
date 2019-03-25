<?php
	//VERGA DA DOMATORE DI CINGHIALI
	class Equip44 extends Equip{
		private $equipId = 44;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}