<?php
namespace PatrykNamyslak;
final class JSON{
    public string $json_string;
    
    public static function instantiate(string $json_string): JSON{
        json_decode($json_string);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException("Invalid JSON string provided.");
        }else{
            return new JSON($json_string);
        }
    }
    private function __construct(string $json_string){
        $this->json_string = $json_string;
    }
}

?>