<?php
    Class Danno{
        private $msg;
        private $dmg;
        private $tipo;
        private $entita;
        private $dealer;
        private $velocita;
        private $elemento;
        private $distanza;
        private $precisione;
        private $Target;
        private $buff = array();
        private $equips = array();
        private $overTimes = array();
        private $collateralDamage = array();
        private $frase = null;
        private $canBeDodged = true;

        //GETTERS
        public function send(){
            if(!$this->isMelee() && !$this->isRanged() && !$this->isSpell())
                $this->isMelee(true);

            if($this->getDealer() !== NULL){
                $Dea = $this->getDealer();

                if($this->getPrecisione() === null)
                    $this->setPrecisione($Dea->getTotalStat('PRECISIONE'));

                if($this->getPrecisione() <= 0)
                    $this->setPrecisione(1);

                $Dea->dealDamage($this);
                $Dea->triggerEquipsBuff($this);
                $Dea->triggerOvertimesBuff($this);
            }
            return $this->getTarget()->subisciDanno($this);
        }

        public function setTarget(&$a){
            $this->Target = $a;
        }

        public function canBeDodged($bool = null){
            if($bool !== null)
                $this->canBeDodged = $bool;
            else
                return $this->canBeDodged;
        }

        public function getTarget(){
            return $this->Target;
        }

        public function getBuff(){
            return $this->buff;
        }

        public function getOverTimes(){
            return $this->overTimes;
        }

        public function setOverTimes(&$a){
            $this->overTimes = $a;
        }

        public function addOverTimes(&$a){
            $this->overTimes[] = $a;
        }

        public function addOverTime(&$a){
            $this->overTimes[] = $a;
        }

        /*
        public function addOvertime(&$a){
            $this->overTimes[] = $a;
        }
        */

        public function getEquips(){
            return $this->equips;
        }

        public function addEquips(&$a){
            $this->equips[] = $a;
        }

        public function setEquips($a){
            $this->equips = $a;
        }

        public function addBuff(&$a){
            $this->buff[] = $a;
        }

        public function setBuff($a){
            $this->buff = $a;
        }

        public function getPrecisione(){
            return $this->precisione;
        }

        public function getVelocita(){
            return $this->velocita;
        }

        public function getDistanza(){
            return $this->distanza;
        }

        public function getMsg(){
            return $this->msg;
        }

        public function getDealer(){
            return $this->dealer;
        }

        public function getDmg(){
            return $this->dmg;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function getElemento(){
            return $this->elemento;
        }

        public function getEntita(){
            return $this->entita;
        }

        public function notDodgeable(){
            $this->precisione = 9999999;
        }

        //SETTERS
        public function setPrecisione($a){
            $this->precisione = $a;
        }

        public function setVelocita($a){
            $this->velocita = $a;
        }

        public function setDistanza($a){
            $this->distanza = $a;
        }

        public function setMsg($a){
            $this->msg = $a;
        }

        public function setDmg($a){
            $this->dmg = $a;
        }

        public function setTipo($a){
            $this->tipo = $a;
        }

        public function setElemento($a){
            $this->elemento = $a;
        }

        public function setEntita($a){
            $this->entita = $a;
        }

        public function setDealer($a){
            $this->dealer = $a;
        }

        public function setCaster(&$a){
            $this->dealer = $a;
        }

        public function getCaster(){
            return $this->dealer;
        }

        protected $succeded = true;
        public function hasSucceded($bool = null){
            if($bool !== null)
                $this->succeded = $bool;
            else
                return $this->succeded;
        }

        protected $dodged;
        public function isDodged(){
            return $this->dodged;
        }

        public function setDodged($bool){
            $this->dodged = $bool;
        }

        public function modifier($perc){
            $this->dmg = $this->getDmg() * $perc;
        }

        protected $melee = false;
        protected $ranged = false;
        protected $spell = false;

        public function isMelee($bool = null){
            if($bool !== null)
                $this->melee = $bool;
            else
                return $this->melee;
        }

        public function isRanged($bool = null){
            if($bool !== null)
                $this->ranged = $bool;
            else
                return $this->ranged;
        }

        public function isSpell($bool = null){
            if($bool !== null)
                $this->spell = $bool;
            else
                return $this->spell;
        }

        public function setFrase($frase){
            $this->frase = $frase;
        }

        public function getFrase(){
            return $this->frase;
        }

        public function getCollateralDamage(){
            return $this->collateralDamage;
        }

        public function addCollateralDamage(&$a){
            $this->collateralDamage[] = $a;
        }

        public function setCollateralDamage(&$a){
            $this->collateralDamage = $a;
        }

    }
