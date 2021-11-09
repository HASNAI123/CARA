@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    <br><br>
        <b>{{ trans('global.edit') }} {{ trans('cruds.sop.title_singular') }}</b>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sops.update", [$sop->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            
            @csrf
            <div class="form-group">
                <label for="edited_by">{{ trans('Edited By ') }}</label>
                <input      readonly   class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }} " type="text" name="edited_by" id="edited_by" value="{{ Auth::user()->name }}">
               
                    <div class="invalid-feedback">
                        {{ $errors->first('uploaded_by') }}
                    </div>
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="uploaded_by">{{ trans('SOP Title') }}</label>
                <input class="form-control {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" type="text" name="sop_title" id="uploaded_by" value="{{$sop->sop_title}}">
               
                    <div class="invalid-feedback">
                        {{ $errors->first('uploaded_by') }}
                    </div>
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="Business unit">{{ trans('Business unit') }}</label>
                <input class="form-control {{ $errors->has('business_unit') ? 'is-invalid' : '' }}" type="text" name="business_unit" id="business_unit" value="{{$sop->business_unit}}">
               
                    
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            


            <script>
            
            </script>
            <div class="form-group">
                <label for="effective date">{{ trans('Effective date') }}</label>
                <input     class="form-control {{ $errors->has('effective_date') ? 'is-invalid' : '' }}" type="date" name="effective_date" id="effective_date" value="{{$sop->effective_date}}">
               
                    
             
                <span class="help-block">{{ trans('cruds.sop.fields.uploaded_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sop_file">{{ trans('SOP File') }}</label>
                <input type="file" name=sop_file>
               
                    <div class="invalid-feedback">
                        {{ $errors->first('sop_file') }}
                    </div>
             
                <span class="help-block">{{ trans('cruds.sop.fields.sop_file_helper') }}</span>
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