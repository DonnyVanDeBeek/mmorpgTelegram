<?php
	class Skill23 extends Skill{
		//PULSAZIONE SONORA
		private $id = 23;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			//$Target = $this->getTarget();
			//$Equips = $this->getEquips();

			$dmg = $Caster->getPercentualeStat('MAGIA', 50);

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo("MAGICO");
			$Danno->setPrecisione(500);
			//$Danno->setTarget($Target);

			$this->overtimeBuff($Danno);

			$X = $Caster->getX();
			$Y = $Caster->getY();

			$points = array();

			$points[] = array('X' => $X, 'Y' => $Y);
			$points[] = array('X' => $X + 1, 'Y' => $Y);
			$points[] = array('X' => $X - 1, 'Y' => $Y);
			$points[] = array('X' => $X, 'Y' => $Y + 1);
			$points[] = array('X' => $X, 'Y' => $Y - 1);
			$points[] = array('X' => $X + 1, 'Y' => $Y + 1);
			$points[] = array('X' => $X + 1, 'Y' => $Y - 1);
			$points[] = array('X' => $X - 1, 'Y' => $Y + 1);
			$points[] = array('X' => $X - 1, 'Y' => $Y - 1);

			write($Caster->getNome().' urla con la testa rivolta verso l\'alto, emettendo delle <b>pulsazioni sonore</b>'."\n");

			$n = count($points);
			for($i = 0; $i < $n; $i++){
				$x = $points[$i]['X'];
				$y = $points[$i]['Y'];
				if($Caster->isThereAnyEnemy($x, $y)){
					$Mobs = $Caster->getMobArrOBJHere($x, $y);
					$z = count($Mobs);
					for($j = 0; $j < $z; $j++){
						write($Mobs[$j]->getNome().' è vicino a '.$Caster->getNome()."\n");
						$Danno->setTarget($Mobs[$j]);
						$Danno->send();
					}
				}
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}