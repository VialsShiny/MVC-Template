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

    /**
     * Execute a SQL query and return the results.
     *
     * @param string $sql The SQL query to execute.
     * @param array $data The data to bind to the query.
     * @return array The fetched results.
     */
    public function executeQuery($sql, $data = [])
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find all records in a specified table.
     *
     * @param string $table The name of the table.
     * @return array The fetched records.
     */
    public function findAll($table)
    {
        return $this->executeQuery("SELECT * FROM `$table`");
    }

    /**
     * Find a record by its ID.
     *
     * @param string $table The name of the table.
     * @param mixed $id The ID of the record.
     * @param string $name_id The name of the ID column.
     * @return array|null The fetched record or null if not found.
     */
    public function findById($table, $id, $name_id = 'id')
    {
        return $this->executeQuery("SELECT * FROM `$table` WHERE `$name_id` = :id", [":id" => $id])[0] ?? null;
    }

    /**
     * Delete a record by its ID.
     *
     * @param string $table The name of the table.
     * @param mixed $id The ID of the record to delete.
     * @param string $name_id The name of the ID column.
     */
    public function delete($table, $id, $name_id = 'id')
    {
        $this->executeQuery("DELETE FROM `$table` WHERE `$name_id` = :id", [":id" => $id]);
    }

    /**
     * Update a record in the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data The data to update.
     * @param string $id_custom The name of the ID column.
     */
    private function update($table, $data, $id_custom)
    {
        $setClause = [];
        $updateData = [];

        foreach ($data as $key => $value) {
            if ($key !== $id_custom) {
                $setClause[] = "`$key` = :$key";
                $updateData[$key] = $value;
            }
        }

        if (!empty($setClause)) {
            $updateData[$id_custom] = $data[$id_custom];
            $sql = "UPDATE `$table` SET " . implode(", ", $setClause) . " WHERE `$id_custom` = :$id_custom";
            return $this->executeQuery($sql, $updateData);
        }

        return false;
    }

    /**
     * Insert a new record into the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data The data to insert.
     */
    private function insert($table, $data)
    {
        // Remove the ID if it's empty
        if (isset($data['id']) && empty($data['id'])) {
            unset($data['id']);
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO `$table` ($columns) VALUES ($placeholders)";
        return $this->executeQuery($sql, $data);
    }

    /**
     * Insert or update a record in the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data The data to insert or update.
     * @param string $id_custom The name of the ID column.
     */
    public function upsert($table, $data, $id_custom = "id")
    {
        // Check if the record exists
        if (!empty($data[$id_custom])) {
            $exists = $this->findById($table, $data[$id_custom], $id_custom);
            if ($exists) {
                return $this->update($table, $data, $id_custom);
            }
        }

        // If the record does not exist, insert it
        return $this->insert($table, $data);
    }
}
