<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $perPage = 12;

    protected $fillable = [
        "name",
        "contact",
        "email"
    ];

    public function getContactFormattedAttribute(): string
    {
        $digits = preg_replace('/\D/', '', $this->contact);

        return preg_replace('/(\d{1})(\d{4})(\d{4})/', '$1 $2-$3', $digits);
    }
}
