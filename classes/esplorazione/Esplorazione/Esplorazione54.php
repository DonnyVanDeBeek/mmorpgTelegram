<?php
	Class Esplorazione54 extends Esplorazione{
		//La Roba È Di Chi Se La Trova
		private $esplorazioneId = 54;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}