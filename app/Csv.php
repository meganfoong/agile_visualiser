<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Csv extends Model
{
   public static function insertData($data) {

      $value=DB::table('users')->where('id', $data['id'])->get();
      if($value->count() == 0){
         DB::table('users')->insert($data);
      }
   }
}
