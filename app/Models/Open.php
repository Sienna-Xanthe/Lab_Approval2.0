<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Open extends Model
{
    protected $table = "open";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function wzh_openadd($form_id,$open_usereason,$open_projectname,$open_usetime1,$open_usetime2,$open_applicant){
        try {
            $data = self::create([
                    'form_id' =>$form_id,
                    'open_usereason' => $open_usereason,
                    'open_projectname' =>  $open_projectname,
                    'open_usetime1' =>  $open_usetime1,
                    'open_usetime2' =>  $open_usetime2,
                    'open_applicant' =>  $open_applicant,
                ]
            );
            //返回值
            return $data;
        } catch (\Exception $e) {
            logError('添加失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function wzh_openchange($form_id,$open_usereason,$open_projectname,$open_usetime1,$open_usetime2,$open_applicant){


        try {
            $data = self::where('form_id','=',$form_id)->update([
                    'open_usereason' => $open_usereason,
                    'open_projectname' =>  $open_projectname,
                    'open_usetime1' =>  $open_usetime1,
                    'open_usetime2' =>  $open_usetime2,
                    'open_applicant' =>  $open_applicant,
                ]
            );
            //返回值
            return $data;
        } catch (\Exception $e) {
            logError('添加失败', [$e->getMessage()]);
            return false;
        }
    }
    public static function wzh_opendelete($form_id){
        try {
            $data=self::where('form_id','=',$form_id)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('添加失败',[$e->getMessage()]);
            return false;
        }
    }
    public static function wzh_openlook($form_id){
        try {
            $data=self::where('form_id','=',$form_id)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('添加失败',[$e->getMessage()]);
            return false;
        }
    }
}
