<?php
	Class Item13 extends Item{
		private $itemId = 13;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$Utente = &$this->OBJUtente;

			if($this->getItemQuantita() > 0){
				write($Utente->getNome().' apre il baule misterioso!'."\n");
				write('Hai ottenuto:'."\n");
				$msg = '';
				$sql = "SELECT TIPO_ITEM_ID AS ID, TIPO_ITEM_NOME AS NOME FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_ID <> ".$this->itemId." ORDER BY RAND() LIMIT ".rand(1, 5);
				$res = Database()->query($sql);
				while($row = $res->fetch_object()){
					$quantita = rand(1, 7);
					$Utente->gainItem($row->ID, $quantita);
					$msg .= $row->NOME.' x'.$quantita."\n";
				}
				$this->setItemQuantita($this->getItemQuantita() - 1);
				write($msg);
			}else{
				write('Non hai alcun baule misterioso!'."\n");
			}
		}
	}
