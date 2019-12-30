<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reconciliation extends Model
{
    protected $guarded = [];

    public static function GoneExportRecord()
    {

       $records=DB::table('reconciliations')->select('date', 'quantity')->where('type',0)->get()->toArray();
       $returnArr=[];
       $count=0;
       $total=0;

       foreach ($records as $row) {
       		  $returnArr[$count]['id']=$count+1;
              $returnArr[$count]['date']=$row->date;
              $returnArr[$count]['quantity']=$row->quantity;
              $count++;
        } 
        return $returnArr;   

    }

    public static function StoreExportRecord()
    {
       $records=DB::table('reconciliations')->select('date', 'quantity')->where('type',1)->get()->toArray();
       $returnArr=[];
       $count=0;
       $total=0;
       foreach ($records as $row) {
       		  $returnArr[$count]['id']=$count+1;
              $returnArr[$count]['date']=$row->date;
              $returnArr[$count]['quantity']=$row->quantity;
              $count++;
        } 
        return $returnArr;  
       
    }
}
