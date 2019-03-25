<?php
	Class Mob38 extends Mob{
		//GOBLIN  BOMBAROLO
		public function __construct($id){
			parent::__construct($id);
		}

		public function esplodi(){
			write($this->getNome().' salta in aria! 💣'."\n");

			$Esplosione = new Danno();
			$Esplosione->setDmg(30 + $this->getLevel());
			$Esplosione->setTipo('ESPLOSIONE');
			$Esplosione->setPrecisione(99999);
			$Esplosione->setDealer($this);

			$arrTar = $this->getTargetsInRange(5);
			$n = count($arrTar);
			for($i = 0; $i < $n; $i++){
				if($arrTar[$i]->getEntitaId() != $this->getId() || $arrTar[$i]->getEntitaId() != $this->getEntitaId()){
					$Esplosione->setTarget($arrTar[$i]);
					$Esplosione->send();
				}
			}

			$this->deleteAll();
			$this->setHp(0);

		}

		public function subisciDannoEsplosione(Danno $Danno){
			write("La bomba di ".$this->getNome()." si innesca ed esplode! 💣\n");
			$this->setHp(0);
			$this->esplodi();
		}

		public function doSomething(&$target){
			$this->OBJUtente = $target;

			if(rand(0,9) > 5){
				write("Il goblin inciampa e cade per terra insieme alla sua bomba 💣\n");
				$this->esplodi();
				return true;
			}

			//$this->target = $target;
			$this->target = &$this->buildTarget($target);

			if($this->target == 'NO_MOB'){
				return false;
			}

			$this->loadSkills();

			$Intelligenza = new AI('AGGRESSIVE');
			$Intelligenza->setDealer($this);
			$Intelligenza->setTarget($this->target);
			$Intelligenza->run();
		}
	}
