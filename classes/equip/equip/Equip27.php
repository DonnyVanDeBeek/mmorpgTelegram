<?php
	//TARALLO DEGLI ANTICHI
	class Equip27 extends Equip{
		private $equipId = 27;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}