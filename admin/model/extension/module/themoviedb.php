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

        public function add($movieId, $userid) {
            $sql = "
                INSERT INTO `" . DB_PREFIX . "themoviedb_module` 
                (`user_id`, `movie_id`) VALUES 
                (
                    '" . $userid . "'
                    ,'" . $movieId . "'
                );
            ";
            $query = $this->db->query($sql);
        }
        
        public function getUserMovies($userID) {
            $sql = "
                SELECT
                movie_id
                FROM `" . DB_PREFIX . "themoviedb_module`
                WHERE user_id = '" . $userID . "'    
            ";
            $query = $this->db->query($sql);
            return $query->rows;
        }
        
}
