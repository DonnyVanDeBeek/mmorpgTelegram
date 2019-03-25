<?php
	Class Esplorazione40 extends Esplorazione{
		//Cimeli Relitti
		private $esplorazioneId = 40;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}