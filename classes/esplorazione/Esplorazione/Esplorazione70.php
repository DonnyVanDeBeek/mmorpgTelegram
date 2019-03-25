<?php
	Class Esplorazione70 extends Esplorazione{
		//L'abitante del bosco
		private $esplorazioneId = 70;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}