<?php
	Class Esplorazione20 extends Esplorazione{
		//Ci Serve Del Legname
		private $esplorazioneId = 20;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}