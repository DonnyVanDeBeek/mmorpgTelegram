<?php
	//[INTERATTIVO] MENU PRINCIPALE GILDA 1
	class Npc129 extends Npc{
		private $npcId = 129;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$flag = $this->getFlag();
			$text = $this->getText();

			$Ut = $this->getUtente();
			$Gilda = $Ut->getGilda();

			$menuPrincipale = new Keyboard();
			$menuPrincipale->push('Torna Indietro');
			$menuPrincipale->push('Consegna materiali');
			$menuPrincipale->push('Gerarchia');
			$menuPrincipale->push('Informazioni');


			if($flag == 0){
				write('<b>GILDA '.strtoupper($Gilda->get('NOME')).'</b>'."\n");
				write('Grado: '.$Gilda->getGradoNome($Ut->getGildaGradoId()));
				$this->setKeyFlagStatus($menuPrincipale, 1, 18);
			}

			if($flag == 1){
				switch($text){
					case 'Torna Indietro';
						write('Tornando indietro...');
						$this->backToMainMenu(0);
					break;

					case 'Consegna materiali';
						write('WIP');
					break;

					case 'Gerarchia';
						write('WIP');
					break;

					case 'Informazioni';
						write('WIP');
					break;
				}
			}

			//write($msg);
		}
	}