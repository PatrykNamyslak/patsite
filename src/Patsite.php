<?php
namespace PatrykNamyslak;
require_once 'environment_variables.php';
use PatrykNamyslak\Patbase as Database;


class Patsite{
    final public static function website(string $ID){
        return new Website($ID);
    }
}

final class Website extends Patsite{
    private string $ID;
    private Database $db;

    /**
     * @param string|null $db_username : This gives you a choice if you want to manually enter the username or just use the environmental variables in the env file
     * @param string|null $db_password : This gives you a choice if you want to manually enter the password or just use the environmental variables in the env file
     * @param string|null $db_name : This gives you a choice if you want to manually enter the database name or just use the environmental variables in the env file or just the default clients name
     */
    protected function __construct($ID, ?string $db_name = NULL, ?string $db_username = NULL, ?string $db_password = NULL){
        $this->ID = $ID;
        $this->db = new Database(
            database_name: $db_name ?? $_ENV['PATSITE_DATABASE_NAME'] ?? 'clients',
            username: $db_username ?? $_ENV['PATSITE_DATABASE_USERNAME'],
            password: $db_password ?? $_ENV['PATSITE_DATABASE_PASSWORD']
        );
    }
    /**
     * This function is used to fetch website data.
     * @return array|bool : if the website does exist then a Website object with the details as properties is returned if not it returns false
     */
    public function details(): array|bool{
        return $this->db->query("SELECT * FROM `websites` WHERE `Unique ID` = '{$this->ID}'")->fetchAll();
    }

    /**
     * This function is used to run checks if the site is still active/ being paid on time and if so it will return site data.
     * @return bool
     */
    public function active(){
        return (bool) $this->details();
    }
}

?>