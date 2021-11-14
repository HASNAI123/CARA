<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Folder;
use App\archive_folder;


use App\Generatesop;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Http\Resources\Admin\generatesopResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArchiveFoldersController extends Controller
{
    //
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
        $archive_folders = archive_folder::all();
        return view('admin.ArchiveFolders.index', compact('archive_folders'));
        
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

        return view('admin.folders.create');
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


        $title=$request->title;
        $password=$request->password;

        $hashed = Hash::make($password);


        Archive_Folder::create([

            'title'=>$title,
            'password'=>$hashed,

       ]);

        return redirect()->route('admin.archivefolders.index');
        //return view('admin.archivefolders.index', compact('archive_folders'));
    
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

         //$folder = Folder::findOrFail($id);

        //return view('admin.archivefolders.edit', compact('folder', 'created_bies'));

         $folder=DB::table('archive_folders')->where('id',$id)->get();

         return view('admin.ArchiveFolders.edit', compact('folder'));
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

          
        DB::table('archive_folders')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('title' => $request->folder_title, 'password'=>$hashed));  // update the record in the DB. 


        return redirect()->route('admin.archivefolders.index');
    }


    /**
     * Display Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)

    {   
         
          $sop=DB::table('sop')->where('archive_folder',$id)->get();

          return view('admin.ArchiveFolders.show', compact('sop'));
    }

     
      public function check($id)

    {   
       
        $ids=DB::table('archive_folders')->where('id',$id)->get();

        return view('admin.ArchiveFolders.password', compact('ids'));
    }

      public function showfolder(Request $request)

    {   
        $id=$request->id;
        $password=$request->password;
        $title=$request->title;


        $query=DB::table('archive_folders')->where('id',$id)->get();
        foreach ($query as $querys) {

        $check=password_verify($password, $querys->password);

        if($check){
                
                $sops=DB::table('Sop')->where('archive_folder',$title)->get();
                $archive_folders=DB::table('archive_folders')->where('title',$title)->first('title');
                return view('admin.Sops.index')->with('sops',$sops)->with('archive_folders',$archive_folders);
        }else{

                $ids=DB::table('archive_folders')->where('id',$id)->get();
                return view('admin.ArchiveFolders.password', compact('ids'))->withErrors(['msg' => 'Password Invalid']);
                
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
       
        $folder = Archive_Folder::findOrFail($id);
        $folder->delete();

        return redirect()->route('admin.archivefolders.index');
    }


    public function files($title)
    {
        $folder = Folder::findOrFail($title);
            
             

            return view('admin.folders.files');
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

        return redirect()->route('admin.folders.index');
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

        return redirect()->route('admin.folders.index');
    }
}

