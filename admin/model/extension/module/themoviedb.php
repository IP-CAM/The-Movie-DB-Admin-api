<?php

class ModelExtensionMOduleThemoviedb extends Model {

    /**
     * Cria a tabela da lista do usuário
     */
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

    /**
     * Exclui a tabela
     */
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "themoviedb_module`;");
    }

    /**
     * Adiciona um filme à lista do usuário
     * @param type $movieId
     * @param type $userid
     */
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

    /**
     * Remove um filme da lista do usuário
     * @param int movieId
     * @param int userId
     */
    public function remove($movieId, $userId) {
        $sql = "
                DELETE FROM `" . DB_PREFIX . "themoviedb_module` 
                WHERE 
                user_id='" . $userId . "'
                AND movie_id='" . $movieId . "'
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
        $moviesId = [];
        $query = $this->db->query($sql);
        foreach ($query->rows as $result) {
            $moviesId[] = $result["movie_id"];
        }
        return $moviesId;
    }

}
