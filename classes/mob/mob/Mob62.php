<?php
	Class Mob62 extends Mob{
		//DEMONIO GOBLIN
		public function __construct($id){
			parent::__construct($id);
		}

		public function applicaBruciatura(){
			write($this->getNome().' da improvvisamente fuoco a '.$this->OBJUtente->getNome()."!\n");
			$Bruc = new OverTime();
			$Bruc->setNumTurni(3);
			$Bruc->setValue(10);
			$Bruc->setTipoOverTime('BRUCIATURA');
			$Bruc->setTarget($this->OBJUtente);
			$Bruc->send();
		}

		public function applicaPoteriDemoniaci(){
			write($this->getNome().' incanta '.$this->OBJUtente->getNome()." fornendogli incredibili poteri!\n");
			$Bruc = new OverTime();
			$Bruc->setNumTurni(2);
			$Bruc->setValue(0);
			$Bruc->setTipoOverTime('POTERI DEMONIACI');
			$Bruc->setTarget($this->OBJUtente);
			$Bruc->send();
		}

		public function doSomething(&$target){
			$this->OBJUtente = $target;

			if(rand(0,1) == 1){
				$this->applicaBruciatura();
			}else{
				$this->applicaPoteriDemoniaci();
			}

			$this->moveTowards($target);
		}

		public function changeFocus($targetId, $entitaId){
			return false;
		}
	}