<?php

namespace App\Models;

use CodeIgniter\Model;

class LibModel extends Model
{
    protected $table      = 'lib';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file', 'file_type', 'file_size', 'time'];
    protected $useTimestamps = false;

    public function latest($limit = 20)
    {
        return $this->orderBy('id', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultObject();
    }

    public function current()
    {
        return $this->orderBy('id', 'DESC')
            ->get()
            ->getFirstRow();
    }
}
