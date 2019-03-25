<?php
	//CIPOLLIVENDOLO ANTONIO
	class Npc124 extends Npc{
		private $npcId = 124;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$Ut = $this->getUtente();

			$questId = 0;

			$lastClear = $Ut->getLastClearQuest($questId);
			$lastClear = date('Y-m-d', strtotime($lastClear));
			$today = date('Y-m-d');

			$boolTime = $lastClear == $today;

			$s = $this->getSpeakNome();

			$frasePocoTempoPassato = $s." Non mi servono altre cipolle per oggi, torna domani.\n";

			$fraseAssegnaQuest = $s." Salve! Sa, io vendo cipolle. Che ne dice di portarmene 10 per avere in cambio una lauta ricompensa?\n";

			$fraseOnCleared = "Consegni al Cipollivendolo le 10 cipolle che ti aveva richiesto\n\n".$s." Davvero belle queste cipolle! Ottimo lavoro. Ti sei meritato un premio!\n";

			$fraseOnNotCleared = $s." Dove sono le mie dieci cipolle?!? Meglio che non cerchi di fregarmi!\n";

			$arr = array(
				'questId' => $questId,
				'boolTime' => $boolTime,
				'frasePocoTempoPassato' => $frasePocoTempoPassato,
				'fraseAssegnaQuest' => $fraseAssegnaQuest,
				'fraseOnCleared' => $fraseOnCleared,
				'fraseOnNotCleared' => $fraseOnNotCleared
			);
			$this->redirectToQuest($arr);
			
		}
	}