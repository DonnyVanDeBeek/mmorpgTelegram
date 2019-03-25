<?php
	Class Mob44 extends Mob{
		//FUNGUOMO
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDanno(Danno $Danno){
			parent::subisciDanno($Danno);

			$perc = 10;
			if(rand(0,100) < $perc){
				write($this->getNome().' rilascia delle spore velenose!'."\n");
				$this->rilasciaSporeVelenose();
			}

		}

		public function die(){
			write($this->getNome().', morendo, rilascia delle spore velenose!'."\n");
			$this->rilasciaSporeVelenose();
			parent::die();
		}

		public function subisciDannoVeleno(Danno $Danno){
			write($this->getNome() . ' è immune al veleno!');
			return 0;
		}

		public function subisciDannoSanguinamento(Danno $Danno){
			write($this->getNome() . ' è immune al sanguinamento!');
			return 0;
		}

		public function subisciDannoBruciatura(Danno $Danno){
			$dmg = $Danno->getDmg() * rand(2,4);
			$this->setMobHp($this->getMobHp() - $dmg);

			write($this->getNome() . ' patisce particolarmente il fuoco, subendo '.(int)$dmg.' danni da bruciatura! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function rilasciaSporeVelenose(){
			$OT = new OverTime();
			$OT->setTipoOverTime('AVVELENAMENTO');
			$OT->setValue(10 + $this->getLevel());
			$OT->setNumTurni(3);

			$Caster = &$this;

			$r = 1;
			$X = $this->getX();
			$Y = $this->getY();

			$points = array();

			$points[] = array('X' => $X, 'Y' => $Y);
			$points[] = array('X' => $X + $r, 'Y' => $Y);
			$points[] = array('X' => $X - $r, 'Y' => $Y);
			$points[] = array('X' => $X, 'Y' => $Y + $r);
			$points[] = array('X' => $X, 'Y' => $Y - $r);
			$points[] = array('X' => $X + $r, 'Y' => $Y + $r);
			$points[] = array('X' => $X + $r, 'Y' => $Y - $r);
			$points[] = array('X' => $X - $r, 'Y' => $Y + $r);
			$points[] = array('X' => $X - $r, 'Y' => $Y - $r);

			$n = count($points);
			for($i = 0; $i < $n; $i++){
				$x = $points[$i]['X'];
				$y = $points[$i]['Y'];
				if($Caster->isThereAnyEnemy($x, $y)){
					$Users = $Caster->getUserOBJHere($x, $y);
					$z = count($Users);
					for($j = 0; $j < $z; $j++){
						write($Users[$j]->getNome().' è vicino a '.$Caster->getNome()."\n");
						$OT->setTarget($Users[$j]);
						$OT->send();
					}

					$Mobs = $Caster->getMobArrOBJHere($x, $y);
					$z = count($Mobs);
					for($j = 0; $j < $z; $j++){
						//write($Mobs[$j]->getNome().' è vicino a '.$Caster->getNome()."\n");
						$OT->setTarget($Mobs[$j]);
						$OT->send();
					}
				}
			}
		}

		public function dealWithOverTime(OverTime &$OT){
			$Avvelenamento = 4;
			$tipo = $OT->getTipoOverTimeId();
			if($tipo == $Avvelenamento){
				$OT->cancel();
			}
		}
	}