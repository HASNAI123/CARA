<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoregeneratesopRequest;
use App\Http\Requests\updategeneratesopRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Generatesop;
use Barryvdh\DomPDF\Facade as PDF;
use App\Folder;
use Illuminate\Support\Facades\Auth;
use App\user;


class GeneratesopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $generatesop = generatesop::all();

        return view('admin.generatesop.index', compact('generatesop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $folders = folder::all();
         return view('admin.generatesop.create',compact('folders'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $accepted=$request->accepted_by;
       $uploaded=$request->uploaded_by;
       $sop_title=$request->sop_title;
       $business_unit=$request->business_unit;
       $effective_date=$request->effective_date;
       $version_no=$request->version_no;
       $doc_no=$request->doc_no;
       $approvedby=$request->approved_by;
       $policy=$request->policy;
       $purpose=$request->purpose;
       $scope=$request->scope;
       $review_pro=$request->review_pro;
       $monitoring=$request->monitoring;
       $verification=$request->verification;
       $steps=$request->steps ;

       $folder=$request->folder;

       $employee_id=Auth::user()->email;
    
      
       $desc=$request->desc;

       $Process_owner=$request->Process_owner;

       $Process_exec=$request->Process_exec;
   
       
$flow=array();

    if ($request->hasFile('img')) {
        $file=$request->file('img');
      
        foreach ($file as $files) {
          
        $filename= $files->getClientOriginalName();
        $filename= time(). '.' .$filename;
        $path=$files->storeas('images',$filename,'s3');
        $path=public_path($filename);
        $flow[]=$filename;

      }
	}

    else
    {
        $filename='null';
    }
       
  
  $img=array();
    if ($request->hasFile('appendix')) {
        $file=$request->file('appendix');
        foreach ($file as $files) {
          
        $name= $files->getClientOriginalName();
        $name= time(). '.' .$name;
        $path=$files->storeas('images',name,'s3');
        $path=public_path($name);
        $img[]=$name;
      }
	}


    else
    {
        $name='null';
    }

    
      $name=implode(',',$img);
      $filename=implode(',',$flow);
       

 
       generatesop::create([
        'accepted_by'=>$accepted,
        'uploaded_by'=>$uploaded,
           'sop_title'=>$sop_title,
           'business_unit'=>$business_unit,
           'effective_date'=>$effective_date,
           'version_no'=>$version_no,
           'doc_no'=>$doc_no,
           'policy'=>$policy,
           'purpose'=>$purpose,
           'scope'=>$scope,
           'review_pro'=>$review_pro,
           'monitoring'=>$monitoring,
           'verification'=>$verification,
           'steps'=>$steps,
           'desc'=>$desc,
           'img'=>$filename ,
           'appendix'=>$name ,
           'folder'=>$folder,
           'Process_owner'=>$Process_owner,
           'Process_exec'=>$Process_exec,
           'Employee_id'=>$employee_id
           
     

       ]);
      
      

       $generatesop = generatesop::all();

      

       return redirect()->route('admin.generatesop.index', compact('generatesop'));
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show(generatesop $generatesop)
    {   
        $steps=collect($generatesop);
        
        $desc=$generatesop->desc;



        
        
        $pdf = \PDF::loadView( 'admin.generatesop.pdf', [ 
            'generatesop' => $generatesop,
            'steps'=>$steps,
             'desc'=>$desc,
            ] );
        return $pdf->stream();
        

    }

    public function download(generatesop $generatesop)
    {   

         
        $pdf = \PDF::loadView( 'admin.generatesop.pdf', [ 'generatesop' => $generatesop] );
        return $pdf->stream();

        

    }

    public function approve(generatesop $generatesop,$id)
    {   

         
        //$pdf = \PDF::loadView( 'admin.generatesop.pdf', [ 'generatesop' => $generatesop] );
        //return $pdf->stream();
        
          $generatesop= generatesop::find($id);

          

          $user_id = Auth::user()->id;
          $user_name = Auth::user()->name;

         if ($generatesop['status']!=='Approved'){
         
            $generatesop = generatesop::find($id)
            ->update([
                      'approved_by'=>$user_name,
                      'status'=>'Approved'

        ]);

            return redirect()->route('admin.generatesop.index');

           }else{

            return redirect()->route('admin.generatesop.index')->withErrors(['msg' => 'Already Approved']);
           
        }

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(generatesop $generatesop)
    {
        return view('admin.generatesop.edit', compact('generatesop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenerateSopRequest $request, generatesop $generatesop)
    {
        $generatesop->update($request->all());                                                

        $flow=array();
        if ($request->hasFile('img')) {
            $files=$request->file('img');

            foreach ($files as $file) {

            $filename= $file->getClientOriginalName();
            $filename= time(). '.' .$filename;
            $path=$file->storeas('public',$filename);
            $path=public_path($filename);
            $flow[]=$filename;
            $image=implode(',',$flow);
            $generatesop->img =$image;
        }
      }


      $appendix=array();
        if ($request->hasFile('appendix')) {
            $files=$request->file('appendix');

            foreach($files as $file){

            $filename= $file->getClientOriginalName();
            $filename= time(). '.' .$filename;
            $path=$file->storeas('public',$filename);
            $path=public_path($filename);
            $appendix[]=$filename;
            $img=implode(',',$appendix);
            $generatesop->appendix =$img;
            }
        }

        $edited_by=$request->edited_by;
        $generatesop->edited_by=$edited_by;


     $generatesop->save();

        return redirect()->route('admin.generatesop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(generatesop $generatesop)
    {
        $generatesop->delete();

        return back();
    }
}
