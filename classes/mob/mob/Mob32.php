<?php
	Class Mob32 extends Mob{
		//TOTEM DELLA VITA
		public function __construct($id){
			parent::__construct($id);
		}

		public function doSomething(&$target){
			$memo = 'MOB_32_TURNI_VITA';
			if($this->isMemoSet($memo)){
				if($this->getMemo($memo) >= 5){
					$this->setMobHp(0);
					$this->die();
				}
				else{
					$turni = $this->getMemo($memo);
					$this->setMemo($memo, $turni + 1);
				}
			}
			else{
				$this->setMemo($memo, 1);
			}
		}

		public function die(){
			write($this->getNome().' cade a terra, perdendo la sua magia'."\n");
			$this->deleteAll();
		}

		public function subisciDanno(Danno $da){
			write($this->getNome().' cura '.$da->getDealer()->getNome().' con la sua benedizione'."\n");

			$Caster = $da->getDealer();
			$heal = $Caster->getPercentualeStat('HP', 5);
			$Caster->heal($heal);

			return true;
		}


	}