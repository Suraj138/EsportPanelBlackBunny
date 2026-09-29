<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table      = 'referral_code';
    protected $primaryKey = 'id_reff';
    protected $allowedFields = ['code', 'Referral', 'set_saldo', 'level', 'used_by', 'created_by', 'acc_expiration', 'login_devices', 'ref_accounts'];
    protected $useTimestamps = true;

    public function getCode($limit = 10, $order_by = 'DESC')
    {
        $this->limit($limit);
        $this->orderBy($this->primaryKey, $order_by);
        return $this->get()->getResultObject();
    }

    public function useReferral($code, $username = true)
    {
        $row = $this->checkCode($code);
        if ($row and $username) {
            $ok = $this->update($row->id_reff, ['used_by' => $username === true ? 'used' : $username]);
            if ($ok) return true;
        }
        return false;
    }

    public function countCreatedBy($username)
    {
        return $this->where('created_by', $username)->countAllResults();
    }
    /*
     * Made by @DARKESPYT
     * checkCode
     * Maded By @Usir_Died_Real
     * @param  mixed $code
     * @param  mixed $dehash default true
     * @return object
     */
    public function checkCode($code, $dehash = true)
    {
        $code = $dehash ? create_password($code, false) : $code;
        return $this->getWhere(['code' => $code])
            ->getRowObject();
    }
}
