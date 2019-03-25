<?php
	class Skill57 extends Skill{
		//TRUCCHETTO INFIDO
		private $id = 57;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si mette a fintare " . $Target->getNome() . "\n");

			$lvl = $Caster->calculateRealLevel();
			$saggezza = $Target->provaDi('SAGGEZZA');
			$intelligenza = $Caster->provaDi('INTELLIGENZA') + $lvl + 5;


			if($intelligenza > $saggezza){
				switch(rand(0,2)){
					case 0:
						write($Target->getNome().'Non riesce a capire da che parte deve sferrare il suo attacco'."\n");

						$value = ($lvl + 10) * -1;
						$turni = 4;

						$DeBuff = new Buff();
						$DeBuff->setStat('PRECISIONE');
						$DeBuff->setTarget($Target);
						$DeBuff->setValue($value);
						$DeBuff->setTurni($turni);
						$DeBuff->send();
					break;

					case 1:
						write($Target->getNome().' preso dalla confusione, abbassa la guardia'."\n");

						$value = ($lvl + 20) * -1;
						$turni = 4;

						$DeBuff = new Buff();
						$DeBuff->setStat('ARMATURA');
						$DeBuff->setTarget($Target);
						$DeBuff->setValue($value);
						$DeBuff->setTurni($turni);
						$DeBuff->send();
					break;

					case 2:
						write($Target->getNome().' non realizza ciò che sta succedendo e si chiede come sia possibile che sia stato imbrogliato'."\n");

						$value = ($lvl + 20) * -1;
						$turni = 4;

						$DeBuff = new Buff();
						$DeBuff->setStat('INTELLIGENZA');
						$DeBuff->setTarget($Target);
						$DeBuff->setValue($value);
						$DeBuff->setTurni($turni);
						$DeBuff->send();
					break;
				}

				$Target->setMemo('STUN', 1 + $Target->getMemo('STUN'));
			}else{
				write($Target->getNome(). ' non ci casca!'."\n");
			}

			
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}