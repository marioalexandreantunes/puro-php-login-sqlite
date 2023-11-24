<?php

// Sqlipe3
class MySQlite extends SQLite3
{
    function __construct()
    {
        // estará na pasta 'src' o nosso ficheiro sqlite
        $this->open(__DIR__ . '/../src/users.sqlite');
        $this->enableExceptions(true);
        $this->Tablet();
    }

    private function Tablet()
    {
        try {
            $this->query('CREATE TABLE IF NOT EXISTS "users" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT,
                "name" VARCHAR NOT NULL UNIQUE,
                "password" VARCHAR NOT NULL
            )');
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    private function get_user($name): array
    {
        $data = array();
        try {
            // retorna array com os dados do usuario pretendido
            $statement = $this->prepare('SELECT * FROM users WHERE name = :name;');
            $statement->bindValue(':name', $name);
            $result = $statement->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $data[] = json_encode($row);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
        return $data;
    }

    public function pass_validation($name, $password): array
    {
        $result = false;
        try {
            // validação do usuario => senha
            $one = [];
            $user = $this->get_user($name);
            if(is_array($user) && count($user) > 0 ){
                $one = json_decode($user[0], true);
                $pass = $one['password'];
                if (password_verify($password, $pass)) {
                    $result = true;
                } else {
                    $result = false;
                }
            }     
            return [
                'status' => 'sucess',
                'data' => $result,
                'user' => $one,
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'data' => $e->getMessage(),
            ];
        }
    }

    private function inserir_usuario($name, $password): bool
    {
        try {
            $sql = 'INSERT INTO users (name, password) VALUES(:name, :password)';
            $stmt = $this->prepare($sql);
            $stmt->bindValue(':name', $name, SQLITE3_TEXT);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
            $result = $stmt->execute();
            if ($result->fetchArray(SQLITE3_ASSOC)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
            return false;
        }
    }

    private function inserir_data()
    {
        $this->inserir_usuario('manuel', '123456');
        $this->inserir_usuario('mario', '123456');
        $this->inserir_usuario('manuela', '123456');
    }
}

// MySql
/*

class database
{
    private function query($sql, $params = []): array
    {
        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return [
                'status' => 'sucess',
                'data' => $results,
            ];
        } catch (\Throwable $err) {
            return [
                'status' => 'error',
                'data' => $err->getMessage(),
            ];
        }
    }

    private function get_user($name): array
    {
        $result = $this->query('SELECT * FROM users WHERE name = :name;', [':name' => $name]);
        return $result;
    }

    public function pass_validation($name, $password): array
    {
        $result = false;
        $user = [];
        try {
            // validação do usuario => senha
            $data = $this->get_user($name);
            if ($data['status'] == 'sucess') {
                $user = $data['data'];
                $pass = $user['password'];
                if (password_verify($password, $pass)) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
            return [
                'status' => $data['status'],
                'data' => $result,
                'user' => $user
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'data' => $e->getMessage(),
            ];
        }
    }
}

*/