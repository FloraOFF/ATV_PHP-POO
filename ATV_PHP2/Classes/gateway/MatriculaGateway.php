<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';

    class MatriculaGateway {
        private static $conn;
    
        public static function setConnection(PDO $conn) {
            self::$conn = $conn;
        }

        //Método find() - buscar
        public function find ($id, $class = 'stdClass') {
            $sql = "SELECT * FROM Matricula WHERE idMatricula = '$id'";
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchObject($class);
        }//Fim do método find()

        //Método all()
        public function all ($filter, $class = 'stdClass') {
            $sql = "SELECT * FROM Matricula ";
            if ($filter) {
                $sql .= "WHERE $filter";
            }
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, $class); //retorna um array de objetos
        }//Fim do método all()

        //Método delete()
        public function delete ($id) {
            $sql = "DELETE FROM Matricula WHERE idMatricula = '$id'";
            return self::$conn->query($sql);
        }//Fim do método delete()
    
        //Método save()
        public function save($data) {
            if (empty($data->id)) {
                $id = $this->getLastId() + 1;
                // Inserir nova interligação entre professor e disciplina
                $sql = "INSERT INTO Matricula (idMatricula, id_Disciplina, id_curso, id_Aluno) VALUES ('{$id}', '{$data->idDisciplina}', '{$data->idCurso}', '{$data->idAluno}')";
            } else {
                // Atualizar interligação existente
                $sql = "UPDATE Matricula SET  
                id_Disciplina = '{$data->idDisciplina}',
                id_Curso = '{$data->idCurso}',
                id_Aluno = '{$data->idAluno}' WHERE 
                idMatricula = '{$data->id}'";
            }
            return self::$conn->exec($sql);
        }//Fim do método save()

         //Método getLastId()
        public function getLastId() {
            $sql = "SELECT max(idMatricula) as max FROM Matricula";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
        
            return $data->max;
        }//Fim do método getLastId()
        
        //Método getDisciplinasECursosByAlunos()
        public function getDisciplinasECursosByAlunos($idAluno, $class = 'stdClass') {
            $sql = "SELECT Aluno.nomeAluno, Disciplina.nomeDisciplina, Curso.nomeCurso
            FROM Matricula
            INNER JOIN Aluno ON Matricula.id_Aluno = Aluno.idAluno
            INNER JOIN Disciplina ON Matricula.id_Disciplina = Disciplina.idDisciplina
            INNER JOIN Curso ON Matricula.id_Curso = Curso.idCurso
            WHERE Matricula.id_Aluno = '$idAluno'";
    
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchAll(PDO::FETCH_CLASS, $class);
        }//Fim do método getDisciplinasECursosByAlunos()

        //Método getDisciplinasCursosByAluno()
        public function getDisciplinasCursosByAluno($idAluno) {
            $sql = "SELECT Aluno.nomeAluno, Disciplina.nomeDisciplina, Curso.nomeCurso
            FROM Matricula
            INNER JOIN Aluno ON Matricula.id_Aluno = Aluno.idAluno
            INNER JOIN Disciplina ON Matricula.id_Disciplina = Disciplina.idDisciplina
            INNER JOIN Curso ON Matricula.id_Curso = Curso.idCurso
            WHERE Matricula.id_Aluno = '$idAluno'";
    
            $result = self::$conn->query($sql);
            //fetchObject() retornar a próxima linha (registro) como um objeto
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }//Fim do método getDisciplinasCursosByAluno()    
    }//Fim da classe MatriculaGateway
?>