<?php
	//MANUALE DEL LANCIATORE DI COLTELLI
	class Equip89 extends Equip{
		private $equipId = 89;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}