<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\CustomerCategory;

class Registration extends Model
{
    protected $guarded = [];
    public static function getRegistrationMonthly($month, $status)
    {
        $date = explode('-', $month);
        $year = $date[0];
        $month = $date[1];
        $query = $year . "-" . $month;
        $records = DB::table('registrations')->select('declare_date', 'issue_no', 'applicant_name', 'address', 'customer_category', 'phone')->where('issue_type', $status)->where(DB::raw("DATE_FORMAT(declare_date,'%Y-%m')"), $query)->get()->toArray();
        $registrations = [];
        $count = 0;
        foreach ($records as $row) {
            $registrations[$count]['declare_date'] = $row->declare_date;
            $registrations[$count]['issue_no'] = $row->issue_no;
            $registrations[$count]['applicant_name'] = $row->applicant_name;
            $registrations[$count]['address'] = $row->address;
            $customer_category = CustomerCategory::find($row->customer_category);
            $name = $customer_category->name;
            $registrations[$count]['customer_category'] = $name;
            $registrations[$count]['phone'] = $row->phone;
            $count++;
        }
        return $registrations;
    }
    public static function getRegistrationRanging($first_date, $last_date, $status)
    {
        $records = DB::table('registrations')->select('declare_date', 'issue_no', 'applicant_name', 'address', 'customer_category', 'phone')->where('issue_type', $status)->whereBetween('declare_date', array($first_date, $last_date))->get()->toArray();
        $registrations = [];
        $count = 0;
        foreach ($records as $row) {
            $registrations[$count]['declare_date'] = $row->declare_date;
            $registrations[$count]['issue_no'] = $row->issue_no;
            $registrations[$count]['applicant_name'] = $row->applicant_name;
            $registrations[$count]['address'] = $row->address;
            $customer_category = CustomerCategory::find($row->customer_category);
            $name = $customer_category->name;
            $registrations[$count]['customer_category'] = $name;
            $registrations[$count]['phone'] = $row->phone;
            $count++;
        }
        return $registrations;
    }
}
