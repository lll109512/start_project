<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tour_date;
class Tour extends Model
{
    public function tourdates()
    {
        return $this->hasmany(Tour_date::class);
    }
}
