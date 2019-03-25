<?php
	Class Esplorazione35 extends Esplorazione{
		//Un Gran Consiglio
		private $esplorazioneId = 35;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}