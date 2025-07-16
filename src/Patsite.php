<?php
namespace PatrykNamyslak;
// require_once 'environment_variables.php';
use PatrykNamyslak\Patbase as Database;


class Patsite{
    protected Database $db;

    private function __construct(?string $db_name = NULL, ?string $db_username = NULL, ?string $db_password = NULL){
        $this->db = new Database(
            database_name: $db_name ?? $_ENV['PATSITE_DATABASE_NAME'] ?? 'clients',
            username: $db_username ?? $_ENV['PATSITE_DATABASE_USERNAME'],
            password: $db_password ?? $_ENV['PATSITE_DATABASE_PASSWORD']
        );
    }

    final public static function website(string $ID){
        $Patsite = new self;
        return new Website(ID: $ID, db_connection: $Patsite->db);
    }
}
?>