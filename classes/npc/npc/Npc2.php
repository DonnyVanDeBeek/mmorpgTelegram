<?php
	class Npc2 extends Npc{
		private $npcId = 2;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$str = '';
			$str .= '<b>Mastro Brugo</b>: ';

			switch($this->getFlag()){
				case 0:
					$ArgentoPuro = new ArgentoPuro($this->getUtente());
					if($ArgentoPuro->getItemQuantita() >= 5){
						$str .= "\"Salve, amico mio! Belli quei cinque argenti puri che porti teco, adesso però li prendo io!\"\n\n";
						$str .= "*<b>Mastro Brugo fruga nelle tue tasche</b>*\n\n";
						$str .= "<b>".$this->getUtente()->getNome()."</b>: \"Ma... questo è un furto bello e buono!\"\n\n";
						$str .= "<b>Mastro Brugo</b>: \"Suvvia, buon uomo... eccole un regalino!\"\n\n";
						$str .= "*<b>Mastro Brugo infila qualcosa nel tuo zaino... controlla il tuo equip!</b>*\n\n";
						$str .= "<b>Mastro Brugo</b>: \"Arrivederla, viandante!\"\n\n";

						$ArgentoPuro->setItemQuantita($ArgentoPuro->getItemQuantita() - 5);
						$this->getUtente()->giveEquip(4);
						$this->setFlag(1);

					}else{
						$str .= "\"Salve, viandante! Ha mai sentito parlare dell'argento puro? Ho sempre desiderato vederne almeno cinque pezzi insieme... chissà se riuscirò mai nel mio intento!\n Arrivederla, viandante!\"";
					}
				break;

				case 1:
					$str .= "\"Altissimo, levissimo, argento purissimo... eh? Che vuoi tu? Non ho più nulla da darti! Smamma!\"";
				break;
			}

			$this->addTimesTalked();
			write($str);
		}
	}
