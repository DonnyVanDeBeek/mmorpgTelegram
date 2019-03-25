<?php
	class Skill143 extends Skill{
		//SCAGLIA DARDO
		private $id = 143;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function chose(){
			$this->getCaster()->scegliDardo();
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			$dmg = $Caster->getTotalStat('DESTREZZA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			if($Caster->isUtente()){
				$itemId = $Caster->getDynamicId();
				$className = 'Item'.$itemId;
				$Item = new $className($Caster);
			}

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->isRanged(true);


			if(!$Caster->isUtente()){
				$frase = $Caster->getNome() . " scaglia un dardo contro " . $Target->getNome(). "\n";
				write($frase);
			}

			if($Caster->isUtente()){
				$frase = $Caster->getNome() . " scaglia <b>".$Item->getTipoItemNome()."</b> contro " . $Target->getNome(). "\n";
				$catDardo = 100;
				if($Item->getItemQuantita() > 0 && $Item->getTipoItemCategoriaId() == $catDardo){
					write($frase);
					$Item->scagliaDardo($da);
				}
				else{
					write("Ti serve almeno un dardo per poter utilizzare questa skill!");
					return false;
				}
			}

			$da->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
