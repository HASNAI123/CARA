<?php

namespace App\Http\Controllers\Admin;


use App\Folder;

use App\Generatesop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Http\Resources\Admin\generatesopResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FoldersController extends Controller
{
    /**
     * Display a listing of Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('folder_access')) {
        //     return abort(401);
        // }
        // if ($filterBy = Input::get('filter')) {
        //     if ($filterBy == 'all') {
        //         Session::put('Folder.filter', 'all');
        //     } elseif ($filterBy == 'my') {
        //         Session::put('Folder.filter', 'my');
        //     }
        // }

        // if (request('show_deleted') == 1) {
        //     if (! Gate::allows('folder_delete')) {
        //         return abort(401);
        //     }
        //     $folders = Folder::onlyTrashed()->get();
        // } else {
        //     $folders = Folder::all();
        // }
        $folders = folder::all();
        return view('admin.Folders.index', compact('folders'));
    }

    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('folder_create')) {
        //     return abort(401);
        // }
        
        // $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.Folders.create');
    }

    /**
     * Store a newly created Folder in storage.
     *
     * @param  \App\Http\Requests\StoreFoldersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (! Gate::allows('folder_create')) {
        //     return abort(401);
        // }
        // $folder = Folder::create($request->all());

        $title=$request->folder_title;
        $password=$request->password;
        $hashed = Hash::make($password);


        folder::create([

            'title'=>$title,
            'password'=>$hashed,

        ]);

        return redirect()->route('admin.folders.index');
    }


    /**
     * Show the form for editing Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('folder_edit')) {
        //     return abort(401);
        // }
        
        // $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        // $folder = Folder::findOrFail($id);

        $folder=DB::table('folders')->where('id',$id)->get();

         return view('admin.Folders.edit', compact('folder'));
    }

    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateFoldersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( request $request,$id)
    {
         
        $password=$request->password;
        $hashed = Hash::make($password);
          
        DB::table('folders')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('title' => $request->folder_title, 'password'=>$hashed));  // update the record in the DB. 


        return redirect()->route('admin.folders.index');
    }


    /**
     * Display Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)

    {
    
       $generatesop=DB::table('generatesops')->where('folder',$id)->get();

        return view('admin.Folders.show', compact('generatesop'));
    }
    
     public function check($id)

    {   
          $ids=DB::table('folders')->where('id',$id)->get();
          
          foreach($ids as $id){
            $pswd=$id->password;
    
    if($pswd=""){
       
        return "ok";
    }else{return "not";
        
    }
        
          }    
 }
    //       if($id->password==""){
    //           return "empty";
    //       }else{

    //      return view('admin.Folders.password', compact('ids'));
    //   }
    // }
    
     public function showfolder(Request $request)

    {   
        $id=$request->id;
        $password=$request->password;
        $title=$request->title;


        $query=DB::table('folders')->where('id',$id)->get();
        foreach ($query as $querys) {

        $check=password_verify($password, $querys->password);

        if($check){
                
               $generatesop=DB::table('generatesops')->where('folder',$title)->get();
               return view('admin.Folders.show', compact('generatesop'));
        }else{

                $ids=DB::table('folders')->where('id',$id)->get();
                return view('admin.Folders.password', compact('ids'))->withErrors(['msg' => 'Password Invalid']);
                
            }            
        }  
    }
              

 
    


    /**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $folder = Folder::findOrFail($id);
        $folder->delete();

        return redirect()->route('admin.folders.index');
    }


    public function files($title)
    {
        $folder = Folder::findOrFail($title);
            
             

            return view('admin.Folders.files');
    }

    

    /**
     * Delete all selected Folder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Folder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->restore();

        return redirect()->route('admin.Folders.index');
    }

    /**
     * Permanently delete Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->forceDelete();

        return redirect()->route('admin.Folders.index');
    }
}
