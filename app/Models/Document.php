<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    /**
     * Get the quotation that owns the document.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
