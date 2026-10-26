<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopMedia extends Model
{
    protected $table      = 'shop_media';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kind', 'file', 'caption', 'sort_order', 'created_at'];
    protected $useTimestamps = false;

    public function gallery()
    {
        return $this->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC')->findAll();
    }
}
