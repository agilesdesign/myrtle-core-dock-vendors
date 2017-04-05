<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationFileType extends Model
{
    protected $fillable = ['name', 'score_sheet', 'score_column', 'score_row'];
}
