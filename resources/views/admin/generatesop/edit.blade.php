@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
<script src="/path/to/js/fileinput.js"></script>
<script src="/path/to/themes/fa/theme.js"></script>
  <script src="https://cdn.tiny.cloud/1/ve0fvixes6pp7g6sd8cdiwj0mx2u8l7eu9hjwjnx0o13i5gq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
   selector: 'textarea',
    tinycomments_mode: 'embedded',
    width : "740"
  });
  </script>
<br><br>
<div class="card">
    <div class="card-header">
    <h2 style="text-align:center">EDIT SOP</h2>
    </div>
    <br><br>

    <style>
   .success-btn {
  background-color: #e7e7e7;
  border: 1px solid #000000;
  color: black;
  padding: 5px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 100%;
  margin: 8px 0;
  cursor: pointer;
}
.btn-success{
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 100%;
  margin: 4px 2px;
  cursor: pointer;
}
textarea {
  width: 120%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
}
    .main-body {
    text-align: center;
    
}

 section {
    text-align: left;
    
}
form {
    text-align: left;
    display: inline-block;
    margin-left:30px;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=textarea], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=textarea]:focus {
  background-color: lightblue;
}

input[type=file], select {
  
  
}

input[type=date], select {
  width: 25%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
  align: center;
}
input[type=file], select {
  width: 50%;
  border: 1px solid #000000;
  align: center;
}

input[type=text]:focus {
  background-color: lightblue;
}
#square {
    width: 300px;
    height: 30px;
    background-color: lightblue;

    }
#squareflow {
    width: 300px;
    height: 30px;
    background-color: lightblue;

    } 
    
    </style>



    <div class="main-body"> 
    <div class="card-body">
        <form method="POST" action="{{ route("admin.generatesop.update", [$generatesop->id]) }}" enctype="multipart/form-data">
        @method('PATCH')
            @csrf
            <div class="form-group">

            <p> Edited by:<br><br><input readonly    type="text" name="edited_by" value="{{ Auth::user()->name }}"   /></p>
            
            
            
            <label for="folders">Select Folder</label>
            <select  style="width:290px;  border: 3px solid;  border-style: solid border-radius:5px;" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="folder" id="folder">
                    
                    @foreach($folders as $folders)
                        <option value="{{ $folders->id }}" {{$folders->id == $generatesop->folder ? 'selected' : ''}}> {{ $folders->title }}  </option>
                    @endforeach
                </select>
            <br><br>
            


            <label> SOP Details </label><br><br><br>
            <p> SOP Title:<br><br><input type="text" name="sop_title" value="{{ $generatesop->sop_title }}"   /></p>
            <p>Version No. :<br><br><input type="integer" name="version_no"  value="{{$generatesop->version_no }}"         /> </p>
            <p>Effective Date : <br><br><tr><input type="date" name="effective_date"   value="{{ $generatesop->effective_date }}"             /></p>
            <p>Process Owner : <br><br><input type="text" name="Process_owner"      value="{{ $generatesop->Process_owner }}"         /></p>
            <p>Process execution : <br><br><input type="text" name="Process_exec"      value="{{ $generatesop->Process_exec }}" /></p>
            
           <br>



        <label> SOP Content  </label><br><br>

        Policy :
        <textarea style="resize:vertical" cols = "100"id="policy" name="policy"  style="height:200px"    value="{{ $generatesop->policy }}" >{{ $generatesop->policy }}</textarea><br><br>
        
         Purpose :
         <textarea  style="resize:vertical" cols = "100" name = "purpose"  style="height:200px"  value="{{ $generatesop->purpose }}"     >{{ $generatesop->purpose }}</textarea>
        <br>

        <p>
         Scope :
         <textarea  style="resize:vertical" cols = "100" name = "scope" " style="height:200px"  value="{{ $generatesop->scope }}"          >{{ $generatesop->scope }}</textarea></p>
         <br>
        <p>
         Review Procedure :
         <textarea style="resize:vertical" cols = "100"  name = "review_pro" style="height:200px"  value="{{ $generatesop->review_pro }}"              >{{ $generatesop->review_pro }}</textarea></p>
        <br>
        <p>
         Monitoring :
         <textarea style="resize:vertical" cols = "100" name = "monitoring" style="height:200px"  value="{{ $generatesop->monitoring }}"          >{{ $generatesop->monitoring }}</textarea></p>
       
       <br>

        <p>
         Verification and Record Keeping :
         <textarea  style="resize:vertical" cols = "100" name = "verification" style="height:200px" value="{{ $generatesop->verification }}"        >{{ $generatesop->verification }}</textarea></p>
        
        <label for="flowchart"> Insert Flowchart image </label><br>
        <input type="file" name="img[]" id="input-flow"  accept=".jpg" style="background-color:#fff;" multiple />  
        
        <br><br> 
        
     @if($generatesop->img) 
     
      <?php 
        $img=explode(',',$generatesop->img);
        foreach (array_reverse($img) as $img) {
         
       ?>
       <div class="img">
        <input type="text" id="squareflow" name="oldimg[]" value="<?php echo $img?>" readonly>
        <input type="button" value="X" class="remove"><br>
      </div>
      <?php 
        }
      ?>
    @endif  
    <br>
     
     


         @foreach ($generatesop->steps as $key=>$new)
         
            <tr>
        <div class="oldproc">

            <label for=""> Procedure {{$key+1}}</label> <br>
            <input type="text" name="steps[]" value="{{$new }}"><br>
             
            <label for="">Description {{$key+1}}</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[]"  style="height:200px"  value="{{$generatesop->desc[$key]}}">
            {{$generatesop->desc[$key]}}
          </textarea><br>
          
          <label for="">Appendix {{$key+1}}</label> <br>
           <input  type="file" name="appendix{{$key}}[]"  accept=".jpg,.png,.jpeg"   style="background-color:#fff;" multiple/><br>
          
          
           @foreach($generatesop->appendix[$key] as $appendix)
           @if($appendix)
           <div class="img">
          <input type="text" id="square" name="privious{{$key}}[]" value="{{$appendix}}" readonly>
          <input type="button" value="X" class="remove"><br>
           </div>
           @endif
           @endforeach
         
          <a href="#" class="removeproc">Remove</a><br><br>
        </div>

         @endforeach
         
          <div class="wrapp">
              
          </div>

        <button class="success-btn add-btn">Add Procedure</button>
        <br>
        </div>
        <br>
        
        <label for="permissions">{{ trans('Assign To') }}
                                <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label><br/>
                            <select name="users[]" id="permissions" class="form-control select2" style="width:800px;"   multiple="multiple" required="">
                              @foreach($users as $users)
                                    <option value="{{$users->id}}" {{in_array($users->id, explode(',',$generatesop->assign_to) ?: []) ? "selected" : ""}}>{{$users->name}}</option>

                              @endforeach      
               
                            </select>
                            @if($errors->has('permissions'))
                                <p class="help-block">
                                    {{ $errors->first('permissions') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.role.fields.permissions_helper') }}
                            </p>  
            <div/>
            <br><br>
            
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$("#input-fa").fileinput({
    theme: "fa",
    uploadUrl: "/file-upload-batch/2"
});
</script>


<script>
$("#input-flow").fileinput({
    theme: "fa",
    uploadUrl: "/file-upload-batch/2"
});
</script>


<script type="text/javascript">
   $(document).ready(function () {
       
       $('.remove').click(function(e){
      $(this).parent('.img').remove();


     });
     
          $('.removeproc').click(function(e){
      $(this).parent('.oldproc').remove();

    
     });

     // allowed maximum input fields             <input type="text" name="file" size="4" style="background-color:#fff;" required="required" />

     var max_input = 30;

     // initialize the counter for textbox
     var x = 0;
     
     
     $('.oldproc').each(function(){
     x++;
    }); 

     // handle click event on Add More button
     $('.add-btn').click(function (e) {
       e.preventDefault();
       if (x < max_input) { // validate the condition
         x++; // increment the counter
         y=x-1;
         $('.wrapp').append(`
           <div class="input-box">
           Procedure `+x+`: <br>
       <input type="text" name="steps[]"><br><br>
      Description `+x+`: <br>
       <textarea  rows = "5" cols = "100" name = "desc[]">
         </textarea>
         Appendix <br>
         <input  type="file" name="appendix`+y+`[]"  accept=".jpg,.png,.jpeg" multiple><br>
             <a href="#" class="remove-lnk">Remove</a>
           </div>
         `); // add input field
         tinymce.init({ selector:'textarea',width : "740" });//  initialize again
       }
     });

     // handle click event of the remove link
     $('.wrapp').on("click", ".remove-lnk", function (e) {
       e.preventDefault();
       $(this).parent('div').remove();  // remove input field
       x--; // decrement the counter
     })

   });
 </script>

</script>

@endsection

@section('scripts')

@endsection