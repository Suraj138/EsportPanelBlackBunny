<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopPlan extends Model
{
    protected $table      = 'shop_plans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'hours', 'price', 'devices', 'badge', 'visible', 'sort_order'];
    protected $useTimestamps = false;

    public function publicList()
    {
        return $this->where('visible', 1)->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    public function allList()
    {
        return $this->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC')->findAll();
    }
}
