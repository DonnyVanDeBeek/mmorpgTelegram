<?php
	class Npc3 extends Npc{
		private $npcId = 3;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$str = '';

			if($this->getFlag() != 0)
				$num = 50 * $this->getFlag();
			else
				$num = 10;

			$str = '<b>Randomante</b>: "Ciao! Sono il randomante, vieni qui da me con '.$num.' cipolle e ti insegnerò una skill!'."\n";

			$Cipolla = new Cipolla($this->getUtente());

			if($Cipolla->getItemQuantita() >= $num){
				$str .= $this->teachRandomSkill();
				$this->setFlag($this->getFlag() + 1);
			}else{
				$str .= 'Mmhh... non hai abbastanza cipolle!"';
			}

			$str .= '"';

			write($str);
		}

		public function teachRandomSkill(){
			$skillId = array(3, 4, 5, 6, 7, 8);
			$n = count($skillId);

			$i = 0;
			do{
				$skill = rand(3, 8);
				$i++;
			}while($this->utente->hasUnlockedSkill($skill) && $i < 100);

			if($i < 100){
				$sql = "INSERT INTO BOT_RPG_LEARNED_SKILL VALUES($skill, ".$this->utente->getUtenteId().", 1)";
				Database()->query($sql);
				$sk = new Skill($skill);
				$msg = 'Bene! Ti ho insegnato <b>'.$sk->getSkillNome().'</b>! Vai subito a provare la tua nuova skill!';
			}else{
				$msg = 'Al momento non posso insegnarti nulla...';
			}

			return $msg;
		}
	}
