<?php
	Class Esplorazione14 extends Esplorazione{
		//Radura Fiorita
		private $esplorazioneId = 14;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}