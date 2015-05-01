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
        $this->authorize();
        $this->albums = $this->albumsModel->getAllByUserId($_SESSION['userId']);
        $this->renderView();
        // $this->photos = $this->photosModel->getAll();
    }

    public function getPhotosByAlbumId($id) {
        $this->authorize();
        $this->photos = $this->photosModel->getByAlbumId($id);
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->albumsModel->create($name, $_SESSION['userId'])) {
                $this->addInfoMessage("Album created.");
                $this->redirect("albums");
            } else {
                $this->addErrorMessage("Cannot create album.");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function edit($id) {
        $this->authorize();
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
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorize();
        if ($this->albumsModel->delete($id)) {
            $this->addInfoMessage("album deleted.");
        } else {
            $this->addErrorMessage("Cannot delete album #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("albums");
    }
}
