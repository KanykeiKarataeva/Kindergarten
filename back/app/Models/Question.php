<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public function getName()
    {
        $lang = app()->getLocale();
        if ($lang == 'kg'){
            return $this->question_kg;
        }
        elseif ($lang == 'ru'){
            return $this->question_ru;
        }
    }
}
