<?php

namespace App;

use App\config\Database;
use PDO;

class EntityManager extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function executeQuery($sql, $data)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($data ?: []);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($table, $id, $name_id = 'id')
    {
        $sql = "SELECT * FROM `$table` WHERE $name_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function delete($table, $id, $name_id = 'id')
    {
        $sql = "DELETE FROM $table WHERE $name_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([":id" => $id]);
    }

    public function upset($table, $data, $id_custom = "id")
    {
        $connection = $this->getConnection();
        if (!empty($data[$id_custom])) {
            $sql = "SELECT 1 FROM `$table` WHERE `$id_custom` = :$id_custom";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":$id_custom", $data[$id_custom], PDO::PARAM_INT);
            $stmt->execute();
            $checkData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($checkData) {
                $setClause = [];
                $updateData = [];
                foreach ($data as $key => $value) {
                    if ($key !== $id_custom) {
                        $setClause[] = "`$key` = :$key";
                        $updateData[$key] = $value;
                    }
                }
                if (!empty($setClause)) {
                    $requete = "UPDATE `$table` SET " . implode(", ", $setClause) . " WHERE `$id_custom` = :$id_custom";
                    $updateData[$id_custom] = $data[$id_custom];
                    $stmt = $connection->prepare($requete);
                    return $stmt->execute($updateData);
                }
            }
        }
        if (isset($data[$id_custom]) && empty($data[$id_custom])) {
            unset($data[$id_custom]);
        }
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $requete = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";
        $stmt = $connection->prepare($requete);

        return $stmt->execute($data);
    }
}