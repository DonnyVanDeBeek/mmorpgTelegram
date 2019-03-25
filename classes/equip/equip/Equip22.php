<?php
	//CAPPELLO A LARGHE TESE
	class Equip22 extends Equip{
		private $equipId = 22;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}