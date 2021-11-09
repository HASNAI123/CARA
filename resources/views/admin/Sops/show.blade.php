@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sop.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.id') }}
                        </th>
                        <td>
                            {{ $sop->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.uploaded_by') }}
                        </th>
                        <td>
                            {{ $sop->uploaded_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.sop_file') }}
                        </th>
                        <td>
                            @if($sop->sop_file)
                                <a href="{{ $sop->sop_file }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.accepted_by') }}
                        </th>
                        <td>
                            {{ $sop->accepted_by }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection