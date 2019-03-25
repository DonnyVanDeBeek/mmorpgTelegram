<?php
	class Skill144 extends Skill{
		//LANCIO
		private $id = 144;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function chose(){
			$this->getCaster()->scegliLanciabile();
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			if($Caster->isUtente()){
				$itemId = $Caster->getDynamicId();
				$className = 'Item'.$itemId;
				$Item = new $className($Caster);
			}else {
				write('I mob non possono usare questa skill!');
				return false;
			}

			$prec = $Caster->getTotalStat('PRECISIONE');

			$Da = new Danno();
			$Da->isRanged(true);
			$Da->setDmg(0);
			$Da->setPrecisione($prec);
			$Da->setTipo('FISICO');
			$Da->setDealer($Caster);
			$Da->setTarget($Target);

			$frase = $Caster->getNome() . " lancia <b>".$Item->getTipoItemNome()."</b> addosso a " . $Target->getNome(). "\n";

			if(!$Caster->isUtente())
				write($frase);

			if($Caster->isUtente()){
				if($Item->getItemQuantita() > 0){
					write($frase);
					$Item->throw($Da);
				}
				else{
					write("Ti serve almeno oggetto lanciabile!");
					return false;
				}
			}

			//$Da->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
