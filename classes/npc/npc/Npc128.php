<?php
	//[INTERATTIVO] LABIRINTO DI DEDALO
	class Npc128 extends Npc{
		private $npcId = 128;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$sottoluogoId = 10;

			$esce = false;
			if(rand(0,1000) == 999)
				$esce = true;

			if($this->getText() == "Rinuncia"){
				write("Rinunci a trovare l'uscita. Dopo pochi minuti riesci a ritrovare l'entrata. Il dedalo è magico.");
				$this->backToMainMenu(0);
				return false;
			}

			if($esce){
				write("Riesci a uscire dal dedalo.");
				$this->getUtente()->setSottoluogoId($sottoluogoId);
				$this->backToMainMenu(0);
				return true;
			}

			$n = rand(2,7);

			$opzioni = new Keyboard();

			for($i = 1; $i < $n+1; $i++){
				$string = "Porta $i";
				$opzioni->push($string);
			}

			$opzioni->push("Rinuncia");

			write("La porta che hai scelto ti porta in una stanza completamente diversa dalla precedente.\nScegli una tra la $n porte");

			$this->setKeyFlagStatus($opzioni, 0, 18);

		}
	}