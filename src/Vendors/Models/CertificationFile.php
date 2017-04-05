<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CertificationFile extends Model
{
    protected $fillable = ['type_id', 'vendor_id', 'start_at', 'expire_at', 'file_extension'];

    protected $dates = ['created_at', 'updated_at', 'start_at', 'expire_at'];

    public function type()
    {
        return $this->belongsTo(CertificationFileType::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getScoreAttribute()
    {
        $filename = md5($this->id) . '.' . $this->file_extension;

        $excel = App::make('excel')
            ->selectSheets([$this->type->score_sheet])
            ->load($this->filePath . $filename);


        return $excel->excel->getActiveSheet()->getCell($this->type->score_column . $this->type->score_row)->getCalculatedValue();
    }

    public function getFilePathAttribute()
    {
        return storage_path('vendormanager/certifications/'
            . $this->vendor->id . '/'
            . $this->type->id . '/'
        );
    }
}
