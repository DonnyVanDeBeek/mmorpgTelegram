<?php
	//BAR DRAGONS
	Class Sottoluogo2 extends Sottoluogo{
		private $id = 2;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$msg = 'Il portone è molto pesante. Provi a spingerlo.'."\n";

			$portone = 10;
			$forza = $this->utente->getTotalStat('Forza');

			if(rand(0, $forza) > $portone){
				$this->utente->setUtenteSottoluogoId($this->getSottoluogoId());
				$msg .= 'Il portone si è mosso!'."\n";
			}else{
				$msg .= 'Il portone non si smuove...'."\n";
			}

			write($msg);
		}
	}