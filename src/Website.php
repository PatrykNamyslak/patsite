<?php
namespace PatrykNamyslak;
use PatrykNamyslak\Patbase as Database;


final class Website extends Patsite{
    private string $ID;
    private string $status;
    private Customer $customer;


    /**
     * @param string|null $db_username : This gives you a choice if you want to manually enter the username or just use the environmental variables in the env file
     * @param string|null $db_password : This gives you a choice if you want to manually enter the password or just use the environmental variables in the env file
     * @param string|null $db_name : This gives you a choice if you want to manually enter the database name or just use the environmental variables in the env file or just the default clients name
     */
    protected function __construct(string $ID, Database $db_connection){
        $this->ID = $ID;
        $this->db = $db_connection;
        $data = $this->data();
        $this->status = $data['Status'];
        $this->customer = new Customer(ID: $data['Customer ID']);
    }
    /**
     * This function is used to fetch website data.
     * @return array|bool : if the website does exist then a Website object with the details as properties is returned if not it returns false
     */
    public function details(): array|bool{
        return $this->db->query("SELECT * FROM `websites` WHERE `Unique ID` = '{$this->ID}'")->fetch();
    }

    // Alias for the details() method
    public function data(){
        return $this->details();
    }

    /**
     * This function is used to run checks if the site is still active/ being paid on time and if so it will return site data.
     * @return bool
     */
    public function active(){
        $status = $this->status();
        switch($status){
            case 'Active':
                return TRUE;
                break;
            default:
                return FALSE;
                break;
        }
    }

    public function status(){
        return $this->details()['Status'];
    }

    public function maintenance(): bool{
        if ($this->details()['Status'] === 'Maintenance'){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

?>