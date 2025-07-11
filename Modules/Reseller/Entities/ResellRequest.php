<?php

namespace Modules\Reseller\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;
use Modules\Seller\Entities\SellerProductSKU;
use Illuminate\Support\Facades\Auth;

class ResellRequest extends Model
{
    use HasFactory;

    protected $table = 'resell_requests';
    protected $guarded = ['id'];

    protected $casts = [
        'actual_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'customer_profit' => 'decimal:2',
        'admin_profit' => 'decimal:2',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            // Calculate profit split when creating
            $model->calculateProfitSplit();
        });
        
        static::updating(function ($model) {
            // Recalculate profit split when updating prices
            if ($model->isDirty('selling_price') || $model->isDirty('actual_price')) {
                $model->calculateProfitSplit();
            }
        });
    }

    /**
     * Calculate profit split based on the formula
     * Customer gets: Actual Price + 50% of (Selling Price - Actual Price)
     * Admin gets: 50% of (Selling Price - Actual Price)
     */
    public function calculateProfitSplit()
    {
        $profit = $this->selling_price - $this->actual_price;
        $profitShare = $profit * 0.5; // 50% of profit
        
        $this->customer_profit = $this->actual_price + $profitShare;
        $this->admin_profit = $profitShare;
    }

    /**
     * Get the customer who made the resell request
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the product being resold
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the seller product SKU
     */
    public function sellerProductSku()
    {
        return $this->belongsTo(SellerProductSKU::class, 'seller_product_sku_id');
    }

    /**
     * Get the admin who approved the request
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the admin who rejected the request
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Scope for pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved requests
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected requests
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for requests by customer
     */
    public function scopeByCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    /**
     * Check if request is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if request is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if request is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the resell request
     */
    public function approve($adminNote = null)
    {
        $this->update([
            'status' => 'approved',
            'admin_note' => $adminNote,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Enable resale for the product
        $this->product->update([
            'is_resale_enabled' => true,
            'resell_request_id' => $this->id,
            'resale_price' => $this->selling_price,
            'resale_condition' => $this->product_condition,
            'reseller_id' => $this->customer_id,
        ]);
    }

    /**
     * Reject the resell request
     */
    public function reject($adminNote = null)
    {
        $this->update([
            'status' => 'rejected',
            'admin_note' => $adminNote,
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
        ]);
    }

    /**
     * Get formatted status
     */
    public function getStatusTextAttribute()
    {
        return ucfirst($this->status);
    }

    /**
     * Get formatted condition
     */
    public function getConditionTextAttribute()
    {
        return ucfirst($this->product_condition);
    }
} 