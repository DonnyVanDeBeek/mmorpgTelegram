<?php
	//BRIGANTE ADAM
	class Npc138 extends Npc{
		private $npcId = 138;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();

			if($Ut->getMemo('QUEST_2_CONSEGNA_LETTERA_ADAM') !== false){
				$menu = 'dopoConsegna';
				$this->tryToGetXML($menu);
				return;
			}

			$LetteraPerAdam = 229;
			if($Ut->hasTipoItem($LetteraPerAdam)){
				$menu = 'haLaLettera';
				$this->tryToGetXML($menu);
				return;
			}

			$this->speak();
		}

		public function custom_haLaLettera_ho_una_lettera($vars){
			$Ut = $this->getUtente();

			$LetteraPerAdam = 229;
			$Ut->togliItem($LetteraPerAdam);

			$Ut->setMemo('QUEST_2_CONSEGNA_LETTERA_ADAM', 1);

			write($this->getXMLVar('risposta', $vars));

			$this->backToMenu(0);
		}
	}