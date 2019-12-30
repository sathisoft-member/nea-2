<?php

namespace App\Http\Controllers;

use App\cr;
use Illuminate\Http\Request;
use Storage;
use DB;
use Illuminate\Support\Facades\Artisan;
class BackupController extends Controller
{

    public function index()
    {
        $results = [];
        $files = Storage::allFiles('Laravel');
        
        foreach ($files as $file) {
            $size = Storage::size($file);
           
            $name = explode('/', $file)[1];
            $lastmodified = Storage::lastModified($file);
            $lastmodified = date("Y-m-d H:i:s", $lastmodified);

            array_push($results, [
                'name' => $name,
                'last_modified' => $lastmodified,
                'size' => $this->humanReadable($size),
            ]);
        }
        return view('admin.backups.index',['results'=>$results]);
    }

    public function create(){
            Artisan::call('backup:run', [
                '--only-db' => 1
            ]);
            return back()->with('message',"Backup database succesfully");

    }

    public function restoreBackup(Request $request)
    {

        if($request->sql_file->getClientOriginalExtension()=="sql"){
            DB::unprepared( file_get_contents($request->sql_file) );
            return back()->with("message","Successfull Recover");
        }else{
            return back()->with("message","File Format not sql");
        }

       
    }

    private function clearTempFolder()
    {
        //The name of the folder.
        $folder = base_path('storage\app\backup-temp\\');

        //Get a list of all of the file names in the folder.
        $files = glob($folder . '/*');

        //Loop through the file list.
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function show($name)
    {
        $file = Storage::disk('local')->get('Laravel/' . $name);
        return response()->make($file);
    }

    private function humanReadable($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function deleteBackup($name)
    {
        
        unlink(storage_path('app/Laravel/'.$name));
        return back()->with('message',"Backup database succesfully");
    }

    public function downloadBackup($name){
        $path = storage_path().'/'.'app'.'/Laravel/'.$name;
        if (file_exists($path)) {
            return response()->download($path);
        }
    }
    
}
