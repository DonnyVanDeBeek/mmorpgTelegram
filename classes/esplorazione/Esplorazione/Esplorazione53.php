<?php
	Class Esplorazione53 extends Esplorazione{
		//Segni Misteriosi
		private $esplorazioneId = 53;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}