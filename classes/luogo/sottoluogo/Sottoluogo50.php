<?php
	//MOONLIT SLOPES - 500M
	Class Sottoluogo50 extends Sottoluogo{
		private $id = 50;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes! Obiettivo: 500 metri!'."\n");

			$percSL = 55;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Hai scalato 500 metri. Ancora 700!'."\n");
			}else{
				$ut->setUtenteSottoluogoId(rand(47,49));
				write('Raffiche di vento si abbattono sulla montagna. Vieni sdradicato e cadi.');
			}
		}
	}