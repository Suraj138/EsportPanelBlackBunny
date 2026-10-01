<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopConfig extends Model
{
    protected $table      = 'shop_config';
    protected $primaryKey = 'config_key';
    protected $allowedFields = ['config_key', 'config_value'];
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;

    public function bag()
    {
        $out = [];
        foreach ($this->findAll() as $row) {
            $out[$row['config_key']] = $row['config_value'];
        }
        return $out;
    }

    public function put($key, $value)
    {
        $exists = $this->find($key);
        if ($exists) {
            return $this->update($key, ['config_value' => $value]);
        }
        return $this->insert(['config_key' => $key, 'config_value' => $value]);
    }

    public function putMany(array $pairs)
    {
        foreach ($pairs as $k => $v) {
            $this->put($k, $v);
        }
    }
}
