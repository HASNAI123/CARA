@extends('layouts.admin')
@section('content')
<br><br>
    
<style type="text/css">
  table i{

    font-weight: normal;
    color:blue;
  }
</style>


<div class="card">
    <div style="font-size:30px; text-align: center;" class="card-header">
       <B> {{'How can we help?'}}</B><br/>
       <i>Send us a message</i>
    </div>
    <br><br>
 <b style="text-align: center; font-size:20px;">Digital Internal Audit [DIA] Unit</b>
    <div class="card-body">
        <div class="table-responsive">

            <table style="font-size: 15px; color: black" class=" table table-bordered ">
                <thead>
                    <tr>
                        <th>
                            Nur Suriya Selasiya
                            <i>nur.suriya.salasiya <br/> @aeonretail.com.my</i> 
                        </th>
                        <th>
                           Eliza Muslim 
                           <i>eliza.muslim <br/> @aeonretail.com.my</i>
                        </th>
                        
                        <th>
                          Norsyafikah Izani 
                          <i>norsyafikah.Izani<br/> @aeonretail.com.my</i>                            
                        </th>
                        <th>
                          Shazniza Affandi 
                          <i>shazniza.affandi <br/> @aeonretail.com.my</i>
                        </th>
                       
                        <th>
                            Nuraini Selamat
                            <i>nuraini.selamat <br/> @aeonretail.com.my</i>
                        </th>
                    </tr>
                </thead>

               
            </table>
        </div>
    </div>
</div>


@endsection
@section('scripts')
@parent

@endsection