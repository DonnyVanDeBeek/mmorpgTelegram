<?php
	Class Esplorazione65 extends Esplorazione{
		//MINCHIA ZIO CE L'hai NA SIGA?
		private $esplorazioneId = 65;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}