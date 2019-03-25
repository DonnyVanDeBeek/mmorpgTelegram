<?php
	//SCARPONE CHIODATO
	class Equip192 extends Equip{
		private $equipId = 192;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}