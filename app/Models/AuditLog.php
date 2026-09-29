<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLog extends Model
{
    protected $table      = 'audit_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'action', 'detail', 'ip', 'created_at'];
    protected $useTimestamps = false;

    public function latest($limit = 50)
    {
        return $this->orderBy('id', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultObject();
    }
}
