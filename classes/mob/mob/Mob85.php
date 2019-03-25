<?php
	Class Mob85 extends Mob{
		//COLLEZIONISTA DI ANIME
		public function __construct($id){
			parent::__construct($id);
		}

		public function dealDamage(Danno &$Danno){
			$hpMax = $Danno->getTarget()->getTotalStat('HP');
			$hpCur = $Danno->getTarget()->getHp();
			//hpMax : 100 = Hpcur : x
			$percHp = ($hpCur * 100) / $hpMax;
			
			if($percHp <= 40){
				$amp = 0.1;
			}

			if($percHp <= 20){
				$amp = 0.2;
			}			


			$dmg = $Danno->getDmg() + ($Danno->getDmg() * $amp); 
			$Danno->setDmg($dmg);
		}

		public function subisciDannoMagico(Danno $Danno){
			$dmg = $Danno->getDmg() * 0.85;
			$Danno->setDmg($dmg);
			parent::subisciDannoMagico($Danno);
		}

		public function subisciDannoContundente(Danno $Danno){
			$dmg = $Danno->getDmg() * 0.85;
			$Danno->setDmg($dmg);
			parent::subisciDannoContundente($Danno);
		}
	}