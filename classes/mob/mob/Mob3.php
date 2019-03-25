<?php
	Class Mob3 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoBruciatura(Danno $Danno){
			write($this->getNome() .' è immune alla bruciatura. Come mai un cinghiale è immune alle bruciature ti stai chiedendo? Semplicemente è solo un test per verificare che l\'immunità funzioni. I cinghiali arrosto sono molto buoni, comunque.');
		}
	}
