<?php
	//BACCHETTA DEL RABDOMANTE
	class Equip141 extends Equip{
		private $equipId = 141;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function buff(Danno &$Danno){
			$heal = rand(10, 20);
			$Danno->getDealer()->heal($heal);
		}
	}