<?php
	class Skill56 extends Skill{
		//AH VADO KEDABRO
		private $id = 56;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " scaglia un anatema proibito a " . $Target->getNome() . "!" . "\n");

			$magia = $Caster->getTotalStat('MAGIA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			$dmg = $magia * 0.75;
			$dmg = intval($dmg);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PURO");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$da->send();

			$saggezza = 100;
			if($Caster->provaDi('SAGGEZZA') > rand(0, $saggezza)){
				write('L\'anatema è così potente da scagliare '.$Target->getNome().' all\'indietro!');
				$Target->moveAwayFrom($Caster);
			}

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}