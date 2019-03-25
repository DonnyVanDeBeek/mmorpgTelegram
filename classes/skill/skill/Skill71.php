<?php
	class Skill71 extends Skill{
		//SQUARTARE
		private $id = 71;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " fa calare l'arma sulla carne di " . $Target->getNome() . " per provocare una ferita profonda!\n");

			$forza = $Caster->getTotalStat('FORZA');
			$dmg = $forza * 1.15;

			$OT = new OverTime();
			$OT->setTipoOverTime('SANGUINAMENTO');
			$OT->setValue($forza * 0.25);
			$OT->setNumTurni(4);
			$OT->setTarget($Target);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("TAGLIENTE");
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE'));
			$da->setEquips($Equips);
			$da->setTarget($Target);

			if($Caster->provaDi('FORZA') > $Target->provaDi('COSTITUZIONE'))
				$da->addOverTimes($OT);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}