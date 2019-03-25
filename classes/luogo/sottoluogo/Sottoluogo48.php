<?php
	//MOONLIT SLOPES - 100M
	Class Sottoluogo48 extends Sottoluogo{
		private $id = 48;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes!'."\n");

			$percSL = 10;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Hai scalato primi 100 metri. Ancora 1100!'."\n");
			}else{
				write('Arrivi a un punto cieco, non ci sono pietre a cui puoi aggrapparti. Non hai altra scelta che scendere e ricominciare');
			}
		}
	}

	