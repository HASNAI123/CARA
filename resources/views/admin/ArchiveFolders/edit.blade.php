@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<br><br>
<div class="card">

<div class="card-header">
    <br><br>
        <b>{{ trans('global.edit') }} {{ trans('Archive Folder') }}</b>
    </div>

    <style>
    .inp{
        position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

    }
    
    </style>
 @foreach($folder as $folder)
 @endforeach
    <div class="card-body">
        <form method="POST" action="{{route('admin.archivefolders.update',$folder->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            
            <br>
           
            <div class="form-group">
                <label for="Business unit">{{ trans('Edit Folder Title') }}</label>
                <input class="form-control {{ $errors->has('business_unit') ? 'is-invalid' : '' }}" type="text" name="folder_title" id="business_unit" value="{{$folder->title }}">
               
                 <br><br>
              
                <label for="Business unit">{{ trans('Update Password') }}</label>
                <input class="form-control {{ $errors->has('business_unit') ? 'is-invalid' : '' }}" type="password" name="password" id="business_unit" value="{{$folder->password}}">
                 
                 <input type="checkbox" onclick="myFunction()">Show Password
                 
                 <script>
                    function myFunction() {
                      var x = document.getElementById("business_unit");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                    </script>
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
         
            <div class="form-group">
                
                    </div>
                  

                <span class="help-block">{{ trans('cruds.sop.fields.accepted_by_helper') }}</span>
            </div>
            <div style="padding-left: 30px;"  class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>

</script>

@endsection

@section('scripts')

@endsection