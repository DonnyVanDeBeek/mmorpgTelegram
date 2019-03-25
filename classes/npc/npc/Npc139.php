<?php
	//BRIGANTE TONIO
	class Npc139 extends Npc{
		private $npcId = 139;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			//parent::talk();
			//return;

			$this->addTimesTalked();

			$questId = 2;
			$Ut = $this->getUtente();

			/*
			$this->backToMenu(0);
			write('ok');
			return;
			*/

			$menu = 'base';

			if($Ut->isQuestAlreadyStarted($questId))
				$menu = 'duranteQuest';

			if($Ut->hasClearedQuest($questId))
				$menu = 'dopoQuest';

			$this->tryToGetXML($menu);
		}

		public function startThisQuest(){
			$Ut = $this->getUtente();

			$LetteraPerAdam = 229;
			$quantita = 1;
			$Ut->giveItem($LetteraPerAdam, $quantita, true);

			$questId = 2;
			$Ut->startQuest(2, true);
		}

		public function custom_base_interessante_voglio_aiutarti($risp){
			$Ut = $this->getUtente();

			$risposta = $this->getXMLVar('risposta', $risp);
			write($risposta);

			$this->startThisQuest();

			$this->backToMenu(0);
		}

		public function custom_base_si_dammi_qua($risp){
			$Ut = $this->getUtente();

			$risposta = $this->getXMLVar('risposta', $risp);
			write($risposta);

			$this->startThisQuest();

			$this->backToMenu(0);
		}

		public function isVisibile_base_chiedigli_cosa_vuole($vars){
			$carismaMinimo = intVal($this->getXMLVar('carisma_minimo', $vars));
			$carisma = $this->getUtente()->getTotalStat('CARISMA');

			//$this->getUtente()->sendMessage('__'.$carismaMinimo.'__'.$carisma);

			if($carisma >= $carismaMinimo)
				return true;
			else
				return false;
		}

		public function custom_duranteQuest_certo_che_si($vars){
			$questId = 2;
			//$this->getUtente()->sendMessage(print_r($vars, TRUE));
			$onTrue = $this->getXMLVar('consegnata', $vars);
			$onFalse = $this->getXMLVar('non_consegnata', $vars);
			$this->checkQuest($questId, $onTrue, $onFalse);
			$this->backToMenu(0);
		}
	}