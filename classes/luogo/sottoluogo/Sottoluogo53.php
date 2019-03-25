<?php
	//MOONLIT SLOPES - VETTA
	Class Sottoluogo53 extends Sottoluogo{
		private $id = 53;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$ut = $this->utente;

			write('Ti arrampichi su per la Moonlit Slopes! Obiettivo: Vetta!!!'."\n");

			$percSL = 95;
			$perc = rand(0,100);

			if($perc > $percSL){
				$ut->setUtenteSottoluogoId($this->getSottoluogoId());
				write('Sei arrivato alla cima di Moonlit Slopes. Complimenti!'."\n");
			}else{
				$ut->setUtenteSottoluogoId(rand(47,52));
				write('Raffiche di vento si abbattono sulla montagna. Vieni sdradicato e cadi.');
			}
		}
	}