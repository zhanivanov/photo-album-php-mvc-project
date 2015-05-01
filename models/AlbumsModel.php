<?php

class AlbumsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM albums");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllByUserId($id) {
        $statement = self::$db->query("SELECT * FROM albums WHERE user_id = $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM albums WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($name, $userId) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO albums (name, created_on , user_id) VALUES(?, ?, ?)");
        $date = date('Y-m-d H:m:s', time());
        $statement->bind_param("ssi", $name, $date, $userId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE albums SET name = ? WHERE id = ?");
        $statement->bind_param("si", $name, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM albums WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
