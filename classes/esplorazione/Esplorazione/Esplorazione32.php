<?php
	Class Esplorazione32 extends Esplorazione{
		//Magia Senile
		private $esplorazioneId = 32;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$Ut->setHp(1);
			return true;
		}
	}