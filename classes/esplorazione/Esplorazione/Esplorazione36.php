<?php
	Class Esplorazione36 extends Esplorazione{
		//Gunnar Lunastorta
		private $esplorazioneId = 36;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}