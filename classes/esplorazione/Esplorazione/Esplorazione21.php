<?php
	Class Esplorazione21 extends Esplorazione{
		//Into The Wild
		private $esplorazioneId = 21;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}