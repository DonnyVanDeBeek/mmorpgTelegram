<?php
	Class Esplorazione66 extends Esplorazione{
		//La Stanza Rossa
		private $esplorazioneId = 66;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}