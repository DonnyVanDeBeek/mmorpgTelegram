<?php
	Class Mob12 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function die(){
			if($this->isMemoSet('RESUSCITATO')){
				parent::die();
			}else{
				write($this->getNome().' risorge dalle sue ceneri!'."\n");
				$this->setMobHp(100);
				$this->setMemo('RESUSCITATO', 0);
			}
		}
	}
