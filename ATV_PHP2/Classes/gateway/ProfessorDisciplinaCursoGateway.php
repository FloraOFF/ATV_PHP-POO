<?php
    class ProfessorDisciplinaCursoGateway {
        private static $conn;
    
        public static function setConnection(PDO $conn) {
            self::$conn = $conn;
        }

        //Método find() - buscar
        public function find ($id, $class = 'stdClass') {
            $sql = "SELECT * FROM ProfessorDisciplinaCurso WHERE idProfessorDisciplinaCurso = '$id'";
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchObject($class);
        }//Fim do método find()

        //Método all()
        public function all ($filter, $class = 'stdClass') {
            $sql = "SELECT * FROM ProfessorDisciplinaCurso ";
            if ($filter) {
                $sql .= "WHERE $filter";
            }
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, $class); //retorna um array de objetos
        }//Fim do método all()

        //Método delete()
        public static function delete ($id) {
            $sql = "DELETE FROM ProfessorDisciplinaCurso WHERE idProfessorDisciplinaCurso = '$id'";
            return self::$conn->query($sql);
        }//Fim do método delete()
    
        //Método save()
        public function save($data) {
            if (empty($data->id)) {
                $id = $this->getLastId() + 1;
                // Inserir nova interligação entre professor e disciplina
                $sql = "INSERT INTO ProfessorDisciplinaCurso (idProfessorDisciplinaCurso, id_Professor, id_Disciplina, id_Curso) VALUES ('{$id}', '{$data->idProfessor}', '{$data->idDisciplina}', '{$data->idCurso}')";
            } else {
                // Atualizar interligação existente
                $sql = "UPDATE ProfessorDisciplinaCurso SET 
                id_Professor = '{$data->idProfessor}', 
                id_Disciplina = '{$data->idDisciplina}',
                id_Curso = '{$data->idCurso}' WHERE 
                idProfessorDisciplinaCurso = '{$data->id}'";
            }
            return self::$conn->exec($sql);
        }//Fim do método save()

        //Método getLastId()
        public function getLastId() {
            $sql = "SELECT max(idProfessorDisciplinaCurso) as max FROM ProfessorDisciplinaCurso";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
        
            return $data->max;
        }//Fim do método getLastId()

        //Método getDisciplinasECursosByProfessores()
        public function getDisciplinasECursosByProfessores($idProfessor, $class = 'stdClass') {
            $sql = "SELECT Professor.nomeProfessor, Disciplina.nomeDisciplina, Curso.nomeCurso
            FROM ProfessorDisciplinaCurso
            INNER JOIN Professor ON ProfessorDisciplinaCurso.id_Professor = Professor.idProfessor
            INNER JOIN Disciplina ON ProfessorDisciplinaCurso.id_Disciplina = Disciplina.idDisciplina
            INNER JOIN Curso ON ProfessorDisciplinaCurso.id_Curso = Curso.idCurso
            WHERE ProfessorDisciplinaCurso.id_Professor = '$idProfessor'";
    
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchAll(PDO::FETCH_CLASS, $class);
        }//Fim do método getDisciplinasECursosByProfessores()

        //Método getDisciplinasCursosByProfessor()
        public function getDisciplinasCursosByProfessor($idProfessor) {
            $sql = "SELECT Professor.nomeProfessor, Disciplina.nomeDisciplina, Curso.nomeCurso
            FROM ProfessorDisciplinaCurso
            INNER JOIN Professor ON ProfessorDisciplinaCurso.id_Professor = Professor.idProfessor
            INNER JOIN Disciplina ON ProfessorDisciplinaCurso.id_Disciplina = Disciplina.idDisciplina
            INNER JOIN Curso ON ProfessorDisciplinaCurso.id_Curso = Curso.idCurso
            WHERE ProfessorDisciplinaCurso.id_Professor = '$idProfessor'";
    
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }//Fim do método getDisciplinasCursosByProfessor()
    }//Fim da classe ProfessorDisciplinaCursoGateway()
?>