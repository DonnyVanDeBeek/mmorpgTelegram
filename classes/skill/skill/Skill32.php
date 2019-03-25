<?php
	class Skill32 extends Skill{
		//RICHIAMO LUPESCO
		private $id = 32;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			$maxLupi = 5;
			$Lupo = 3;

			$Lupi = $Caster->getTargetsOfCategoriaInRange($Lupo);
			$numLupi = count($Lupi);
			//write('NumLupi: '.$numLupi);

			$percRiuscita = 40;
			if($numLupi < $maxLupi){
				write($Caster->getNome().' ulula, come per richiamare un lupo!');
				if(Functions::percentuale($percRiuscita)){
					$mob = array();
					$mob['ID'] = 1;
					$mob['UTENTE_ID'] = $Caster->getTargetId();
					$mob['LVL'] = $Caster->getLevel();
					$mob['X'] = $Caster->getX();
					$mob['Y'] = $Caster->getY();
					$mob['TARGET_ID'] = $Caster->getTargetId();
					$mob['TARGET_ENTITA_ID'] = 0;
					$mob['HP'] = Functions::getTipoMobMaxHp(1, $Caster->getLevel());
					$Caster->summonMob($mob);
					write('Un lupo ha risposto al richiamo!');
				}else{
					write('Non succede nulla...');
				}
			}else{
				if($Caster->getEntitaId() == 0)
					write('Ci sono troppi lupi per richiamarne un\'altro!');
				return false;
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}