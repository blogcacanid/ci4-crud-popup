<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'pegawai_id';
    protected $allowedFields = ['nip', 'nama_pegawai' , 'alamat'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}