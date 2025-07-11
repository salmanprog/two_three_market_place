<?php

return [
    'name' => 'Reseller',
    'alias' => 'reseller',
    'description' => 'Reseller Module for AmazCart - Allows customers to resell products after admin approval',
    
    /*
    |--------------------------------------------------------------------------
    | Reseller Module Settings
    |--------------------------------------------------------------------------
    |
    | Here you can configure various settings for the reseller module
    |
    */
    
    'profit_split_percentage' => 50, // 50% profit split between customer and admin
    
    'min_selling_price_multiplier' => 1.1, // Minimum selling price must be 10% higher than actual price
    
    'max_selling_price_multiplier' => 5.0, // Maximum selling price can be 5x the actual price
    
    'auto_approve' => false, // Whether to auto-approve resell requests (default: false)
    
    'require_admin_approval' => true, // Whether admin approval is required (default: true)
    
    'resale_category_id' => null, // Category ID for resale products (null = use existing category)
    
    'resale_tag' => 'Resale', // Tag to add to resale products
    
    'commission_calculation' => [
        'customer_gets' => 'actual_price + (profit * 0.5)', // Formula for customer profit
        'admin_gets' => 'profit * 0.5', // Formula for admin profit
    ],
]; 