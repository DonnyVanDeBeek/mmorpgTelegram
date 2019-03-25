<?php
	//FALANGE DEL FALSO DIO 
	class Equip72 extends Equip{
		private $equipId = 72;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}