<?php
class ControllerExtensionModuleTheMovieDb extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/themoviedb');
                
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('themoviedb', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true));
		}

	} 

}