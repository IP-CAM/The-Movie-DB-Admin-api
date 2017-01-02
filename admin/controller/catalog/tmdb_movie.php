<?php

class ControllerCatalogTmdbMovie extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/dashboard/tmdb');
        $this->document->setTitle($this->language->get('heading_title'));
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
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }
            $data['token'] = $this->session->data['token'];
            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/tmdb_movie_details', $data));
        }
    }
    
    public function add() {
        $this->load->model("extension/module/themoviedb");
        
        $this->model_extension_module_themoviedb->add($this->request->get['movie_id'],$this->user->getId());
        $this->response->redirect($this->url->link('catalog/tmdb_movie/moviedetails', 'token=' . $this->session->data['token'] . "&movie_id=" . $this->request->get['movie_id'] . $url, true));
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

}
