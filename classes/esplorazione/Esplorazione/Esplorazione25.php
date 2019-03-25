<?php
	Class Esplorazione25 extends Esplorazione{
		//Nella Morsa Del Dragone
		private $esplorazioneId = 25;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}