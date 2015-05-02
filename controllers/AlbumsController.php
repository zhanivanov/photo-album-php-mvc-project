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

    public function publicAlbums(){
        $this->authorize();
        $this->albums = $this->albumsModel->getAllPublic();
        $this->renderView(__FUNCTION__);
    }

    public function makePublic($id){
        $this->authorize();
        $this->albums = $this->albumsModel->makePublic($id);
        $this->redirect("photos", "viewalbum", array($id));
    }

    public function makePrivate($id){
        $this->authorize();
        $this->albums = $this->albumsModel->makePrivate($id);
        $this->redirect("photos", "viewalbum", array($id));
    }

    public function vote($id){
        $this->authorize();
        $this->albums = $this->albumsModel->vote($id);
        $this->redirect("albums", "publicalbums");
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->albumsModel->create($name, $_SESSION['userId'])) {
                $_SESSION['success'] = array("Album created successfully!");
                $this->redirect("albums");
            } else {
                $_SESSION['error'] = array("Could not create the album!");
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
                $_SESSION['info'] = array("Album successfully edited!");
                $this->redirect("albums");
            } else {
                $_SESSION['error'] = array("Could not edit the album!");
            }
        }

        // Display edit album form
        $this->album = $this->albumsModel->find($id);
        if (!$this->album) {
            $_SESSION['error'] = array("Invalid album!");
            $this->redirect("albums");
        }
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorize();
        if ($this->albumsModel->delete($id)) {
            $_SESSION['success'] = array("Album deleted successfully!");
        } else {
            $_SESSION['error'] = array("Cannot delete album #" . htmlspecialchars($id) . '.', "Maybe it is in use.");
        }
        $this->redirect("albums");
    }
}
