<?php
	//CARTA IGIENICA AFFILATA
	class Equip12 extends Equip{
		private $equipId = 12;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}