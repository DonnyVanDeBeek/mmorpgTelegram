<?php
	//PIAZZA DEL MERCATO
	Class Sottoluogo89 extends Sottoluogo{
		private $id = 89;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		/*
		public function stepIn(){
			parent::stepIn();

			//if($Ut->getStoryline() == 0){
				
			//}
		}
		*/
	}