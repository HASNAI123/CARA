@extends('layouts.admin')
@section('content')
<br><br>
<div class="form-group">
                <a class="btn btn-primary" href="{{ route("admin.archivefolders.index") }}">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>  {{ trans('Archive library') }}
                </a>
            </div>
<br>



     @can('Sop_upload')
    <a class="btn btn-success" href="{{ route('admin.sops.index') }}">
      {{ trans('global.upload') }} {{ trans('cruds.sop.title_singular') }}
     </a>
     @endcan
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
                            {{ trans('SOP owner') }}
                        </th>
                        <th>
                            {{ trans('Created at') }}
                        </th>
                        <th>
                            {{ trans('Effective date') }}
                        </th>
                        <th>
                            {{ trans('Modified by') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sop as $sop)
                        <tr data-entry-id="{{ $sop->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sop->id  }}
                            </td>
                            <td>
                                {{$loop->iteration}}
                                
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
                            {{$sop->created_at}}
                            </td>
                            <td>
                                {{$sop->effective_date}}
                            </td>
                            
                            <td>
                                {{ $sop->Modified_by  }}
                            </td>

                            <td>
                           
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sops.download', $sop->sop_file) }}">
                                        {{ trans('View & Download') }}
                                    </a>
                               

                                    @can('Sop_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sops.edit', $sop->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                     @endcan

                                    

                                  
                                    <form action="{{ route('admin.generatesop.destroy', $sop->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                 
                    

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