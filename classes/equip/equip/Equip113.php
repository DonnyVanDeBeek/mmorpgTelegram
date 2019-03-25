<?php
	//STOCCO LEGGENDARIO
	class Equip113 extends Equip{
		private $equipId = 113;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function buff(Danno &$Danno){
			if(rand(0,1) == 1)
				return false;

			$LvL = $this->getEquipLivello();
			$dmg = rand(50 + $LvL, 95 + $LvL);

			$frase = 'Un fulmine si abbatte su '.$Danno->getTarget()->getNome().'!';

			$D = new Danno();
			$D->setFrase($frase);
			$D->setDmg($dmg);
			$D->canBeDodged(false);
			$D->setTarget($Danno->getTarget());
			$D->setTipo("ELETTRICO");
			$Danno->addCollateralDamage($D);
		}
	}