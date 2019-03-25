<?php
	Class Mob93 extends Mob{
		//BANDITO BARDO
		public function __construct($id){
			parent::__construct($id);
		}

		public function chooseWhatToDo(){
			$Intelligenza = new AI('MANTIENI_DISTANZA');
			$Intelligenza->setDealer($this);
			$Intelligenza->setTarget($this->target);
			$Intelligenza->run();
		}

}