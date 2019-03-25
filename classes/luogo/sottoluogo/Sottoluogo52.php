<?php
	//MOONLIT SLOPES - 1000M
	Class Sottoluogo52 extends Sottoluogo{
		private $id = 52;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes! Obiettivo: 1000 metri!'."\n");

			$percSL = 85;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Hai scalato 1000 metri. Ancora 200!'."\n");
			}else{
				$ut->setUtenteSottoluogoId(rand(47,51));
				write('Raffiche di vento si abbattono sulla montagna. Vieni sdradicato e cadi.');
			}
		}
	}