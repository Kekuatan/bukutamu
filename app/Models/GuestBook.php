<?php

namespace App\Models;

use App\Enums\DiskEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GuestBook extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute($value)
    {
        if (blank ($this->photo)){
            return '';
        };

        if (str_contains($this->photo,"://")){
            return $this->photo;
        };

        return $this->photo ? Storage::disk(DiskEnum::PUBLIC)->url($this->photo) : '';
    }
}
