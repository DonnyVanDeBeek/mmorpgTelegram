<?php
	Class Esplorazione67 extends Esplorazione{
		//Spirali Tra I Rami
		private $esplorazioneId = 67;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}