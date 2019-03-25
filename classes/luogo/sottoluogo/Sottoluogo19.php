<?php
	//TAVERNA DEL BUE INCAPRETTATO
	Class Sottoluogo19 extends Sottoluogo{
		private $id = 19;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}