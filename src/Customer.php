<?php
namespace PatrykNamyslak;
/**
 * 
 */
final class Customer extends Patsite{
    private string $ID;
    private string $Name;
    private string $Email;
    private array $Websites;

    protected function __construct(string $ID){
        $this->ID = $ID;
        $customerData = $this->details();
        $this->Name = $customerData['Full Name'];
        $this->Email = $customerData['Email'];
        $this->Websites = self::extractProducts(productType: 'Websites', productData: JSON::instantiate($customerData['Products']));
    }
    static function extractProducts(Product $productType, JSON $productData){

    }

    public function details(): array|bool{
        return $this->db->query("SELECT * FROM `customers` WHERE `Unique ID` = '{$this->ID}'")->fetch();
    }

    // Alias for the details() method
    public function data(){
        return $this->details();
    }
}


?>