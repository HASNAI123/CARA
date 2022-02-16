@extends('layouts.admin')
@section('content')
<br><br>

<div class="form-group">
                <a class="btn btn-primary" href="{{ route("admin.folders.index") }}">
                   <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ trans('SOP Library') }}
                </a>
</div>

<br><br>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sop.title_singular') }} {{ trans('global.list') }}
    </div>
    <br><br>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sop">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th hidden>
                            {{ trans('cruds.sop.fields.id') }}
                        </th>
                        <th>
                            {{trans('No.')}}
                            
                        </th>
                        <th>
                            {{ trans('SOP Title') }}
                        </th>
                        <th>
                            {{ trans('Business Unit') }}
                        </th>
                        <th>
                            {{ trans('Created by') }}
                        </th>
                        <th>
                            {{ trans('Created at') }}
                        </th>
                        <th>
                            {{ trans('Effective date') }}
                        </th>
                        <th>
                            {{ trans('Status') }}
                        </th>
                         <th>
                            {{ trans('Edited by') }}
                        </th>
                        
                         <th>
                            {{ trans('Approved by') }}
                        </th>
                        

                    
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($generatesop as $generatesop)
                        <tr data-entry-id="{{ $generatesop->id }}">
                            <td>

                            </td>
                            <td hidden >
                                {{ $generatesop->id  }}
                            </td>
                            <td>
                                {{$loop->iteration}}
                                
                            </td>
                            <td>
                                {{$generatesop->sop_title}}
                            </td>
                            <td>
                                {{$generatesop->business_unit}}
                            </td>
                            <td>
                                {{ $generatesop->uploaded_by  }}
                            </td>
                            <td>
                            {{$generatesop->created_at}}
                            </td>
                            <td>
                                {{$generatesop->effective_date}}
                            </td>
                            
                            <td>
                                {{ $generatesop->status  }}
                            </td>
                            <td>
                                {{ $generatesop->edited_by  }}
                            </td>
                             <td>
                                {{ $generatesop->approved_by  }}
                            </td>
                         

                           
                            <td>
                           
                                    <a class="btn btn-xs btn-primary" href="" target="_blank" data-toggle="modal" data-target="#exampleModal-{{$generatesop->id}}">
                                        {{ trans('View & Download') }}
                                    </a>
                                    
                                     @can('Sop_approve') 
                                    <a class="btn btn-xs btn-success" href="{{ route('admin.generatesop.approve', $generatesop->id) }}">
                                        {{ trans('Approve') }}
                                    </a>
                                     @endcan
                                     
                                      @can('Sop_reviewer')
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.generatesop.review', $generatesop->id) }}">
                                        {{ trans('Review') }}
                                    </a>
                                      @endcan
                               

                                     @if($generatesop->approved_by == null)

                                    @can('Sop_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.generatesop.edit', $generatesop->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    @endcan
                                    @endif

                                    

                                  
                                  @can('Sop_delete')
                                  <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" href="{{ route('admin.generatesop.delete', $generatesop->id) }}">
                                        {{ trans('global.delete') }}
                                    </a>
                                  @endcan  
                            </td>

                        </tr>
                        
                        <!-- Modal -->
                          <div class="modal fade" id="exampleModal-{{$generatesop->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Acknowledgement<br><i>Pengakuan</i></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form method="POST" action="{{ route('admin.generatesop.show',$generatesop->id) }}" enctype="multipart/form-data">
                                        @csrf
                                    
                                  <ol type="1">
                                  <li><p> I hereby acknowledge that i am going to view and download the following documents from CARA (caramyaeon.com.my).<br>
                                       <i>Saya dengan ini mengakui bahawa saya akan melihat dan memuat turun dokumen berikut daripada CARA (caramyaeon.com.my).</i></p></li>
                                   
                                   <li><p> I acknowledge the it is my responsbility to read, understand, and adhere to these procedures.<br>
                                       <i>Saya mengakui tanggungjawab saya untuk membaca, memahami dan mematuhi prosedur ini.</i></p></li>
                                   
                                   <li><p> I further understand that any failure to fully adhere to the said procedure by me may result in disciplinary action, including termination.<br>
                                       <i>Saya selanjutnya memahami bahawa sebarang kegagalan untuk mematuhi sepenuhnya prosedur tersebut oleh saya boleh mengakibatkan tindakan tatatertib, termasuk pemberhentian.</i></p></li>
                                 
                                  
                                  
                                  <div class="row">
                                    <div class="col-md-6">
                                      <input type="radio" name="radio" value="agree" class="agree" required=""> Agree 
                                    </div> 

                                    <div class="col-md-6">
                                    <input type="radio" name="radio" value="disagree"  class="disagree" /> Disagree
                                    </div>
                                  </div>
                                  
                                  <br/>
                            
                                <div class="question" style="display: none">
                                    <li><p>In case of any disagreement or discrepancy in the procedures, it is within my responsibility to provide feedback to the Process Owner.<br>
                                    <i>Sekiranya terdapat sebarang percanggahan atau percanggahan dalam prosedur, adalah menjadi tanggungjawab saya untuk memberikan maklum balas kepada Pemilik Proses.</i></p></li>
                                     
                                     
                                     
                                     
                                     <div class="row" >
                                    <div class="col-md-6">
                                      <input type="radio" name="radio2" value="agree" class="agree2" required=""> Agree   
                                    </div> 

                                    <div class="col-md-6">
                                    <input type="radio" name="radio2" value="disagree"  class="disagree2" /> Disagree
                                    </div>
                                    
                                  </div>
                                
                                
                                </div>
                                </div>
                                
                                <div class="modal-footer">
                                <button class="btn btn-success btn_hide" type="submit">
                                              {{ trans('OK') }}
                                </button>
                                </form>
                                </ol>
                                </div>
                              </div>
                            </div>
                          </div>
                    @endforeach
            
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $(function () {
           $('input[type="radio"]').click(function(){
              if($(this).attr("class")=="disagree"){
                 $(".question").show();
                 $('.agree2').prop('required',true);
                  $('.agree').prop('required',false);
              }
              if($(this).attr("class")=="agree"){
                 $(".question").hide();
                 $('.agree2').prop('required',false);
                 $('.agree2').prop('checked', false);
                 $('.disagree2').prop('checked', false);
              }  
              if($(this).attr("class")=="disagree2"){
                 $('.btn_hide').hide();
              }else{
                $('.btn_hide').show();
              }        
        });
        });
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sops.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Sop:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
})

</script>
@endsection