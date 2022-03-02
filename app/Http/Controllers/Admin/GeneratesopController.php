<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoregeneratesopRequest;
use App\Http\Requests\UpdateGenerateSopRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Generatesop;
use Barryvdh\DomPDF\Facade as PDF;
use App\Folder;
use Illuminate\Support\Facades\Auth;
use App\user;
use Illuminate\Support\Facades\DB;
use App\generatesop_history;


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
     
     $reviewers_users = user::whereHas(
    'roles', function($q){
        $q->where('title', 'Reviewer');
    }
    )->get();

     $approver_users = user::whereHas(
    'roles', function($q){
        $q->where('title', 'Approver');
    }
    )->get();
    
     return view('admin.generatesop.create',compact('folders','reviewers_users','approver_users'));
    
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
        Storage::disk('s3')->setVisibility($path,'public');
        $flow[]=$filename;

      }
	}

    else
    {
        $filename='null';
    }
       
  
  $appendix = array();
   foreach ($steps as $key => $value) {
       $img=array();
       $nbr=$key+1;
    if ($request->hasFile('appendix'.$nbr)) {
        $file=$request->file('appendix'.$nbr);
        foreach ($file as $files) {

        $name= $files->getClientOriginalName();
        $name= time(). '.' .$name;
        $path=$files->storeas('images',$name,'s3');
        Storage::disk('s3')->setVisibility($path,'public');
        $img[]=$name;
      }
      $appendix[] =  $img;
    }
    else
    {
        $appendix[] =  array("");
    }  
  }    
  
  
      $name=$appendix;
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
           'Employee_id'=>$employee_id,
           'assign_reviewers'=>implode(',',$request->reviewer_users),
           'assign_approvers'=>implode(',',$request->approver_users),
           
     

       ]);
      
      

       $generatesop = generatesop::all();

      

       return redirect()->route('admin.folders.index', compact('generatesop'));
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show(Request $request,$id)
    {   
      $generatesops= Generatesop::where('id',$id)->get();
      foreach ($generatesops as $generatesop) {
  
      }
      
      $name= Auth::user()->name;
      $employee_id= Auth::user()->email;

      $histrory= New generatesop_history;

      $histrory->title=$generatesop->sop_title;
      $histrory->employee_name=$name;
      $histrory->employee_id=$employee_id;
      $histrory->selection_one=$request->radio;
      $histrory->selection_two=$request->radio2;

      $histrory->save();
        
        $newpdf =view( 'newpdf', [ 
            'generatesop' => $generatesop,
            ] );
        return $newpdf;
        
        
        
        // $pdf = \PDF::loadView( 'admin.generatesop.pdf', [ 
        //     'generatesop' => $generatesop,
        //     'steps'=>$steps,
        //      'desc'=>$desc,
        //     ] );
        // return $pdf->stream();
        

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
          
          $folders= generatesop::where('id',$id)->get('folder');
           foreach ($folders as $folder) {

             $folder['folder'];
           }

          

          $user_id = Auth::user()->id;
          $user_name = Auth::user()->name;

         if ($generatesop['status']!=='Approved'){
         
            $generatesop = generatesop::find($id)
            ->update([
                      'approved_by'=>$user_name,
                      'status'=>'Approved'

        ]);

            $generatesop=DB::table('generatesops')->where('folder',$folder['folder'])->get();

           return view('admin.Folders.show', compact('generatesop'));

           
           }else{
             $generatesop=DB::table('generatesops')->where('folder',$folder['folder'])->get();
            return view('admin.Folders.show', compact('generatesop'))->withErrors(['msg' => 'Already Approved']);
         
         }

    }
    
    
            public function review(generatesop $generatesop,$id)
    {   
  
         $generatesops= generatesop::find($id);

           $folders= generatesop::where('id',$id)->get('folder');
           foreach ($folders as $folder) {

             $folder['folder'];
           }
          $user_id = Auth::user()->id;
          $user_name = Auth::user()->name;

       //  if ($generatesops['revised by']==""){
         if ($generatesops['revised by']==""){
         
             $generatesops = generatesop::find($id)
            ->update([
                      'revised by'=>$user_name,
                      'status'=>"Reviewed"
                      
                    ]);
         
            $generatesop=DB::table('generatesops')->where('folder',$folder['folder'])->get();

           return view('admin.Folders.show', compact('generatesop'));

           
           }else{
             $generatesop=DB::table('generatesops')->where('folder',$folder['folder'])->get();
            return view('admin.Folders.show', compact('generatesop'))->withErrors(['msg' => 'Already Reviewed']);
         
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
    
         $folders = folder::all();
         
         $users = user::whereHas(
        'roles', function($q){
            $q->where('title', 'Reviewer');
        }
        )->get();
         
         
        return view('admin.generatesop.edit', compact('generatesop','folders','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenerateSopRequest $request,generatesop $generatesop)
    {
        
         $edited_by=$request->edited_by;
         $id=$generatesop->id;   
         $oldimg=$request->oldimg;
           


          $accepted=$request->accepted_by;
      
       $sop_title=$request->sop_title;
      
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
       
       $appendix2 = array();

       foreach ($steps as $key => $value) 
       {
          $previoes = array();
          if(isset($request['privious'.$key]))
          {
            foreach ($request['privious'.$key] as $pvalue) 
            {
              $previoes[] = $pvalue;
            }
            $appendix2[] = $previoes;
          }
          else
          {
           $appendix2[] = array(); 
          }

          if($request->hasFile('appendix'.$key))
          {
            $appendix = array();
            foreach ($request->file('appendix'.$key) as $file) 
            {
              $file->getClientOriginalName();
              $name= $file->getClientOriginalName();
              $name= time(). '.' .$name;
              $path=$file->storeas('images',$name,'s3');
              Storage::disk('s3')->setVisibility($path,'public');
              $appendix[] = $name;

            }
            $appendix2[$key] = array_merge($appendix2[$key],$appendix);
          }

       }



        $flow=array();
        if ($request->hasFile('img')) {
            $files=$request->file('img');

            foreach ($files as $file) {

            $filenames= $file->getClientOriginalName();
            $filenames= time(). '.' .$filenames;
            $path=$file->storeas('images',$filenames,'s3');
            Storage::disk('s3')->setVisibility($path,'public');
            $flow[]=$filenames;
            //$image=implode(',',$flow);
            //$generatesop->img =$image;
        }
        }else{
              $filenames="";
  
            }

       
       $filenames ="";

        if(count($flow) >0)
        {
          $filenames .=implode(',',$flow);
        }

        if($oldimg !=null)
        {
          if($filenames)
          {
            $filenames .=",".implode(',',$oldimg);
          }
          else
          {
            $filenames .=implode(',',$oldimg);
          }
        }  
        
           $generatesop= generatesop::find($id);
          
           $generatesop->sop_title=$sop_title;
           $generatesop->effective_date=$effective_date;
           $generatesop->version_no=$version_no;
           $generatesop->doc_no=$doc_no;
           $generatesop->policy=$policy;
           $generatesop->purpose=$purpose;
           $generatesop->scope=$scope;
           $generatesop->review_pro=$review_pro;
           $generatesop->monitoring=$monitoring;
           $generatesop->verification=$verification;
           $generatesop->steps=$steps;
           $generatesop->desc=$desc;
           $generatesop->img=$filenames ;
           $generatesop->appendix=$appendix2;
           $generatesop->folder=$folder;
           $generatesop->Process_owner=$Process_owner;
           $generatesop->Process_exec=$Process_exec;
           $generatesop->Employee_id=$employee_id;
           $generatesop->edited_by=$edited_by;
           $generatesop->assign_to=implode(',',$request->users);
            

           $generatesop->save();
    
   

          


           

        

     //    $edited_by=$request->edited_by;
     //    $generatesop->edited_by=$edited_by;


     // $generatesop->save();

      $title=$request->folder;
      $generatesop=DB::table('generatesops')->where('folder',$title)->get();
      return view('admin.Folders.show', compact('generatesop'));

        //return redirect()->route('admin.folders.show', compact('generatesop'));
    }
    
    
      public function delete($id){

       $folders=Generatesop::where('id',$id)->get();
      foreach ($folders as $folder) {
          $title=$folder->folder;
        }

       $delete= DB::table('generatesops')->where('id',$id)->delete();

    
    
        $generatesop=DB::table('generatesops')->where('folder',$title)->get();
        return view('admin.Folders.show', compact('generatesop'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$generatesop->delete();
        return $id;
        $delete=generatesop::where('id',$id)->get();

        
        // $folders= generatesop::where('id',$id)->get('folder');
        //   foreach ($folders as $folder) {

        //      $folder['folder'];
        //   }
        // $generatesop=DB::table('generatesops')->where('folder',$folder['folder'])->get();

        //  return view('admin.Folders.show', compact('generatesop'));

    }
}
