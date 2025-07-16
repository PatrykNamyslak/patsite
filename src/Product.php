<?php
namespace PatrykNamyslak;
use PatrykNamyslak\Patbase as Database;

// CASE NAME = PRODUCT_ID
$products = PatDash::products();

enum Product: string{
    case WEBSITE_1 = '';
}
enum WebsiteTier: int{
    case STARTER = 1;
    case PERSONAL = 2;
    case BUSINESS = 3;
    case ENTERPRISE = 4;
}
?>