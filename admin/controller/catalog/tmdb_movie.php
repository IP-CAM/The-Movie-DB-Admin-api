<?php

class ControllerCatalogTmdbMovie extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/dashboard/tmdb');
        $this->document->setTitle($this->language->get('heading_title'));
    }

    public function movieDetails() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm() && isset($this->request->post->movie_id)) {
            $this->model_catalog_recurring->addRecurring($this->request->post);
            $this->response->redirect($this->url->link('catalog/recurring', 'token=' . $this->session->data['token'] . $url, true));
        }
    }

    protected function validateForm() {
        $this->load->language('extension/dashboard/tmdb');
        if (!$this->user->hasPermission('modify', 'catalog/tmdb')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['recurring_description'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

}
