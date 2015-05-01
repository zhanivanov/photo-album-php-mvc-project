<?php

class AlbumsController extends BaseController {
    private $albumsModel;
    private $photosModel;

    protected function onInit() {
        $this->title = 'Albums';
        $this->albumsModel = new AlbumsModel();
        $this->photosModel = new PhotosModel();
    }

    public function index() {
        $this->albums = $this->albumsModel->getAll();
        // $this->photos = $this->photosModel->getAll();
    }

    public function getPhotosByAlbumId($id) {
        $this->photos = $this->photosModel->getByAlbumId($id);
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->albumsModel->create($name)) {
                $this->addInfoMessage("Album created.");
                $this->redirect("albums");
            } else {
                $this->addErrorMessage("Cannot create album.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            // Edit the album in the database
            $name = $_POST['name'];
            if ($this->albumsModel->edit($id, $name)) {
                $this->addInfoMessage("Album edited.");
                $this->redirect("albums");
            } else {
                $this->addErrorMessage("Cannot edit album.");
            }
        }

        // Display edit album form
        $this->album = $this->albumsModel->find($id);
        if (!$this->album) {
            $this->addErrorMessage("Invalid album.");
            $this->redirect("albums");
        }
    }

    public function delete($id) {
        if ($this->albumsModel->delete($id)) {
            $this->addInfoMessage("album deleted.");
        } else {
            $this->addErrorMessage("Cannot delete album #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("albums");
    }
}
