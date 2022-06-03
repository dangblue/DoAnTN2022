<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable =
    ['info_contact', 'info_map', 'info_phone', 'info_email', 'info_time'];
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_infor';
}
