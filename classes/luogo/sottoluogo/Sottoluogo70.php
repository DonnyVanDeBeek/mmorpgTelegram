<?php
	//MACELLERIA GOBLIN
	Class Sottoluogo70 extends Sottoluogo{
		private $id = 70;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function scappa(){
			write($this->utente->getNome().' cerca una via d\'uscita dalla macelleria ma non la trova!'."\n");
			return false;
		}
	}