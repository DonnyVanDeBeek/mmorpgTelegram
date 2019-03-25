<?php
	//ANFORA OCCLUSA
	class Item150 extends Item{
		private $itemId = 150;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Ut = $this->getUtente();

			$Forza = $Ut->getTotalStatNoEquip('FORZA');

			$prova = 40;

			write("Scaraventi l'anfora per terra.");
			if($Forza >= $prova){
				write("L'anfora si frantuma in mille pezzi!\n");
				$this->apriAnfora();
			}else{
				write("L'anfora rimbalza. Pare non essersi nemmeno scheggiata");
			}
			
			return true;
		}

		public function apriAnfora(){
			$min = 0;
			$max = 1;

			$AnelloDiFerro = 204;
			$AnticoFoglio = 67;
			$Sasso = 109;
			$Osso = 135;
			$Ambra = 114;

			$Pool = array($AnelloDiFerro, $AnticoFoglio, $Ambra, $Osso, $Sasso);

			shuffle($Pool);

			$Ut = $this->getUtente();

			$Ut->giveItem($Pool[0]);
			$Ut->initNotifyGiveItem();
			$Ut->notifyGiveItem($Pool[0]);

			return true;

			//$this->giveRandomFromPool($Pool, $min, $max);
		}
	}