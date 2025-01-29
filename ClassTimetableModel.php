<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTimetableModel extends Model
{
    protected $table = 'class_timetable';

    static public function getSingle($id)
    {
        return ClassTimeTableModel::find($id);
    }
    static public function DeleteRecord($class_id,$subject_id)
    {
        ClassTimetableModel::where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->delete();
    }

    static public function getRecord($class_id, $subject_id, $week_id)
    {
        return ClassTimetableModel::where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)
            ->where('week_id', '=', $week_id)
            ->first();
    }
    
  
}
