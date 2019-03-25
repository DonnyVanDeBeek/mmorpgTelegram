<?php
	class Skill55 extends Skill{
		//FENDENTE STREMANTE
		private $id = 55;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " pianta un colpo di incredibile potenza contro " . $Target->getNome() . " traendo forza da ogni parte del suo corpo!" . "\n");

			$dmg = $Caster->getTotalStat("FORZA") * 2;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("CONTUNDENTE");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
		
			write($Caster->getNome().' si sente estremamente esausto e indebolito'."\n");

			$value = $Caster->getPercentualeStat('FORZA', 25) * -1;
			$turni = 5;

			$DForza = new Buff();
			$DForza->setStat('FORZA');
			$DForza->setTarget($Caster);
			$DForza->setValue($value);
			$DForza->setTurni($turni);

			$value = $Caster->getPercentualeStat('DESTREZZA', 25) * -1;
			$turni = 5;

			$DDestrezza = new Buff();
			$DDestrezza->setStat('DESTREZZA');
			$DDestrezza->setTarget($Caster);
			$DDestrezza->setValue($value);
			$DDestrezza->setTurni($turni);

			$value = $Caster->getPercentualeStat('COSTITUZIONE', 25) * -1;
			$turni = 5;

			$DCostituzione = new Buff();
			$DCostituzione->setStat('COSTITUZIONE');
			$DCostituzione->setTarget($Caster);
			$DCostituzione->setValue($value);
			$DCostituzione->setTurni($turni);

			$DForza->send();
			$DDestrezza->send();
			$DCostituzione->send();


			return true;
		}
	}