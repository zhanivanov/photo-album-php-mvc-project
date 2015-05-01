<?php

class PhotosController extends BaseController{
    private $photosModel;
    public $albumId;

    protected function onInit() {
        $this->title = 'Photos';
        $this->photosModel = new PhotosModel();
    }

    public function index() {
        $this->redirect("home");
//        $this->photos = $this->photosModel->getByAlbumId($id);
//        $this->photos = $this->photosModel->getAll();
//        $this->renderView(__FUNCTION__);
    }

    public function viewAlbum($id){
        $this->authorize();
        $this->photos = $this->photosModel->getByAlbumId($id);
        $this->albumId = $id;
        $this->renderView(__FUNCTION__);
    }

    public function viewPhoto($id){
        $this->authorize();
        $this->photo = $this->photosModel->getSinglePhotoById($id);
        $this->renderView(__FUNCTION__);
    }

    public function add($id) {
        $this->authorize();
        if ($this->isPost()) {
            $this->upload();
            $this->albumId = $id;
            if ($this->photosModel->add($this->path, $this->albumId)) {
                $this->addInfoMessage("Photo uploaded.");
                $this->redirect("photos/viewalbum/" . $id);
            } else {
                $this->addErrorMessage("Cannot upload photo.");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorize();
        $currPhoto = $this->photosModel->getSinglePhotoById($id);
        if ($this->photosModel->delete($id) && unlink($currPhoto['path'])) {
            $this->addInfoMessage("photo deleted.");
        } else {
            $this->addErrorMessage("Cannot delete photo #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("photos/viewalbum/" . $currPhoto['album_id']);
    }

    private function upload() {
        $this->authorize();
        $target_dir = "content/photos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $this->path = $target_file;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 1500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}