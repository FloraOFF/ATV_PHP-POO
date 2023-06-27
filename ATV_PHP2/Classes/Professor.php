<?php
    //Classe Professor
    class Professor {
        private static $conn;
        private $data;

        //Método setConnection()
        public static function setConnection (PDO $conn) {
            self::$conn = $conn;
            ProfessorGateway::setConnection($conn);
        }//Fim do método setConnection()

        //Método __set()
        //Método mágico
        public function __set($prop, $value) {
            $this->data[$prop] = $value;
        }//Fim do método __set()

        //Método __get()
        public function __get($prop) {
            return $this->data[$prop];
        }//Fim do método __get()

        //Método find()
        public static function find($id) {
            $pdg = new ProfessorGateway;
            return $pdg->find($id, 'Professor');
        }//Fim do método find()

        //Método all()
        public static function all($filter = '') {
            $pdg = new ProfessorGateway;
            return $pdg->all($filter, 'Professor');
        }//Fim do método all()

        //Método delete()
        public function delete() {
            $pdg = new ProfessorGateway;
            return $pdg->delete($this->idProfessor);
        }//Fim do método delete()

        //Método save()
        public function save() {
            $pdg = new ProfessorGateway;
            return $pdg->save((object)$this->data);
        }//Fim do método save()
    }//Fim da classe Professor
?>