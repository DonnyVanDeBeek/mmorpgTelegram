<?php
	//OSTE ALEXANDRA
	class Npc48 extends Npc{
		private $npcId = 48;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$Ut = $this->getUtente();

			$questId = 1;

			if($Ut->hasClearedQuest($questId)){
				$this->speak();
			}else{
				$this->alexandraStartQuest();
			}
		}

		public function alexandraStartQuest(){
			$Ut = $this->getUtente();

			$questId = 1;

			//$lastClear = $Ut->getLastClearQuest($questId);
			//$lastClear = date('Y-m-d', strtotime($lastClear));
			//$today = date('Y-m-d');

			//$boolTime = $lastClear == $today;

			$boolTime = true;

			$s = $this->getSpeakNome();

			//$frasePocoTempoPassato = $s." Non mi servono altre cipolle per oggi, torna domani.\n";

			$fraseAssegnaQuest = $s." Ciao, sembri un tipo a posto, per questo mi rivolgo a te: è da tanto che i miei clienti non assaporano la squisita carne di cinghiale... il nostro fornitore di fiducia non si fa vivo da mesi. Portami 10 carni di cinghiale e avrai una ricompensa.\n Nel boschetto appena fuori città si aggirano alcuni cinghiali. Grazie in anticipo!\n";

			$fraseOnCleared = $s." Fantastico! Dopo tanto tempo la carne di cinghiale torna al Dragons! Te ne sono grata! Ma non penserai che ti lasci andar via a mani vuote, vero?\n";

			$fraseOnNotCleared = $s." La carne di cinghiale è squisita, imbottiamo i nostri migliori panini con essa.\n";

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