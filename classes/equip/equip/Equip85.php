<?php
	//MATTONE LEGATO AD UNA CATENA
	class Equip85 extends Equip{
		private $equipId = 85;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}