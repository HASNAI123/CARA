@extends('layouts.admin')
@section('content')
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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



      
    <div class="card-body">
        <form method="POST" action="{{ route("admin.generatesop.update", [$generatesop->id]) }}" enctype="multipart/form-data">
        @method('PATCH')
            @csrf
            <div class="form-group">

            <p> Edited by:<br><br><input readonly    type="text" name="edited_by" value="{{ Auth::user()->name }}"   /></p>


            
            <label> SOP Details </label><br><br><br>
            <p> SOP Title:<br><br><input type="text" name="sop_title" value="{{ $generatesop->sop_title }}"   /></p>
            <p>Version No. :<br><br><input type="integer" name="version_no"  value="{{$generatesop->version_no }}"         /> </p>
            <p>Dept./Business Unit:<br><br><input type="text" name="business_unit"   value="{{ $generatesop->business_unit }}"                /> </p> 
            <p>Effective Date : <br><br><tr><input type="date" name="effective_date"   value="{{ $generatesop->effective_date }}"             /></p>
            <p>Process Owner : <br><br><input type="text" name="Process_owner"      value="{{ $generatesop->Process_owner }}"         /></p>
            <p>Process execution : <br><br><input type="text" name="Process_exec"      value="{{ $generatesop->Process_exec }}" /></p>
            
            <p>Approved By : <br><br><input readonly type="text" name="approved_by"      value="{{$generatesop->approved_by }}"       /></p>
            <p>Reviewed By : <br><br> <input type="text" name="reviewed_by"    value="{{ $generatesop->reviewed_by }}"            /></p><br>
           <br>



        <label> SOP Content  </label><br><br>

        Policy :<br><br>
        <textarea style="resize:vertical" cols = "100"id="policy" name="policy"  style="height:200px"    value="{{ $generatesop->policy }}" >{{ $generatesop->policy }}</textarea><br><br>
        
         Purpose :<br><br>
         <textarea  style="resize:vertical" cols = "100" name = "purpose"  style="height:200px"  value="{{ $generatesop->purpose }}"     >{{ $generatesop->purpose }}</textarea>
        

        <p>
         Scope :<br><br>
         <textarea  style="resize:vertical" cols = "100" name = "scope" " style="height:200px"  value="{{ $generatesop->scope }}"          >{{ $generatesop->scope }}</textarea></p>

        <p>
         Review Procedure :<br><br>
         <textarea style="resize:vertical" cols = "100"  name = "review_pro" style="height:200px"  value="{{ $generatesop->review_pro }}"              >{{ $generatesop->review_pro }}</textarea></p>

        <p>
         Monitoring :<br><br>
         <textarea style="resize:vertical" cols = "100" name = "monitoring" style="height:200px"  value="{{ $generatesop->monitoring }}"          >{{ $generatesop->monitoring }}</textarea></p>


        <p>
         Verification and Record Keeping :<br><br>
         <textarea  style="resize:vertical" cols = "100" name = "verification" style="height:200px" value="{{ $generatesop->verification }}"        >{{ $generatesop->verification }}</textarea></p>
          
         


         <!-- @foreach($generatesop->steps as $steps) 
         <div >
          Procedure <br>
         <input style="resize:vertical" cols = "100" type="textarea" name="steps[]" id=""  value="{{$steps}}"  >  <br><br>
         @endforeach
        

         @foreach($generatesop->desc as $desc) 
          Description<br>
         <textarea  style="resize:vertical" cols = "100"  name = "desc[]"  style="height:200px"  value=""  >{{$desc}}</textarea></p>
         @endforeach
         </div> -->

         @if(@isset($generatesop->steps[0]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[0]" value="{{ $generatesop->steps[0]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[0]"  style="height:200px"  value="{{$generatesop->desc[0]}}">
            {{$generatesop->desc[0]}}
          </textarea> 

            @endif



            @if(@isset($generatesop->steps[1]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[1]" value="{{ $generatesop->steps[1]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[1]"  style="height:200px"  value="{{$generatesop->desc[1]}}">
            {{$generatesop->desc[1]}}
          </textarea> 

            @endif
            



            @if(@isset($generatesop->steps[2]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[2]" value="{{ $generatesop->steps[2]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[2]"  style="height:200px"  value="{{$generatesop->desc[2]}}">
            {{$generatesop->desc[2]}}
          </textarea> 

            @endif
            


            @if(@isset($generatesop->steps[3]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[3]" value="{{ $generatesop->steps[3]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[3]"  style="height:200px"  value="{{$generatesop->desc[3]}}">
            {{$generatesop->desc[3]}}
          </textarea> 

            @endif
            


            @if(@isset($generatesop->steps[4]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[4]" value="{{ $generatesop->steps[4]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[4]"  style="height:200px"  value="{{$generatesop->desc[4]}}">
            {{$generatesop->desc[4]}}
          </textarea> 

            @endif
            



            @if(@isset($generatesop->steps[5]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[5]" value="{{ $generatesop->steps[5]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[0]"  style="height:200px"  value="{{$generatesop->desc[5]}}">
            {{$generatesop->desc[5]}}
          </textarea> 

            @endif
            


            @if(@isset($generatesop->steps[6]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[6]" value="{{ $generatesop->steps[6]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[6]"  style="height:200px"  value="{{$generatesop->desc[6]}}">
            {{$generatesop->desc[6]}}
          </textarea> 

            @endif
            


            @if(@isset($generatesop->steps[7]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[7]" value="{{ $generatesop->steps[7]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[7]"  style="height:200px"  value="{{$generatesop->desc[7]}}">
            {{$generatesop->desc[7]}}
          </textarea> 

            @endif
            

            @if(@isset($generatesop->steps[8]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[8]" value="{{ $generatesop->steps[8]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[8]"  style="height:200px"  value="{{$generatesop->desc[8]}}">
            {{$generatesop->desc[8]}}
          </textarea> 

            @endif
            

            @if(@isset($generatesop->steps[9]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[9]" value="{{ $generatesop->steps[9]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[9]"  style="height:200px"  value="{{$generatesop->desc[9]}}">
            {{$generatesop->desc[9]}}
          </textarea> 

            @endif


            @if(@isset($generatesop->steps[10]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[10]" value="{{ $generatesop->steps[10]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[10]"  style="height:200px"  value="{{$generatesop->desc[10]}}">
            {{$generatesop->desc[10]}}
          </textarea> 

            @endif


            @if(@isset($generatesop->steps[11]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[11]" value="{{ $generatesop->steps[11]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[11]"  style="height:200px"  value="{{$generatesop->desc[11]}}">
            {{$generatesop->desc[11]}}
          </textarea> 

            @endif


            @if(@isset($generatesop->steps[12]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[12]" value="{{ $generatesop->steps[12]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[12]"  style="height:200px"  value="{{$generatesop->desc[12]}}">
            {{$generatesop->desc[12]}}
          </textarea> 

            @endif

            @if(@isset($generatesop->steps[13]))
         
            <tr>

            <label for=""> Procedure</label> <br>
            <input type="text" name="steps[13]" value="{{ $generatesop->steps[13]}}"><br>
             
            <label for="">Description</label> <br>
            <textarea  style="resize:vertical" cols = "100" name = "desc[13]"  style="height:200px"  value="{{$generatesop->desc[13]}}">
            {{$generatesop->desc[13]}}
          </textarea> 

            @endif
            
            




         
         

           
        <div class="wrapp">
        
        
        </div>
        

        <button class="success-btn add-btn">Add Procedure</button>


      <b>Process Flowchart:</b> <br>
      <input type="file" name="img[]"  accept=".jpg" style="background-color:#fff;" multiple />
      <br><br>

      <label for="Appendix"> Appendix</label>
      <input type="file" name="appendix[]"  accept=".jpg" style="background-color:#fff;"  value="{{$generatesop->appendix }}" multiple />
     


                    

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

</script>

@endsection

@section('scripts')

@endsection