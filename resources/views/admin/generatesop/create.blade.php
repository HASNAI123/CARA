@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<br><br>
<div class="card">
    <div class="card-header">
        <h2 style="text-align:center">Generate SOP</h2>
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
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #000000;
  border-radius: 4px;
  box-sizing: border-box;
}
    body {
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

.wrapper{

    background-color:white;
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
    
    </style>
   
      <div class="text-align:center">
    <div class="card-body">
        <form class="text-align:center" method="POST" action="{{ route("admin.generatesop.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">

            <p> Created by:<br><br><input readonly class="inp" type="text" name="uploaded_by" value="{{ Auth::user()->name  }}"   /></p>

         <label for="folders">Select Folder</label>
            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="folder" id="folder">
                    
                    @foreach($folders as $folders)
                        <option value="{{ $folders->title }}"> {{ $folders->title }}  </option>
                    @endforeach
                </select>
            <br><br>

            <label> SOP Details </label><br><br><br>
            <p>SOP Title:<br><br><input  type="text" name="sop_title" value="{{ old('sop_title', '') }}"   /></p>
            <p>Version No. :<br><br><input type="integer" name="version_no"  value="{{ old('version_no', '') }}"         /> </p>
            <p>Business Unit:<br><br><input type="text" name="business_unit"   value="{{ old('business_unit', '') }}"                /> </p> 
            <p>Effective Date : <br><br><tr><input type="date" name="effective_date"   value="{{ old('effective_date', '') }}"             /></p>
            <p>Process Owner : <br><br><input type="text" name="Process_owner"      value="{{ old('Process_owner', '') }}"         /></p>
            <p>Process execution : <br><br><input type="text" name="Process_exec"      value="{{ old('Process_exec', '') }}" /></p>
            <p>Reviewed By : <br><br> <input  readonly  type="text" name="reviewed_by"  style="weight:90px"  value="{{ old('reviewed_by', '') }}"/></p><br>
            <p>Approved By : <br><br> <input readonly   type="text" name="approved _by"  style="weight:90px"  value="{{ old('reviewed_by', '') }}"/></p><br>
           <br>


        <label> SOP Content  </label><br><br>

        Policy :<br><br>
        <textarea style="resize:vertical" cols = "100" id="policy" name="policy"  style="height:200px"    value="{{ old('policy', '') }}" ></textarea><br><br>
        
         Purpose :<br><br>
         <textarea style="resize:vertical" cols = "100"  name = "purpose"  style="height:200px"  value="{{ old('purpose', '') }}"     ></textarea>
        

        <p>
         Scope :<br><br>
         <textarea style="resize:vertical" cols = "100"  name = "scope"  style="height:200px"  value="{{ old('scope', '') }}"          ></textarea></p>

        <p>
         Review Procedure :<br><br>
         <textarea  style="resize:vertical" cols = "100" name = "review_pro" style="height:200px"  value="{{ old('review_pro', '') }}"              ></textarea></p>

        <p>
         Monitoring :<br><br>
         <textarea   style="resize:vertical" cols = "100" name = "monitoring" style="height:200px" value="{{ old('monitoring', '') }}"          ></textarea></p>


        <p>
        Verification and Record Keeping:<br><br>
         <textarea style="resize:vertical" cols = "100" name = "verification" style="height:200px" value="{{ old('verification', '') }}"        ></textarea></p>
          


        
         <div class="wrapp" >
          Procedure: <br>
         <input type="textarea" name="steps[]" id=""  >  <br><br>

          Description: <br>
         <textarea  style="resize:vertical" cols = "100" name = "desc[]"  style="height:200px"            ></textarea></p>
         
         </div>


         <button class="success-btn add-btn">Add Procedure</button>
         <br><br>


         <div class="form-group">
                <label>{{ trans('Status') }}</label>
                <select  disabled readonly class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    
                    @foreach(App\generatesop::STATUS_SELECT as $key => $label)
                        <option readonly dea value="{{ $key }}" >{{ $label }}</option>
                    @endforeach
                </select>
         

      <label for="flowchart"> Insert Flowchart image </label>
      <input type="file" name="img[]"  accept=".jpg" style="background-color:#fff;"  value="{{ old('img', '') }}" multiple />
      
      <br><br>

      <label for="Appendix"> Appendix</label>
      <input type="file" name="appendix[]"  accept=".jpg" style="background-color:#fff;"  value="{{ old('appendix', '') }}"  multiple />
     
            </div>

            <br><br>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
   $(document).ready(function () {

     // allowed maximum input fields             <input type="text" name="file" size="4" style="background-color:#fff;" required="required" />

     var max_input = 30;

     // initialize the counter for textbox
     var x = 1;

     // handle click event on Add More button
     $('.add-btn').click(function (e) {
       e.preventDefault();
       if (x < max_input) { // validate the condition
         x++; // increment the counter
         $('.wrapp').append(`
           <div class="input-box">
           Procedure : <br>
       <input type="text" name="steps[]"><br><br>
      Description : <br>
       <textarea rows = "5" cols = "100" name = "desc[]">
         </textarea>
             <a href="#" class="remove-lnk">Remove</a>
           </div>
         `); // add input field
       }
     });

     // handle click event of the remove link
     $('.wrapper').on("click", ".remove-lnk", function (e) {
       e.preventDefault();
       $(this).parent('div').remove();  // remove input field
       x--; // decrement the counter
     })

   });
 </script>

@endsection

@section('scripts')

@endsection