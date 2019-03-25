<?php
	//LE QUATTRO QUERCE
	Class Sottoluogo26 extends Sottoluogo{
		private $id = 26;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function spawn(&$ut){
			$ut->clearAllMobHere();
			
			$ut->setX(5);
			$ut->setY(5);

			$fu = new Functions();

			$tipoMobId = 40;
			$sottoluogoId = $this->id;
			$livello = 999;
			$utenteId = $ut->getId();
			$mobHp = 999999;
			$nomeProprioId = 3567;
			$flagTarget = 99;
			$pm = 10;
			$pa = 10;
			$x = 3;
			$y = 3;
			$targetId = $ut->getId();
			$targetEntitaId = $ut->getEntitaId();

			$fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

			$tipoMobId = 40;
			$sottoluogoId = $this->id;
			$livello = 999;
			$utenteId = $ut->getId();
			$mobHp = 999999;
			$nomeProprioId = 5735;
			$flagTarget = 99;
			$pm = 10;
			$pa = 10;
			$x = 7;
			$y = 3;
			$targetId = $ut->getId();
			$targetEntitaId = $ut->getEntitaId();

			$fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

			$tipoMobId = 40;
			$sottoluogoId = $this->id;
			$livello = 999;
			$utenteId = $ut->getId();
			$mobHp = 999999;
			$nomeProprioId = 7434;
			$flagTarget = 99;
			$pm = 10;
			$pa = 10;
			$x = 3;
			$y = 7;
			$targetId = $ut->getId();
			$targetEntitaId = $ut->getEntitaId();

			$fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

			$tipoMobId = 40;
			$sottoluogoId = $this->id;
			$livello = 999;
			$utenteId = $ut->getId();
			$mobHp = 999999;
			$nomeProprioId = 3456;
			$flagTarget = 99;
			$pm = 10;
			$pa = 10;
			$x = 7;
			$y = 7;
			$targetId = $ut->getId();
			$targetEntitaId = $ut->getEntitaId();

			$fu->spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId);

			write('Quattro possenti quercie si stagliano davanti a te'."\n");
		}
	}