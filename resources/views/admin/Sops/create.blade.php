@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sops.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="uploaded_by">{{ trans('cruds.sop.fields.uploaded_by') }}</label>
                <input      readonly   class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }} " type="text" name="uploaded_by" id="uploaded_by" value="{{ Auth::user()->name   }}">
               
                    <div class="invalid-feedback">
                        {{ $errors->first('uploaded_by') }}
                    </div>
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>

               
                <input class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" type="text" name="folder" id="uploaded_by" value="{{$arvhive_folders}}">

            <br>
            <div class="form-group">
                <label for="uploaded_by">{{ trans('SOP Title') }}</label>
                <input class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" type="text" name="sop_title" id="uploaded_by" value="{{ old('sop_title', '') }}">
               
                    <div class="invalid-feedback">
                        {{ $errors->first('uploaded_by') }}
                    </div>
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Business unit">{{ trans('Business unit') }}</label>
                <input class="form-control {{ $errors->has('business_unit') ? 'is-invalid' : '' }}" type="text" name="business_unit" id="business_unit" value="{{ old('business_unit', '') }}">
               
                    
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            


            <script>
            
            </script>
            <div class="form-group">
                <label for="effective date">{{ trans('Effective date') }}</label>
                <input     class="form-control {{ $errors->has('effective_date') ? 'is-invalid' : '' }}" type="date" name="effective_date" id="effective_date" value="{{ old('effective_date', '') }}">
               
                    
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sop_file">{{ trans('SOP File') }}</label>
                <input type="file" name=sop_file>
               
                  
            </div>
         
            <div class="form-group">
                
                    </div>
                  


                    
        

          
                <span class="help-block">{{ trans('cruds.sop.fields.accepted_by_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

</script>

@endsection

@section('scripts')

@endsection