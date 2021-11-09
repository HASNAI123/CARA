@extends('layouts.admin')
@section('content')
<br><br>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.generatesop.create') }}">
                {{ trans('Generate ') }} {{ trans('cruds.sop.title_singular') }}
            </a>
        </div>
    </div>

<br><br>
<div class="card">
    <div style="font-size:30px" class="card-header">
       <B> {{ trans('Generated') }} {{ trans('SOP') }}</B>
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
                            {{ trans('Created By') }}
                        </th>
                        <th>
                            {{ trans('Date Created ') }}
                        </th>
                        <th>
                            {{ trans('Effective date') }}
                        </th>
                        <th>
                            {{ trans('Status') }}
                        </th>
                        <th>
                            {{ trans('Revised by') }}
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
                            <td>
                                {{ $generatesop->id  }}
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
                                {{$generatesop->status  }}
                            </td>
                            <td>
                                {{ $generatesop->edited_by  }}
                            </td>
                            <td>
                           
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.generatesop.show', $generatesop->id) }}">
                                        {{ trans('View & Download') }}
                                    </a>


                                    
                                    @can('Sop_approve') 
                                    <a class="btn btn-xs btn-success" href="{{ route('admin.generatesop.approve', $generatesop->id) }}">
                                        {{ trans('Approve') }}
                                    </a>
                                     @endcan
                               

                                    @can('Sop_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.generatesop.edit', $generatesop->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                     @endcan

                                    

                                    @can('Sop_delete')
                                    <form action="{{ route('admin.generatesop.destroy', $generatesop->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.generatesop.massDestroy') }}",
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