<?php
	//GALLERIA SOMMERSA
	Class Sottoluogo63 extends Sottoluogo{
		private $id = 63;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}