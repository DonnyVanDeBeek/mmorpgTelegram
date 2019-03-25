<?php
	Class Punto{
		private $X;
		private $Y;
		private $sottoluogoId;

		public function __construct($X0, $Y0){
			$this->X = $X0;
			$this->Y = $Y0;
		}

		public function getX(){
			return $this->X;
		}

		public function getY(){
			return $this->Y;
		}

		public function getSottoluogoId(){
			return $this->sottoluogoId;
		}

		public function setSottoluogoId($a){
			$this->sottoluogoId = $a;
		}
	}