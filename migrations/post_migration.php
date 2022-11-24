<?php

/**
 * Migration
 */
class post_migration
{
    public function up(){
        $db = \SmyPhp\Core\Application::$app->db;
        $sql = "CREATE TABLE posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            poster_id VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            body VARCHAR(255) NOT NULL,
            image_name VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB";
        $db->pdo->exec($sql);
    }

    public function down(){
        $db = \SmyPhp\Core\Application::$app->db;
        $sql = "DROP TABLE posts";
        $db->pdo->exec($sql);
    }
    
}