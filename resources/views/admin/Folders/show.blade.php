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
                           
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.generatesop.show', $generatesop->id) }}" target="_blank">
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
                    @endforeach
            
                
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
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