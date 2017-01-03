<?php

class ControllerCatalogTmdbMovie extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/dashboard/tmdb');
        $data['heading_title'] = $this->language->get('heading_title_user_movies');
        $data['breadcrumbs'] = array();
        $url = '';
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_user_movies'),
            'href' => $this->url->link('catalog/tmdb_movie', 'token=' . $this->session->data['token'] . $url, true)
        );
        if (isset($this->error['warning']) && $this->request->get['warning'] != "") {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->request->get['success']) && $this->request->get['success'] != "") {
            $data['success'] = "Filme removido com sucesso!";
        } else {
            $data['success'] = "";
        }
        $data['token'] = $this->session->data['token'];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $movies = $this->getUserMovies($this->user->getId());
        if ($movies) {
            $data['movies'] = implode(",", $movies);
        } else {
            $data['movies'] = "";
        }
        $this->response->setOutput($this->load->view('catalog/tmdb', $data));
    }

    public function movieDetails() {
        if (($this->request->server['REQUEST_METHOD'] == 'GET') && $this->validateForm() && isset($this->request->get['movie_id'])) {
            $data['movieId'] = $this->request->get['movie_id'];
            $data['heading_title'] = $this->language->get('heading_title_movie_details');
            $data['breadcrumbs'] = array();
            $url = '';
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title_movie_details'),
                'href' => $this->url->link('catalog/tmdb_movie', 'token=' . $this->session->data['token'] . $url, true)
            );
            if (isset($this->request->get['warning']) && $this->request->get['warning'] == 1) {
                $data['error_warning'] = "Este filme já consta na sua lista.";
            } else {
                $data['error_warning'] = '';
            }
            if (isset($this->request->get['success']) && $this->request->get['success'] == 1) {
                $data['success'] = "Filme adicionado com sucesso!";
            } else {
                $data['success'] = "";
            }
            $data['inUserList'] = $this->inUserList($this->user->getId(), $data['movieId'] );
            $data['token'] = $this->session->data['token'];
            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/tmdb_movie_details', $data));
        }
    }

    public function add() {
        if (!$this->inUserList($this->user->getId(), $this->request->get['movie_id'])) {
            $this->load->model("extension/module/themoviedb");
            try {
                $this->model_extension_module_themoviedb->add($this->request->get['movie_id'], $this->user->getId());
                $this->session->data['success'] = 1;
                $data['errorwarning'] = "";
            } catch (Exception $e) {
                $data['errorwarning'] = "Não foi possível adicionar o filme";
                $data['errorwarning'] = "";
            }
        } else {
            $data['errorwarning'] = 1;
            $this->session->data['success'] = '';
        }
        $this->response->redirect($this->url->link('catalog/tmdb_movie/moviedetails', 'token=' . $this->session->data['token'] . "&movie_id=" . $this->request->get['movie_id'] . "&warning=" . $data['errorwarning'] . "&success=" . $this->session->data['success'] . $url, true));
    }
    
    /**
     * Verifica se um filme já consta na lista de um usuário
     * @param int $userId
     * @param int $movieId
     * @return boolean
     */
    private function inUserList($userId, $movieId) {
        return in_array($movieId, $this->getUserMovies($userId));
    }

    public function remove() {
        $this->load->model("extension/module/themoviedb");
        try {
            $this->model_extension_module_themoviedb->remove($this->request->get['movie_id'], $this->user->getId());
            $this->session->data['success'] = 1;
        } catch (Exception $e) {
            $data['error_warning'] = "Não foi possível remover o filme";
            $this->session->data['success'] = "";
        }
        $this->response->redirect($this->url->link('catalog/tmdb_movie', 'token=' . $this->session->data['token'] . "&success=" . $this->session->data['success'] . $url, true));
    }

    protected function validateForm() {
        $this->load->language('extension/dashboard/tmdb');
        if (!$this->user->hasPermission('modify', 'catalog/tmdb_movie')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }


        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    private function getUserMovies($userId) {
        $this->load->model("extension/module/themoviedb");
        $results = $this->model_extension_module_themoviedb->getUserMovies($userId);
        return $results;
    }

}
