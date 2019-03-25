<?php
	//VICOLO BUIO
	Class Sottoluogo42 extends Sottoluogo{
		private $id = 42;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function spawn(&$ut){
			$ut->clearAllMobHere();
			
			if(rand(0,10) > 9){
				$ut->setX(5);
				$ut->setY(7);
	
				$tipoMobId = 16;
				$sottoluogoId = $this->id;
				$livello = $ut->getLevel();
				$utenteId = $ut->getId();
				$mobHp = 980 + $livello;
				$nomeProprioId = 55555;
				$flagTarget = 99;
				$pm = 10;
				$pa = 10;
				$x = 5;
				$y = 1;
				$targetId = $ut->getId();
				$targetEntitaId = $ut->getEntitaId();
	
				$fu = new Functions();
				$fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);
				write('Vedi una figura alta e scura davanti a te!');
			}else{
				//write('Sembra non esserci nessuno, ma qualcosa si muove nell\'ombra...');
				parent::spawn($ut);
			}
		}
	}