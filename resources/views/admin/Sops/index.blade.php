@extends('layouts.admin')
@section('content')
<br><br>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">

            <div class="form-group">
                <a class="btn btn-primary" href="{{ route("admin.archivefolders.index") }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            
            
             


        @can('Sop_upload')
           @foreach($archive_folders as $archive_folder)
            <a class="btn btn-success" href="{{ route('admin.sops.create',$archive_folder) }}">
                {{ trans('global.upload') }} {{ trans('cruds.sop.title_singular') }}
            </a>
            @endforeach

            @endcan
        </div>
    </div>

<br><br>
<div class="card">
    <div style="font-size:30px" class="card-header">
       <B> {{ trans('cruds.sop.title_singular') }} {{ trans('global.list') }}</B>
    </div>
    <br><br>

    <div class="card-body">
        <div class="table-responsive">
            <table style="font-size: 15px;" class=" table table-bordered table-striped table-hover datatable datatable-Sop">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sop.fields.id') }}
                        </th>
                        <th>
                            {{ trans('SOP Title') }}
                        </th>
                        <th>
                            {{ trans('Business Unit') }}
                        </th>
                        <th>
                            {{ trans('Uploaded By') }}
                        </th>
                        
                        <th>
                            {{ trans('Effective date') }}
                        </th>
                        <th>
                            {{ trans('Modified by') }}
                        </th>
                        <th>
                            {{ trans('Modified date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sops as $sop)
                        <tr data-entry-id="{{ $sop->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sop->id  }}
                            </td>
                            <td>
                                {{$sop->sop_title}}
                            </td>
                            <td>
                                {{$sop->business_unit}}
                            </td>
                            <td>
                                {{ $sop->uploaded_by  }}
                            </td>
                           
                            <td>
                                {{$sop->effective_date}}
                            </td>
                          
                            <td>
                                {{ $sop->Modified_by  }}
                            </td>
                            
                            <td>
                                {{ $sop->Modified_date }}
                            </td>
                            <td>
                           
                                  
                               

                                    @can('Sop_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sops.edit', $sop->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                     @endcan

                                     <a class="btn btn-xs btn-info" href="#"  target="_blank" data-toggle="modal" data-target="#exampleModal-{{$sop->id}}">
                                        {{ trans(' View & Download') }}
                                    </a>

                                    @can('Sop_delete')
                                    <form action="{{ route('admin.sops.destroy', $sop->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan
                            </td>
                        </tr>
                        
                        <!-- Modal -->
                          <div class="modal fade" id="exampleModal-{{$sop->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Acknowledgement</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form method="POST" action="{{ route('admin.sops.download',$sop->sop_file) }}" enctype="multipart/form-data">
                                        @method('GET')
                                        @csrf
                                   <p>I hereby acknowledge that i am going to view and download the following documents from CARA (caramyaeon.com.my).</p> 
                                   <p>I acknowledge the it is my responsbility to read, understand, and adhere to these procedures.</p>
                                   <p>I further understand that any failure to fully adhere to the said procedure by me may result in disciplinary action, including termination.</p>  

                                  <div class="row">
                                    <div class="col-md-6">
                                      <input type="radio" name="radio" value="agree" id="agree" required=""> Agree 
                                    </div> 

                                    <div class="col-md-6">
                                    <input type="radio" name="radio" value="disagree"  id="disagree" /> Disagree
                                    </div>
                                  </div>
                                  <br/>
                            
                                <div class="question" style="display: none">
                                    <p>In case of any disagreement or discrepancy in the procedures, it is within my responsibility to provide feedback to the Process Owner.</p>

                                     <div class="row">
                                    <div class="col-md-6">
                                      <input type="radio" name="radio2" value="agree2" id="agree2" required=""> Agree   
                                    </div> 

                                    <div class="col-md-6">
                                    <input type="radio" name="radio2" value="disagree2"  id="disagree2" /> Disagree
                                    </div>
                                  </div>                                    
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-success" id="btn" type="submit">
                                              {{ trans('Ok') }}
                                </button>
                                </form>
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
              if($(this).attr("value")=="disagree"){
                 $(".question").show();
                 $('#agree2').prop('required',true);
              }
              if($(this).attr("value")=="agree"){
                 $(".question").hide();
                 $('#agree2').prop('required',false);
              }  
              if($(this).attr("value")=="disagree2"){
                 $('#btn').hide();
              }else{
                $('#btn').show();
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