<?php
	//APRITROLL
	class Equip154 extends Equip{
		private $equipId = 154;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}