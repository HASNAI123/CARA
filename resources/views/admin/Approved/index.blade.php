@extends('layouts.admin')
@section('content')
<br><br>



<div class="card">
    <div class="card-header" style="font-size:20px">
        <b>{{ trans('Approved SOP') }} {{ trans('global.list') }}</b>
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($approved_sop as $approved_sop)
                        <tr data-entry-id="{{ $approved_sop->id }}">
                            <td>

                            </td>
                            <td hidden >
                                {{ $approved_sop->id  }}
                            </td>
                            <td>
                                {{$loop->iteration}}
                                
                            </td>
                            <td>
                                {{$approved_sop->sop_title}}
                            </td>
                            <td>
                                {{$approved_sop->business_unit}}
                            </td>
                            <td>
                                {{ $approved_sop->uploaded_by  }}
                            </td>
                            <td>
                                {{$approved_sop->created_at}}
                            </td>
                            <td>
                                {{$approved_sop->effective_date}}
                            </td>
                            <td>
                                {{ $approved_sop->status  }}
                            </td>
                            <td>
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