<?php
	//MOONLIT SLOPES - 800M
	Class Sottoluogo51 extends Sottoluogo{
		private $id = 51;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes! Obiettivo: 800 metri!'."\n");

			$percSL = 75;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Hai scalato 800 metri. Ancora 400!'."\n");
			}else{
				$ut->setUtenteSottoluogoId(rand(47,50));
				write('Raffiche di vento si abbattono sulla montagna. Vieni sdradicato e cadi.');
			}
		}
	}