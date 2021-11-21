@extends('layouts.admin')
@section('content')
<br><br>
    



 @can('Create_folder') 
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create Folder
</button>
@endcan

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Folder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route("admin.folders.store") }}" enctype="multipart/form-data">
              @csrf
        <label>Folder Title</label>
        <input type="text" name="folder_title" value="{{ old('title', '') }}" >

        <br><br>

        <label>Password </label>
        &emsp;<input type="password" name="password" value="{{ old('title', '') }}" >
        
      </div>
      <div class="modal-footer">
      <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
                </form>
      </div>
    </div>
  </div>
</div>


<br>

<br><br>
<div class="card">
    <div style="font-size:30px" class="card-header">
       <B> {{ trans('SOP') }} {{ trans('library') }}</B>
    </div>
    <br><br>

    <div class="card-body">
        <div class="table-responsive">
            <table style="font-size: 15px;" class=" table table-bordered table-striped table-hover datatable datatable-Sop">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th hidden>
                            {{ trans('id') }}
                        </th>
                        
                        <th>
                            {{trans('No.')}}
                            
                        </th>
                        <th>
                            {{ trans('Folder Title') }}
                        </th>
                       
                        <th>
                            {{ trans('Date Created') }}
                        </th>
                        <th>
                            {{ trans('Created by') }}
                        </th>
                        
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($folders as $folders)
                        <tr data-entry-id="{{ $folders->id }}">
                            <td>

                            </td>
                            <td hidden >
                                {{ $folders->id  }}
                            </td>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                <i class="fa fa-folder-open"></i> {{$folders->title}} 
                            </td>
                            <td>
                                {{$folders->created_at}}
                            </td>
                            <td>
                                {{$folders->created_by}}
                            </td>
                            
                            <td>
                           
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.folders.check',$folders->id) }}"> 
                                        {{ trans('View Files') }}
                                    </a>

                                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"> Edit Folder Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('admin.folders.update',$folders->id) }}" enctype="multipart/form-data">
      @method('PUT')
              @csrf
        <input type="text" name="folder_title">
        
      </div>
      <div class="modal-footer">
      <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
                </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit button  -->
 @can('Folder_edit') 
<a class="btn btn-xs btn-info" href="{{ route('admin.folders.edit',$folders->id) }}"> 
                                        {{ trans('Edit ') }}
                                    </a>
                                    @endcan
                                        
                                    @can('Folder_delete')    
                                     <form action="{{ route('admin.folders.destroy', $folders->title) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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