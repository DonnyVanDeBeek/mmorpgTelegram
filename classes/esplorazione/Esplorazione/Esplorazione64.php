<?php
	Class Esplorazione64 extends Esplorazione{
		//SHITPOSTING
		private $esplorazioneId = 64;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}