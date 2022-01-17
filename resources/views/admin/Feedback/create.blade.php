@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />


@if (\Session::has('success'))
    <div class="alert alert-success">
      {!! \Session::get('success') !!}
    </div>
@endif 

<br>
<div class="card">
    <div class="card-header">
        <h2 style="text-align:center">Feedback Form</h2>
    </div>
    <br>


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
    <form class="text-align:center" method="POST" action="{{ route("admin.feedback.store") }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <p> User ID:<br><input readonly class="inp" type="text" name="user_id" value="{{ Auth::user()->id  }}"   /></p>

        <p> User Name:<br><input readonly class="inp" type="text" name="user_name" value="{{ Auth::user()->name  }}"   /></p>

        <p> Business Unit:<br><input readonly class="inp" type="text" name="business_unit" value="{{ Auth::user()->business_unit  }}"   /></p>

        Comments: <br>
        <textarea  style="" cols = "100" name = "comments"  style="height:200px" ></textarea></p> <br>
      </div>

      <div class="form-group">
          <button class="btn btn-success" type="submit">
             {{ trans('global.save') }}
          </button>
      </div>
    </form>
  </div>
</div>



@endsection

@section('scripts')

@endsection