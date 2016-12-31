<?php



class ModelExtensionMOduleThemoviedb extends Model {

	public function install() {
		$this->db->query("
                    CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "themoviedb_module` (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_id` INT UNSIGNED NOT NULL,
                    `movie_id` INT UNSIGNED NOT NULL,
                    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`))
                    ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "themoviedb_module`;");
	}

}
