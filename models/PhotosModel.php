<?php

class PhotosModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM photos");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getByAlbumId($id) {
        $statement = self::$db->query("SELECT * FROM photos WHERE album_id = $id");
        $result = self::$db->prepare("SELECT is_public FROM albums WHERE id = ?");
        $result->bind_param("i", $id);
        $result->execute();
        $_SESSION['is_public'] = $result->get_result()->fetch_assoc()['is_public'];
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getSinglePhotoById($id){
        $statement = self::$db->prepare("SELECT * FROM photos WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function add($path, $id) {
        if ($path == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO photos (path, album_id, created_on /*, user_id*/) VALUES(?, ?, ?)");
        $date = date('Y-m-d H:m:s', time());
        $statement->bind_param("sis", $path, $id, $date);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM photos WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
