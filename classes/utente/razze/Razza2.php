<?php
	Class Razza2 extends Utente{
		private $target;

		public function __construct($UTENTE_ID){
			parent::__construct($UTENTE_ID);
		}

		public function subisciDannoMagico(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('SALVAMAGIA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $dmg * ($perc / 100);

			if(rand(0,1) == 0){
				$dmg = $Danno->getDmg() * 0.1;
				write('Magirifrangente Gnomesco si attiva! I danni magici vengono ridotti notevolmente'."\n");
			}

			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni magici! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function dealDamage(Danno &$D){
			if($D->getTipo() == 'MAGICO'){
				$dmg = $D->getDmg() * 1.5;
				$D->setDmg($dmg);
			}
		}

		public function dealWithBuff(Buff &$Buff){
			if($Buff->getStat() == "MAGIA" && $Buff->getValue() < 0){
				$Buff->setValue(0);
				$Buff->cancel();
				write($this->getNome()' è immune ai debuff alla magia in qualità di gnomo');
			}
		}

	}
