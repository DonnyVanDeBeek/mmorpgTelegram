<?php
	//CINTURONE DA BRIGANTE
	class Equip95 extends Equip{
		private $equipId = 95;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}
	}