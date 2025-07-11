# Reseller Module for AmazCart

A comprehensive module that allows customers to resell products after admin approval in the AmazCart multi-vendor e-commerce system.

## Features

### Core Functionality
- **Resell Request System**: Customers can submit requests to resell products
- **Admin Approval Workflow**: Admin can approve or reject resell requests
- **Product Condition Management**: Support for 'New' and 'Used' product conditions
- **Commission Calculation**: Automatic profit split between customer and admin
- **Resale Product Display**: Approved products appear in store with resale tags

### Pricing & Commission Rules
- **Dual Pricing System**: Every product has Actual Price and Selling Price
- **Profit Split Formula**: 
  - Customer gets: Actual Price + 50% of (Selling Price - Actual Price)
  - Admin gets: 50% of (Selling Price - Actual Price)
- **Example Calculation**:
  - Actual Price: $200
  - Selling Price: $500
  - Profit: $300
  - Customer Gets: $200 + $150 = $350
  - Admin Gets: $150

### Admin Features
- **Dashboard**: Overview of all resell requests and statistics
- **Request Management**: View, approve, reject, and manage resell requests
- **Resale Products**: Monitor approved resale products
- **Commission Tracking**: Track admin earnings from resale products
- **Export Functionality**: Export request data

### Customer Features
- **Request Submission**: Submit resell requests with product details
- **Request Management**: View, edit, and delete pending requests
- **Profit Calculator**: Preview commission calculations
- **Earnings Tracking**: Monitor earnings from approved resale products
- **Product Selection**: Browse available products for resale

## Installation

1. **Copy Module Files**: Ensure all module files are in the `Modules/Reseller/` directory

2. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

3. **Register Module**: Add the module to your module manager or register it in your application

4. **Configure Settings**: Update the configuration in `Modules/Reseller/Config/config.php`

## Database Structure

### Tables Created
- `resell_requests`: Stores all resell request data
- `products`: Extended with resale fields
- `order_product_details`: Extended with commission fields

### Key Fields
- `resell_requests`:
  - `customer_id`: Customer who submitted the request
  - `product_id`: Product being resold
  - `product_condition`: 'new' or 'used'
  - `actual_price`: Original product price
  - `selling_price`: Customer's selling price
  - `customer_profit`: Calculated customer commission
  - `admin_profit`: Calculated admin commission
  - `status`: 'pending', 'approved', 'rejected'

## Configuration

Edit `Modules/Reseller/Config/config.php`:

```php
return [
    'profit_split_percentage' => 50, // 50% profit split
    'min_selling_price_multiplier' => 1.1, // Minimum 10% markup
    'max_selling_price_multiplier' => 5.0, // Maximum 5x markup
    'auto_approve' => false, // Require admin approval
    'resale_tag' => 'Resale', // Tag for resale products
];
```

## Usage

### Admin Panel

1. **Access Dashboard**: Navigate to `/admin/reseller/dashboard`
2. **Manage Requests**: Go to `/admin/reseller/requests`
3. **Approve/Reject**: Use the approve/reject buttons on request details
4. **View Resale Products**: Check `/admin/reseller/resale-products`

### Customer Panel

1. **Submit Request**: Navigate to `/customer/reseller/requests/create`
2. **Select Product**: Choose from available products
3. **Set Details**: Enter condition, selling price, and notes
4. **Track Status**: Monitor request status in your dashboard

### API Endpoints

#### Admin API
- `GET /api/admin/reseller/dashboard`
- `GET /api/admin/reseller/requests`
- `POST /api/admin/reseller/requests/{id}/approve`
- `POST /api/admin/reseller/requests/{id}/reject`

#### Customer API
- `GET /api/customer/reseller/requests`
- `POST /api/customer/reseller/requests`
- `GET /api/customer/reseller/available-products`
- `POST /api/customer/reseller/calculate-profit`

## Integration with Checkout

The module automatically integrates with the existing checkout process:

1. **Commission Calculation**: Automatically calculated during order processing
2. **Wallet Integration**: Reseller commissions added to customer wallets
3. **Order Tracking**: Commission details stored with order products

## Customization

### Modifying Commission Formula
Edit the `calculateProfitSplit()` method in `Modules/Reseller/Entities/ResellRequest.php`:

```php
public function calculateProfitSplit()
{
    $profit = $this->selling_price - $this->actual_price;
    $profitShare = $profit * 0.5; // Change this percentage
    
    $this->customer_profit = $this->actual_price + $profitShare;
    $this->admin_profit = $profitShare;
}
```

### Adding Custom Validation
Modify the `validateResellRequestData()` method in `Modules/Reseller/Services/ResellerService.php`

### Customizing Views
Views are located in `Modules/Reseller/Resources/views/` and can be customized as needed.

## Troubleshooting

### Common Issues

1. **Migration Errors**: Ensure all required tables exist before running migrations
2. **Permission Issues**: Check that admin and customer middleware are properly configured
3. **Commission Not Calculating**: Verify that the resale product is properly linked to a resell request

### Debug Mode
Enable debug mode in your Laravel application to see detailed error messages.

## Support

For support and questions:
- Check the AmazCart documentation
- Review the module configuration
- Verify database structure and relationships

## License

This module is part of the AmazCart e-commerce system and follows the same licensing terms.

## Version History

- **v1.0.0**: Initial release with core reseller functionality
- Basic request management
- Commission calculation
- Admin approval workflow
- Customer dashboard 