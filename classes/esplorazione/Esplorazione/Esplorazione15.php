<?php
	Class Esplorazione15 extends Esplorazione{
		//Attenzione A Tutti, È Urlodì!
		private $esplorazioneId = 15;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}