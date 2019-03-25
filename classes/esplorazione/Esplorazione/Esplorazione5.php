<?php
	Class Esplorazione5 extends Esplorazione{
		//Un Vecchio Che Sbraita Contro Le Nuvole
		private $esplorazioneId = 5;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}