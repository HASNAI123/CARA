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

             @foreach($archive_folders as $archive_folder)
            
             @endforeach


        @can('Sop_upload')
            <a class="btn btn-success" href="{{ route('admin.sops.create',$archive_folder) }}">
                {{ trans('global.upload') }} {{ trans('cruds.sop.title_singular') }}
            </a>

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

                                     <a class="btn btn-xs btn-info" href="{{ route('admin.sops.download',$sop->sop_file ) }}">
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