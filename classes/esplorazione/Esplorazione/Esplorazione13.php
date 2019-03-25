<?php
	Class Esplorazione13 extends Esplorazione{
		//Bacchetta Della Necromagia Sonica Del Potere Della Fiamma Bianca Del Fuoco Del Ferro Sacro Del Mago Dio Guerriero Del Fuoco Sacro
		private $esplorazioneId = 13;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}