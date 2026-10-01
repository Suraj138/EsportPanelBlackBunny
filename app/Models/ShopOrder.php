<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopOrder extends Model
{
    protected $table      = 'shop_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['plan_id', 'customer_name', 'customer_phone', 'customer_note', 'txn_id', 'amount', 'status', 'issued_key', 'created_at', 'verified_by'];
    protected $useTimestamps = false;

    public function latest($limit = 40)
    {
        return $this->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    public function pendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
