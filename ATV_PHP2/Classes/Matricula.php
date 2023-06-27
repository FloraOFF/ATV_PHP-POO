<?php
    class Matricula{
        private static $conn;
        private $data;
    
        //Método setConnection()
        public static function setConnection(PDO $conn) {
            self::$conn = $conn;
            MatriculaGateway::setConnection($conn);
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
        public function find($id) {
            $pdg = new MatriculaGateway;
            return $pdg->find($id, 'Matricula');
        }//Fim do método find()

        //Método all()
        public function all($filter = '') {
            $pdg = new MatriculaGateway;
            return $pdg->all($filter, 'Matricula');
        }//Fim do método all()

        //Método delete()
        public function delete () {
            $mgd = new MatriculaGateway;
            return $mdg->delete($this->idMatricula);
        }//Fim do método delete()
    
        //Método save()
        public function save() {
            $mdg = new MatriculaGateway;
            return $mdg->save((object) $this->data);
        }//Fim do método save()

        //Método getDisciplinasECursosByAlunos()
        public function getDisciplinasECursosByAlunos($filter = '') {
            $matriculasGateway = new MatriculaGateway();
            return $matriculasGateway->getDisciplinasECursosByAlunos($filter, 'Matricula');
        }//Fim do método getDisciplinasECursosByAlunos()

        //Método getDisciplinasCursosByAluno()
        public function getDisciplinasCursosByAluno($filter = '') {
            $matriculaGateway = new MatriculaGateway();
            return $matriculaGateway->getDisciplinasECursosByAlunos($filter);
        }//Fim do método getDisciplinasCursosByAluno()
    }//Fim da classe Matricula
    
?>