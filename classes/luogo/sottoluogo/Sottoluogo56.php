<?php
	//MINIERA D'ORO
	Class Sottoluogo56 extends Sottoluogo{
		private $id = 56;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function spawn(&$ut){
			$ut->clearAllMobHere();

			$cercatoreId = 52;
			$guardiaId = 53;

			$lvl = $ut->getLevel() + 3;

			$ut->setX($this->randAvailableX());
			$ut->setY($this->randAvailableY());

			$fu = new Functions();

			$n = rand(2,5);

			$arrGuardieId = array();
			$arrCercatoriId = array();

			//CREO LE GUARDIE
			for($i = 0; $i < $n; $i++){
				$tipoMobId = $guardiaId;
				$sottoluogoId = $this->id;
				$livello = rand($lvl - 2, $lvl + 2);
				$utenteId = $ut->getId();
				$mobHp = 200 + (2 * $livello);
				$nomeProprioId = rand(100, 50000);
				$flagTarget = 99;
				$pm = 10;
				$pa = 10;
				$x = $this->randAvailableX();
				$y = $this->randAvailableY();
				$targetId = 0;
				$targetEntitaId = 1;

				$id = $fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

				$arrGuardieId[] = $id;
			}

			//CREO I CERCATORI
			for($i = 0; $i < $n; $i++){
				$tipoMobId = $cercatoreId;
				$sottoluogoId = $this->id;
				$livello = rand($lvl - 2, $lvl + 2);
				$utenteId = $ut->getId();
				$mobHp = 200 + (2 * $livello);
				$nomeProprioId = rand(100, 50000);
				$flagTarget = 99;
				$pm = 10;
				$pa = 10;
				$x = $this->randAvailableX();
				$y = $this->randAvailableY();
				$targetId = $arrGuardieId[$i];
				$targetEntitaId = 1;

				$id = $fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

				$arrCercatoriId[] = $id;
			}

			for($i = 0; $i < $n; $i++){
				$targetId = $arrCercatoriId[$i];
				$id = $arrGuardieId[$i];
				$sql = "UPDATE BOT_RPG_MOB SET MOB_TARGET_ID  = $targetId WHERE MOB_ID = $id";
				Database()->query($sql);
			}

			write('Guardie e Cercatori sono impegnati in una battaglia? Chi vincerà? Chi deciderai di aiutare?'."\n");
		}
	}