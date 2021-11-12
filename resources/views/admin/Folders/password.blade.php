@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <div class="form-group">
                <a class="btn btn-primary" href="{{ route("admin.folders.index") }}">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>  {{ trans('Sop library') }}
                </a>
            </div>


<br><br>
<div class="card">

    

    <style>
    .inp{
        position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 


    }
    
    </style>
 @foreach($ids as $id)
 @endforeach
    <div class="card-body">
        <form method="POST" action="{{route('admin.folders.showfolder') }}" enctype="multipart/form-data">
            @csrf
            
                <input class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" type="hidden" name="id" id="uploaded_by" value="{{$id->id}}">

                 <input class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" type="hidden" name="title" id="uploaded_by" value="{{$id->title}}">

            <br>
           
            <div class="form-group">
                <label for="Business unit">{{ trans('Folder Password') }}</label>
                <input class="form-control {{ $errors->has('business_unit') ? 'is-invalid' : '' }}" type="password" name="password" id="business_unit" value="{{ old('business_unit', '') }}">
               
                    
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            


        
         
            <div class="form-group">
                
                    </div>
                  


                    
        

          
                <span class="help-block">{{ trans('cruds.sop.fields.accepted_by_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.submit') }}
                </button>
            </div>
        </form>
    </div>
</div>

</script>

@endsection

@section('scripts')

@endsection