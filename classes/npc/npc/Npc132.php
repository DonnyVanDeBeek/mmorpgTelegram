<?php
	//SPECCHIO SUL MURO
	class Npc132 extends Npc{
		private $npcId = 132;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			parent::talk();
			return;

			$this->addTimesTalked();
			
			$Ut = $this->getUtente();
			$text = $this->getText();
			$flag = $this->getFlag();
			
			$keyboard1 = new Keyboard();
			$keyboard1->push("Guarda");
			$keyboard1->push("Rompi");
			
			$keyboard2 = new Keyboard();
			$keyboard2->push("Guarda Attentamente");
			$keyboard2->push("Fissa i tuoi occhi");
			
			$keyboard3 = new Keyboard();
			$keyboard3->push("Raccogli i cocci");
			$keyboard3->push("lancia i cocci contro il barista");
			
			$keyboard4 = new Keyboard();
			$keyboard4->push("Prendi a pugni il barista");
			$keyboard4->push("Urla al barista");

			if($flag == 0){
				write("Testo iniziale. Scegli azione ");
				$this->setKeyFlagStatus($keyboard1, 1, 18);
			}
			
			if($flag == 1){
			
				switch($text){
			
			
				case 'Guarda':
					write("Guardi lo specchio");
					$this->setKeyFlagStatus($keyboard2 , 2 , 18);
				break;
				
				
				case 'Rompi':
					write("Hai rotto lo specchio");
					$this->setKeyFlagStatus($keyboard3 , 3 , 18);
				break;
				
				default:
					write("Scegli un opzione valida");
					$this->setKeyFlagStatus($keyboard1, 1, 18);
	
				}
			}
	
			if($flag == 2){
	
				switch($text){


					case 'Guarda Attentamente':
						write("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaanon vedi nulla di particolare");	
					$this->backToMainMenu(0);	
					break;	
	
	
					case 'Fissa i tuoi occhi':
						write("Appare un mostro parte la battaglia");
						$this->backToMainMenu(0);
					break;
	
				default:
					write("Scegli un opzione valida");
					$this->setKeyFlagStatus($keyboard2, 2, 18);
	
				}
			}
	
			if($flag == 3){
	
				switch($text){
	
	
					case 'Raccogli i cocci':
						write("provi a raccogliere i cocci ma ti tagli e lasci perdere");
						$this->backToMainMenu(0);
					break;
				
				
					case 'lancia i cocci contro il barista':
						write("provi a lanciare i cocci contro il barista ma vieni schiaffeggiato da luiccpersona");
						$this->setKeyFlagStatus($keyboard4 , 4 , 18);
					break;
				
					default:
						write("Scegli un opzione valida");
						$this->setKeyFlagStatus($keyboard3, 3, 18);
	
				}
			}
		
			if($flag == 4){
	
				switch($text){
	
	
					case 'Prendi a pugni il barista':
						write("nel tentativo lui ti picchia ti butta fuori dal bar");
						$this->backToMainMenu(0);
					break;
	
	
					case 'Urla al barista':
						write("lui ti ignora bellamente");
						$this->backToMainMenu(0);
					break;
	
	
				}
			}
	
		}
	}