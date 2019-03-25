<?php
	Class Esplorazione6 extends Esplorazione{
		//Trovatore Di Infanti
		private $esplorazioneId = 6;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}