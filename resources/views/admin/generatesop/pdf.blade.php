
<html>
<head>         
<style>

            

            footer {
                    position: fixed; 
                    bottom: -50px; 
                    left: 0px; 
                    right: 0px;
                    height: 50px; 

                    /** Extra personal styles **/
                    background-color: white;
                    color: grey;
                    text-align: center;
                    line-height: 35px;
                    font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; 
                    font-size: 10px;}
            
            table {
                    border-collapse: collapse;
                    width:100%;
                    border: 1px solid black;
                    font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; } 

                    th,td {
                    border: 1px solid black;
                    font-size: 12px;
                    }
                 
                 

            .center {
                    display: block;
                    margin-left: 240px;
                    margin-right: auto;}

            .page_break { 
                    page-break-before: always; }

            h1 {
                font-size: 28px;
                font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; 
                text-align: center;

            }
            h3 {
                
                font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; 

            }
            caption {
                
                font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif; 
                text-align: left;
                width:100%;
                border: 1px solid black;

            }
            
            
            
</style>
</head>
<body>
<img class="center" src="img\AEON_logo.jpg" alt="">
<br><br><br><br><br><br><br><br><h1>STANDARD OPERATING PROCEDURES (SOP)</h1>
<h1 style align='center' > {{$generatesop->sop_title}} </h1>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 
    <table>
            
    <tr>
                    <td colspan="4" style="border:0px; text-align:left; font-weight: bold;">VERSION HISTORY</td>
                    </tr> 
                    <tr >
                        <th style align='left' width= '30%'>{{ trans('VERSION NO.') }}</th>  
                        <td>{{ $generatesop->version_no }}</td>

                        <th style align='left'>{{ trans('EFFECTIVE DATE') }}</th>
                        <td>{{ $generatesop->effective_date }} </td>
                    </tr>

                    <tr>
                        <th style align='left'>{{ trans('Process Owner') }}</th>
                        <td>{{ $generatesop->Process_owner }}</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th style align='left' >{{ trans('Process Execution') }}</th>
                        <td>{{  $generatesop->Process_exec }}</td>
                        <td></td>
                        <td></td>
                        
                    </tr>

                    <tr>
                        <th style align='left' >{{ trans('Reviewed By') }} <div style="font:50">(Name,ID)</div>  <div style="font:100"   >(Please Sign If printed)</div>  </th>
                        <td></td>
                        <th style align='left'>{{ trans('Approved By') }} <br> <div style="font:50">(Name,ID)</div>  <div style="font:100"   >(Please Sign If printed)</div>  </th>
                        <td>{{$generatesop->approved_by}}</td>
                    </tr>

                
            </table>

        <footer>
        Copyright 2021 Aeon Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)
        </footer>
        
        
        <div class="page_break">
          
            <h3> TABLE OF CONTENT</h3>
            <table>
            <tr>
            <td style align="center; font-weight: bold;">NO.</td>
            <td style align="center; font-weight: bold;"> DESCRIPTION</td>
            <td style align="center; font-weight: bold;">PAGE</td>
            </tr>

            <tr>
            <td style align='center'>1.</td>
            <td>Log History</td>
            <td style align='center'>3</td>
            </tr>

            <tr>
            <td style align='center'>2.</td>
            <td>Policy</td>
            <td style align='center'>4</td>
            </tr>
            
            <tr>
            <td style align='center'>3.</td>
            <td>Purpose</td>
            <td style align='center'>4</td>
            </tr>

            <tr>
            <td style align='center'>4.</td>
            <td>Scope</td>
            <td style align='center'>4</td>
            </tr>

            <tr>
            <td style align='center'>5.</td>
            <td>Review Procedure</td>
            <td style align='center'>5</td>
            </tr>

            <tr>
            <td style align='center'>6.</td>
            <td>Monitoring</td>
            <td style align='center'>5</td>
            </tr>

            <tr>
            <td style align='center'>7.</td>
            <td>Verification and Record Keeping</td>
            <td style align='center'>6</td>
            </tr>

            <tr>
            <td style align='center'>8.</td>
            <td>Process Flow  {{$generatesop->sop_title}}</td>
            <td style align='center'> 7</td>
            </tr>
            </table>
            
        <footer>
        Copyright &copy; Aeon Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)
        </footer>
        </div>


        <div class="page_break">  
            
            <h3> LOG HISTORY</h3>

            <table class="tb" >
            <tr>
            <th>Uploaded Date</th>
            <th>Created by</th>
            <th>Staff ID</th>

            <th>BUSINESS UNIT</th>
           
            </tr>

            <tr>
            <td>{{$generatesop->created_at}}</td>
            <td>{{$generatesop->uploaded_by}}</td>
            <td>{{$generatesop->Employee_id}}</td>
            <td>{{$generatesop->business_unit}}</td>
            
            </tr>
            </table>

        <footer>Copyright 2021 Aeon Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)</footer>
        </div>

        <div class="page_break">  
        
            <h3>POLICY</h3>
            <table>
            <td>{{$generatesop->policy}}</td>
            </table>

            <h3>PURPOSE</h3>
            <table>
            <td>{{$generatesop->purpose}}</td>
            </table>
             
            <h3>SCOPE</h3>
            <table>
            <td>{{$generatesop->scope}}</td>
            </table>
        
             <h3>REVIEW PROCEDURE</h3>
             <table>
            <td>{{$generatesop->review_pro}}</td>
            </table>

            <h3>MONITORING</h3>
            <table>
            <td>{{$generatesop->monitoring}}</td>
            </table>

            <h3>VERIFICATION AND RECORD KEEPING</h3>
            <table>
            <td>{{$generatesop->verification}}</td>
            </table>

            <footer>Copyright 2021 Aeon Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)</footer>
           
            </div>


        <div class="page_break">  


                <h3 >Process Flow of {{$generatesop->sop_title}} </h2> <br><br><br>
<?php 
$flow=explode(',',$generatesop->img);

foreach ($flow as $img) {
    

?>
@if($generatesop->img)
                <img  width="700px" height="600px"   src="{{Storage::disk('s3')->get('images/'.$img)}}" alt="">
                        
@endif
<?php 
}
?>                
          
            <footer>Copyright 2021 Aeon Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)</footer>
        </div>

        <div class="page_break"><br>

            <!-- Table for Procedure Code !-->         
             <h3>PROCEDURE</h3>
            <table>
            <tr>
            <td style="width: 30%; font-size:12px; "><b>1-{{ $generatesop->steps[0]}} </b></td>
            <td style="font-size: 12px;" >{{ $generatesop->desc[0]}}</td>
            </tr>

            @if(@isset($generatesop->steps[1]))
            <tr>
            <td style="width: 30%; font-size:12px; ">
            <b>2-{{ $generatesop->steps[1]}} </b>
            </td>
            <td style="font-size: 12px;" >  {{$generatesop->desc[1] }}  </td>
            </tr>
            @endif


            @if(@isset($generatesop->steps[2]))
            <tr>
            <td style="width: 30%; font-size:12px; ">
            <b>3-{{ $generatesop->steps[2]}} </b>
            </td>
            <td style="font-size: 12px;" >  {{$generatesop->desc[2] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[3]))
            <tr>
            <td   style="width: 30%; font-size:12px; ">
            <b>4-{{ $generatesop->steps[3]}} </b>
            </td>
            <td>  {{$generatesop->desc[3] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[4]))
            <tr>
            <td>
            <b>5-{{ $generatesop->steps[4]}} </b>
            </td>
            <td>  {{$generatesop->desc[4] }}  </td>
            </tr>
            @endif


            @if(@isset($generatesop->steps[5]))
            <tr>
            <td>
            <b>6-{{ $generatesop->steps[5]}} </b>
            </td>
            <td>  {{$generatesop->desc[5] }}  </td>
            </tr>
            @endif

            </tr>

            @if(@isset($generatesop->steps[6]))
            <tr>
            <td>
            <b>7-{{ $generatesop->steps[6]}} </b>
            </td>
            <td>  {{$generatesop->desc[6] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[7]))
            <tr>
            <td>
            <b>8-{{ $generatesop->steps[7]}} </b>
            </td>
            <td>  {{$generatesop->desc[7] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[8]))
            <tr>
            <td>
            <b>9-{{ $generatesop->steps[8]}} </b>
            </td>
            <td>  {{$generatesop->desc[8] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[9]))
            <tr>
            <td>
            <b>10-{{ $generatesop->steps[9]}} </b>
            </td>
            <td>  {{$generatesop->desc[9] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[10]))
            <tr>
            <td>
            <b>11-{{ $generatesop->steps[10]}} </b>
            </td>
            <td>  {{$generatesop->desc[10] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[11]))
            <tr>
            <td>
            <b>12-{{ $generatesop->steps[11]}} </b>
            </td>
            <td>  {{$generatesop->desc[11] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[12]))
            <tr>
            <td>
            <b>13-{{ $generatesop->steps[12]}} </b>
            </td>
            <td>  {{$generatesop->desc[12] }}  </td>
            </tr>
            @endif

            @if(@isset($generatesop->steps[13]))
            <tr>
            <td>
            <b>14-{{ $generatesop->steps[13]}} </b>
            </td>
            <td>  {{$generatesop->desc[13] }}  </td>
            </tr>
            @endif
            @if(@isset($generatesop->steps[14]))
            <tr>
            <td>
            <b>15-{{ $generatesop->steps[14]}} </b>
            </td>
            <td>  {{$generatesop->desc[14] }}  </td>
            </tr>
            @endif
            @if(@isset($generatesop->steps[15]))
            <tr>
            <td>
            <b>16-{{ $generatesop->steps[15]}} </b>
            </td>
            <td>  {{$generatesop->desc[15] }}  </td>
            </tr>
            @endif
            @if(@isset($generatesop->steps[16]))
            <tr>
            <td>
            <b>17-{{ $generatesop->steps[16]}} </b>
            </td>
            <td>  {{$generatesop->desc[16] }}  </td>
            </tr>
            @endif
        </table>

      
        <footer>Copyright 2021</footer>
        </div>

    <div class="page_break">  

        <h3 > APPENDIX</h3> <br><br>

 <?php 
$image=explode(',',$generatesop->appendix);

foreach ($image as $images) {
    

?>
       
@if($generatesop->appendix)

        <img  width="700px" height="600px"   src="C:\inetpub\wwwroot\Sop new\storage\app\public/{{$images}}" alt="">
        
        
@endif
<?php }?>        
    </div>

    </body>
</html>


