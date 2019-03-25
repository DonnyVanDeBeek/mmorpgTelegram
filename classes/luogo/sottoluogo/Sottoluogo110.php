<?php
	//BOSCO VERDEMUSCHIO
	Class Sottoluogo110 extends Sottoluogo{
		private $id = 110;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		/*
		public function stepIn(){
			parent::stepIn();

			$Ut = $this->utente;

			//$Ut->setSottoluogoId($this->getSottoluogoId());

			$fraseStoryline0 = "Non appena entri nel bosco lo riconosci. Non puoi sbagliarti.\nLui è l'uomo incappucciato che ti ha derubato in piazza.\nEgli giace ora per terra in una pozza di sangue. L'elsa di un pugnale è visibile sulla sua schiena, la lama invece no: è completamente infilzata dentro la sua carne.\n\nTi avvicini al suo cadavere e scorgi una pergamena stropicciata stretta nelle sue fredde e pallide mani.\n";

			if($Ut->getStoryline() == 0){
				write($fraseStoryline0);
				$Pergamena = 227;
				$Ut->initNotifyGiveItem();
				$Ut->notifyGiveItem($Pergamena);
				$Ut->giveItem($Pergamena);
				$Ut->setStoryline(1);
			}
		}
		*/
	}