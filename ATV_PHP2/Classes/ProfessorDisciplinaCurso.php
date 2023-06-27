<?php
    class ProfessorDisciplinaCurso{
        private static $conn;
        private $data;
    
        //Método setConnection()
        public static function setConnection(PDO $conn) {
            self::$conn = $conn;
            ProfessorDisciplinaCursoGateway::setConnection($conn);
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
            $pdg = new ProfessorDisciplinaCursoGateway;
            return $pdg->find($id, 'ProfessorDisciplinaCurso');
        }//Fim do método find()

        //Método all()
        public function all($filter = '') {
            $pdg = new ProfessorDisciplinaCursoGateway;
            return $pdg->all($filter, 'ProfessorDisciplinaCurso');
        }//Fim do método all()

        //Método delete()
        public function delete () {
            $mgd = new ProfessorDisciplinaCursoGateway;
            return $mdg->delete($this->idProfessorDisciplinaCursoGateway);
        }//Fim do método delete()
    
        //Método save()
        public function save() {
            $mdg = new ProfessorDisciplinaCursoGateway;
            return $mdg->save((object) $this->data);
        }//Fim do método save()

        //Método getDisciplinasECursosByProfessores()
        public function getDisciplinasECursosByProfessores($filter = '') {
            $professorDisciplinaCursoGateway = new ProfessorDisciplinaCursoGateway();
            return $professorDisciplinaCursoGateway->getDisciplinasECursosByProfessores($filter, 'ProfessorDisciplinaCurso');
        }//Fim do método getDisciplinasECursosByProfessores()

        //Método getDisciplinasCursosByProfessor()
        public function getDisciplinasCursosByProfessor($filter = '') {
            $professorDisciplinaCursoGateway = new ProfessorDisciplinaCursoGateway();
            return $professorDisciplinaCursoGateway->getDisciplinasCursosByProfessor($filter);
        }//Fim do método getDisciplinasCursosByProfessor()
    }//Fim da classe ProfessorDisciplinaCurso
    
?>