<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySopRequest;
use App\Http\Requests\StoreSopRequest;
use App\Http\Requests\UpdateSopRequest;
use App\Sop;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Archive_Folder;
use Illuminate\Support\Facades\DB;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index($id)
    {
          
     $sops=DB::table('sop')->where('archive_folder',$id)->get();
     $archive_folders=DB::table('archive_folders')->where('title',$id)->first('title');

       return view('admin.Sops.index')->with('sops',$sops)->with('archive_folders',$archive_folders);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $archive_folders=DB::table('archive_folders')->where('title',$id)->first('title');
         return view('admin.Sops.create',compact('archive_folders'));
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        
        $validated = $request->validate([
        'sop_file' => 'required',
     
    ]);


     
if($request->hasFile('sop_file')){ 
       $path=$request->file('sop_file')->store('pdfs','s3');
       dd($path);

      
    }



    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sop $sop)
    {
        return view('admin.Sops.show', compact('sop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sop $sop)
    {
        
        return view('admin.Sops.edit', compact('sop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        

       
        
        //$user_name = Auth::user()->name;

        //$id=$sop->id;
        if($request->hasFile('Sop_file')){
        $file=$request->file('sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       $path=$file->storeas('public',$filename);
       $path=public_path($filename);
   }
   else{
            $filename='null';
   }

        $sop = sop::find($id)
        ->update([
                  'Modified_by'=>$request->edited_by,
                  'Modified_date'=> now()->toDateString('Y-m-d'),
                  'sop_title'=>$request->sop_title,
                  'business_unit'=>$request->business_unit,
                  'effective_date'=>$request->effective_date,
                  'Sop_file'=>$filename,
                  
                  

    ]);

 if ($request->hasFile('Sop_file')) {
     
        $file=$request->file('Sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       $path=$file->storeas('public',$filename);
       $path=public_path($filename);
       

       $sop=sop::find($id)->update([
           'Sop_file'=>$filename
       ]);

       

       return redirect()->route('admin.Sops.index');
                       

    }

    else

        

        return redirect()->route('admin.Sops.index');
    }
    
    public function download($sop_file){
        
        $path = storage_path('./app/public/'.$sop_file);
        return response()->download($path);
   
         
   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sop $sop)
    {
        

        $sop->delete();

        return back();
    }

    public function massDestroy(MassDestroySopRequest $request)
    {
        Sop::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function generate()
    {
        return view('admin.sops.generate');
    }
}



