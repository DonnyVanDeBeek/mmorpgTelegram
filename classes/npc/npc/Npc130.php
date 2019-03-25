<?php
	//[SKILL_SCELTA] SCEGLI DARDO
	class Npc130 extends Npc{
		private $npcId = 130;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$text = $this->getText();
			$flag = $this->getFlag();
			$Ut = $this->getUtente();

			if($flag == 0){
				write('Scegli il dardo da scagliare');
				$categorieId = array(100);
				$arr = $Ut->selectItemsByCategorieId($categorieId);
				$keyCat = new Keyboard();
				$n = count($arr);
				if($n == 0){
					write("Ti serve almeno un dardo per utilizzare questa skill!");
					$this->setKeyFlagStatus(kBattle(), 0, 3);
					return false;
				}

				for($i = 0; $i < $n; $i++){
					$keyCat->push($arr[$i]);
				}

				$this->setKeyFlagStatus($keyCat, 1, 18);
			}

			if($flag == 1){
				if(Functions::itemNameExist($text)){
					$id = Functions::getTipoItemIdByName($text);
					if(!$Ut->hasTipoItem($id)){
						write('Non possiedi questo item.');
						return false;
					}
					$Ut->setDynamicId($id);
					write('Dardo selezionato');
					$this->setKeyFlagStatus(kBattle(), 0, 3);
				}else{
					write("Questo item non esiste");
					return false;
				}
			}
		}
	}