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

    public function getAllPublic() {
        $isPublic = 1;
        $statement = self::$db->query("SELECT * FROM albums WHERE is_public = $isPublic");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function makePublic($id){
        $setPublic = 1;
        $statement = self::$db->prepare("UPDATE albums SET is_public = ? WHERE id = ?");
        $statement->bind_param("ii", $setPublic, $id);
        $statement->execute();

        return true;
    }

    public function makePrivate($id){
        $setPrivate = 0;
        $statement = self::$db->prepare("UPDATE albums SET is_public = ? WHERE id = ?");
        $statement->bind_param("ii", $setPrivate, $id);
        $statement->execute();

        return true;
    }

    public function vote($id){
        $getVotesStm = self::$db->prepare("SELECT votes FROM albums WHERE id = ?");
        $getVotesStm->bind_param("i", $id);
        $getVotesStm->execute();
        $votes = $getVotesStm->get_result()->fetch_assoc()['votes'];
        
        $votes += 1;

        $statement = self::$db->prepare("UPDATE albums SET votes = ? WHERE id = ?");
        $statement->bind_param("ii", $votes, $id);
        $statement->execute();

        return true;
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
