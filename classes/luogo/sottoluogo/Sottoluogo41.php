<?php
	//Osservatorio - Salone Centrale
	Class Sottoluogo41 extends Sottoluogo{
		private $id = 41;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function stepIn(){
			$msg = '';
			$msg .= 'Hai davanti la porta dell`osservatorio.'."\n";
			$msg .= 'Provi ad aprirla.'."\n";
			
			$ChiaveOsservatorioId = 26;
			//$ChiaveOsservatorio = new Item26($this->utente);
			
			$n = $this->utente->getHowManyTipoItemId($ChiaveOsservatorioId);
			if($n > 0){
				$this->utente->setUtenteSottoluogoId($this->getSottoluogoId());
				$msg .= 'Usi la chiave. La porta dell`osservatorio si apre. Entri.';
			}else{
				$msg .= 'La porta è chiusa a chiave.';
			}
			
			write($msg);
		}
	}