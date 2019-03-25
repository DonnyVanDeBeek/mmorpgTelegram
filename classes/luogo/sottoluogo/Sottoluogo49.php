<?php
	//MOONLIT SLOPES - 300M
	Class Sottoluogo49 extends Sottoluogo{
		private $id = 49;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes! Obiettivo: 300 metri!'."\n");

			$percSL = 30;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Hai scalato 300 metri. Ancora 900!'."\n");
			}else{
				$ut->setUtenteSottoluogoId(rand(47,48));
				write('Raffiche di vento si abbattono sulla montagna. Vieni sdradicato e cadi.');
			}
		}
	}