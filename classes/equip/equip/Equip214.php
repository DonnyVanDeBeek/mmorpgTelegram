<?php
	//ARCO FATATO
	class Equip214 extends Equip{
		private $equipId = 214;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function buff(Danno &$Danno){
			$LvL = $this->getEquipLivello();
			$dmg = rand(5 + $LvL, 25 + $LvL);

			$D = new Danno();
			$D->setDmg($dmg);
			$D->canBeDodged(false);
			$D->setTarget($Danno->getTarget());
			$D->setTipo("MAGICO");
			$Danno->addCollateralDamage($D);
		}
	}