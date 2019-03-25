<?php
	//SACCA DI CIBARIE
	class Item88 extends Item{
		private $itemId = 88;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$limit = 10;

			$Ut = $this->getUtente();
			write("Leccandoti i baffi, ti appropinqui ad aprire la sacca per scoprire le leccornie che contiene\n\n");
			$Ut->initNotifyGiveItem();

			$Cipolla = 1;
			$Uovo = 79;
			$Rapa = 100;
			$CarneSecca = 198;

			$Cibarie = array($Cipolla, $Uovo, $Rapa, $CarneSecca);
			$n = count($Cibarie);
			
			for($i = 0; $i < $n; $i++){
				$quantita = rand(0, $limit);
				if($quantita > 0){
					$Ut->giveItem($Cibarie[$i], $quantita);
					$Ut->notifyGiveItem($Cibarie[$i], $quantita);
				}
			}
		}
	}