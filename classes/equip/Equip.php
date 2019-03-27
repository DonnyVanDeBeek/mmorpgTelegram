<?php
    interface interface_equip{
        #Battaglia
        public function onAttack(&$target); #Prima di sferrare un'attacco

        public function onDefense(&$dealer); #Funzione deprecata(?) Usare onGetHitten

        public function buff(Danno &$Danno); #Potenzia il danno prima di scagliarlo

        public function debuff(Danno &$Danno); #Indebolisce il danno prima che il possessore lo riceva

        public function onHit(&$target); #Quando il possessore colpisce

        public function onGetHitten(&$dealer); #Quando il possessore viene colpito

        public function effect(); #A fine turno
    }

    class Equip extends TipoEquip implements interface_equip{
        private $equipId;
        private $equipAttivo;
        private $equipLivello;
        private $equipUtenteId;
        private $equipTipoEquipId;

        private $db;

        public $equipCategoria = "undefined";

        private $tableName = 'BOT_RPG_EQUIP';

        public function __construct($id, &$ut = null){
            global $con;
            $this->db = $con->getDB();

            if($ut !== null)
                $this->utente = $ut;

            $q = "SELECT * FROM BOT_RPG_EQUIP WHERE EQUIP_ID = ".$id;
            $res = $this->db->query($q);

            $flag = false;
            if(isset($this->utente))
                if($this->utente->getEntitaId() == 1)
                    $flag = true;


            if($flag){
                $this->tableName = 'BOT_RPG_MOB_EQUIP';
                $q = "SELECT * FROM ".$this->tableName." WHERE EQUIP_ID = ".$id;
               // $US = new Utente(12);
                //$US->sendMessage($q);
                $res = $this->db->query($q);
                $row = $res->fetch_object();

                $this->equipId = $row->EQUIP_ID;
                $this->equipAttivo = $row->EQUIP_ATTIVO;
                $this->equipLivello = $row->EQUIP_LIVELLO;
                $this->equipUtenteId = $row->EQUIP_MOB_ID;
                $this->equipTipoEquipId = $row->EQUIP_TIPO_EQUIP_ID;

            }else{
                //$US = new Utente(12);
                //$US->sendMessage($q.'||'.$this->utente->getNome());
                $row = $res->fetch_object();

                $this->equipId = $row->EQUIP_ID;
                $this->equipAttivo = $row->EQUIP_ATTIVO;
                $this->equipLivello = $row->EQUIP_LIVELLO;
                $this->equipUtenteId = $row->EQUIP_UTENTE_ID;
                $this->equipTipoEquipId = $row->EQUIP_TIPO_EQUIP_ID;
            }

            parent::__construct($this->equipTipoEquipId);
        }

        protected $utente;

        public function getUtente(){
            return $this->utente;
        }

        public function setUtente(&$a){
            $this->utente = $a;
        }

        public function getEquipId(){
            return $this->equipId;
        }

        public function getEquipAttivo(){
            return $this->equipAttivo;
        }

        public function getEquipLivello(){
            return $this->equipLivello;
        }

        public function getEquipUtenteId(){
            return $this->equipUtenteId;
        }

        public function getEquipTipoEquipId(){
            return $this->equipTipoEquipId;
        }

        public function getId(){
            return $this->equipId;
        }

        public function setEquipLivello($a){
            $sql = "UPDATE BOT_RPG_EQUIP SET EQUIP_LIVELLO = $a WHERE EQUIP_ID = ".$this->getEquipId();
            Database()->query($sql);
            $this->equipLivello = $a;
        }

        public function onAttack(&$target){
            //$this->msg['ON_ATTACK'] = '';
            return false;
        }

        public function onDefense(&$dealer){
            //$this->msg['ON_ATTACK'] = '';
            return false;
        }

        public function buff(Danno &$Danno){
            return false;
        }

        public function debuff(Danno &$Danno){
            return false;
        }

        public function onHit(&$target){
            return false;
        }

        public function onGetHitten(&$dealer){
            return false;
        }

        public function effect(){
            return false;
        }

        public function buffCustom(&$Danno){
            return false;   
        }

        public function isActive(){
            if($this->getEquipAttivo() == 1)
                return true;
            else
                return false;
        }

        public function upgrade(&$ut){
            $LvL = $this->getEquipLivello();
            if($LvL > 23){
                write($this->getTipoEquipNome() . ' è al livello massimo!'."\n");
                return false;
            }

            $n = 0;

            $Ut = $ut;//new Utente($this->getEquipUtenteId());

            if(!$Ut->hasTipoItem(99)){
                write("Ti serve una Piccola Forgia Magica per potenziare l'equip!");
                return false;
            }

            $Ut->togliItem(99);

            /*
            $messageId = $Ut->sendMessage('Upgrade in corso...');
            //$Ut->sendMessage('id: '.$messageId);
            //sleep(rand(3,5));
            for($i = 5; $i > $n; $i--){
                //sleep(rand(1,4));
                $perc1 = 6-$i;
                $rmz = $perc1 != 5 ? rand($perc1*20, $perc1*20+19) : 100;
                $string = $rmz.'%'."\n".str_repeat('⬜', intVal($rmz/10));
                $Ut->editMessage($messageId, $string);
            }
            */

            //sleep(1);
            //$sql = "SELECT EQUIP_PERC FROM BOT_RPG_UPGRADE_EQUIP_LEVEL_PERC WHERE EQUIP_LEVEL = ".$this->getEquipLivello();
            //$perc = Database()->query($sql)->fetch_object()->EQUIP_PERC;

            $upgrade = array(100, 100, 100, 99, 95, 90, 85, 80, 75, 70, 65, 60, 50, 30, 25, 20, 15, 10, 8, 7, 5, 3, 1);
            $perc = $upgrade[$LvL];

            $rand = rand(1, 100);

            $sub = rand(1, 3);

            $diff = rand(1, 3);
            if($LvL == 22) $diff = rand(1,2);
            if($LvL == 23) $diff = 1;

            //$Ut->deleteMessage($messageId);

            if($rand <= $perc){
                $this->setEquipLivello($LvL + $diff);
                write('<b>'.$this->getTipoEquipNome().' è salito al livello '.$this->getEquipLivello().'</b>');
                write(str_repeat(GREEN_CHECKMARK, 10));
                $success = true;
            }
            else{
                $this->setEquipLivello($LvL - $sub);
                write('<i>'.$this->getTipoEquipNome().' è sceso al livello '.$this->getEquipLivello().'</i>');
                write(str_repeat(RED_CROSS, 10));
                $success = false;
            }

            if($this->getEquipLivello() >= 18 && $success){
                $Ut = new Utente($this->getEquipUtenteId());
                $chan = '<b>'.$Ut->getNome() . ' ha migliorato ' . $this->getTipoEquipNome() . ' al livello ' . $this->getEquipLivello() . '!</b>';
                writeChannel($chan);
            }

            return true;
        }

        public function printEquipInfo(){
            $eq = &$this;
            $msg = '';
            $rune = '';
            $msg .= '<b>'.$eq->getTipoEquipNome() . '</b> (+'.$eq->getEquipLivello().')' . "\n";
            $q = "SELECT STAT_ID, VALUE FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$eq->getTipoEquipId();
            $res = $this->db->query($q);
            if($res->num_rows == 0) write($msg . $eq->getTipoEquipNome().' non ha statistiche'."\n\n");
            while($row = $res->fetch_object()){
                $st = new Stat($row->STAT_ID);
                $value = $eq->getEquipLivello() == 1 ? $row->VALUE : (int)($row->VALUE * $eq->getEquipLivello()/9) + $row->VALUE;
                $msg .= getEmojiStats()[strtoupper($st->getStatNome())].$st->getStatNome() ." <i>". $value . "</i>\n";
            }
            $msg .= "\n";

            $q = "SELECT STAT_ID, VALUE FROM BOT_RPG_STAT_EQUIP_RUNE WHERE EQUIP_ID = ".$eq->getId();
            $res = $this->db->query($q);
            while($row = $res->fetch_object()){
                $st = new Stat($row->STAT_ID);
                $runa = $row->VALUE;//$this->getStatRuna($row->STAT_ID);
                if($runa != 0){

                    $sign = '+';
                    if($runa < 0)
                        $sign = '-';

                    $rune .= getEmojiStats()[strtoupper($st->getStatNome())].$st->getStatNome() ." <i>". $sign.abs($runa) . "</i>\n";
                }
            }

            if($rune != '')
                $msg .= "<b>Rune</b>\n$rune\n";

            $msg .= $this->isActive() ? '<b>Equipaggiato</b>' : '<i>Non Equipaggiato</i>';
            $msg .= "\n";
            $msg .= "\n".$this->getTipoEquipDescrizione()."\n";

            $msg .= '<a href = "'.$this->getTipoEquipImgpath().'"> </a>';
            write($msg);
        }

        public function getStatRuna($statId){
            $id = $this->getId();
            $sql = "SELECT SUM(VALUE) AS VALUE FROM BOT_RPG_STAT_EQUIP_RUNE WHERE EQUIP_ID = $id AND STAT_ID = $statId";
            $res = Database()->query($sql);

            if($res->num_rows != 1)
                return 0;
            else
                return $res->fetch_object()->VALUE;
        }

        public function setStatRuna($arr){
            //Struttura di $arr: array('statId' => 0, 'value' => 0)
            $n = count();
        }

        public function incastona(&$Item){
            return $Item->incastona($this);
        }

        public function addStatRuna($arr){
            //Struttura di $arr: array('statNome' => 0, 'value' => 0)
            $n = count($arr);
            $equipId = $this->getId();
            $this->deleteAllStatRuna();

            for($i = 0; $i < $n; $i++){
                $value = $arr[$i]['value'];
                $statId = Functions::getStatIdFromName($arr[$i]['statNome']);
                $sql = "INSERT INTO BOT_RPG_STAT_EQUIP_RUNE VALUES($equipId, $statId, $value)";
                Database()->query($sql);
            }
        }

        public function deleteAllStatRuna(){
            $id = $this->getId();
            $sql = "DELETE FROM BOT_RPG_STAT_EQUIP_RUNE WHERE EQUIP_ID = $id";
            Database()->query($sql);
        }

        public function canBeActivated(){
            return true;
        }


    }
