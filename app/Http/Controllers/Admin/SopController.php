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
use App\sop_history;


class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index($id)
    {
          
     $sops=DB::table('Sop')->where('archive_folder',$id)->get();
     $archive_folders=DB::table('archive_folders')->where('id',$id)->first('id');

     return view('admin.Sops.index')->with('sops',$sops)->with('archive_folders',$archive_folders);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $archive_folders=$id;
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
    



     
// if($request->hasFile('sop_file')){ 
//       $path=$request->file('sop_file')->store('pdfs','s3');
//       dd($path);
//     }
    
    
    if($request->hasFile('sop_file')){ 
       $file=$request->file('sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       
       $path=$file->storeas('pdfs',$filename,'s3');

       
       
       
       
  
    
   }else{
        $filename='null';
   }

       
      
       $uploaded=$request->uploaded_by;

      $folder=$request->folder;

       $sop_title=$request->sop_title;
       $business_unit=$request->business_unit;
       $effective_date=$request->effective_date;

       $sop=new Sop;
      
       $sop->uploaded_by=$uploaded;
       $sop->Sop_file=$filename;
       $sop->sop_title=$sop_title;
       $sop->business_unit=$business_unit;
       $sop->effective_date=$effective_date;
       $sop->archive_folder=$folder;

       $sop->save();

     

      
       return redirect()->route('admin.sops.index',$folder);


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
        

       
         $folder=$request->folder;


 if ($request->hasFile('sop_file')) {
     
        $file=$request->file('sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       $path=$file->storeas('pdfs',$filename,'s3');

       $sop=sop::find($id)->update([
                  'Modified_by'=>$request->edited_by,
                  'Modified_date'=> now()->toDateString('Y-m-d'),
                  'sop_title'=>$request->sop_title,
                  'business_unit'=>$request->business_unit,
                  'effective_date'=>$request->effective_date,
                  'Sop_file'=>$filename,
       ]);
        
      return redirect()->route('admin.sops.index',$folder);
                       
    }

    else{

         $sop=sop::find($id)->update([
                  'Modified_by'=>$request->edited_by,
                  'Modified_date'=> now()->toDateString('Y-m-d'),
                  'sop_title'=>$request->sop_title,
                  'business_unit'=>$request->business_unit,
                  'effective_date'=>$request->effective_date,
       ]);
       

       return redirect()->route('admin.sops.index',$folder);
    }
    }
    
    public function download(Request $request, $sop_file)
    {
        // $path = storage_path('./app/public/'.$sop_file);
        // return response()->download($path);
        
        $name= Auth::user()->name;
        $employee_id= Auth::user()->email;

        $histrory= New sop_history;

        $histrory->title=$sop_file;
        $histrory->employee_name=$name;
        $histrory->employee_id=$employee_id;
        $histrory->selection_one=$request->radio;
        $histrory->selection_two=$request->radio2;

      $histrory->save();
        

      return $path= Storage::disk('s3')->response('pdfs/'.$sop_file);
         
       
       //return response()->download($path);
        
   
         
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


