<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class weekModel extends Model
{
    protected $table = 'week';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::get();
    }

}
