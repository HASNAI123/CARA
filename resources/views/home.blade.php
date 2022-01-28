@extends('layouts.admin')
@section('content')
<style>
.flex-wrapper {
  display: flex;
  flex-flow: row nowrap;

}

.single-chart {
  width: 33%;
  justify-content: space-around ;

}

.circular-chart {
  display: block;
  margin: 10px auto;
  max-width: 70%;
  max-height: 150px;
}

.circle-bg {
  fill: none;
  stroke: #eee;
  stroke-width: 3.8;
}

.circle {
  fill: none;
  stroke-width: 2.8;
  stroke-linecap: round;
  animation: progress 1s ease-out forwards;
}

@keyframes progress {
  0% {
    stroke-dasharray: 0 100;

  }
}



.circular-chart.green .circle {
  stroke: #4CC790;

}

.circular-chart.red .circle {
  stroke: red;

}
.circular-chart.info .circle {
  stroke: #00BFFF;

}
.circular-chart.black .circle {
  stroke: black;

}





.percentage {
  fill: #666;
  font-family: sans-serif;
  font-size: 0.5em;
  text-anchor: middle;

}

</style>


<div  class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings1['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings1['chart_title'] }}</h3>
                            <table style="font-size: 15 px;"class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings1['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings1['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings1['data'] as $entry)
                                        <tr>
                                            @foreach($settings1['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings1['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings3['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings3['chart_title'] }}</h3>
                            <table style="font-size: 15px;" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings3['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings3['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings3['data'] as $entry)
                                        <tr>
                                            @foreach($settings3['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>

                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings3['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                <div class="row">
                  <div class="col-lg-3">
                  <div class="info-box-content">
                    <h3>Number of Employees</h3>
                     <div class="flex-wrapper">
                      <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart black">
                          <path class="circle-bg"
                            d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831"
                          />
                          <path class="circle"
                          stroke-dasharray="60, 100"
                          d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <text x="18" y="20.35" class="percentage">{{ $userCount }}</text>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="info-box-content">
                    <h3> Draft SOP</h3>
                     <div class="flex-wrapper">
                      <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart red">
                          <path class="circle-bg"
                            d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831"
                          />
                          <path class="circle"
                          stroke-dasharray="60, 100"
                          d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <text x="18" y="20.35" class="percentage">{{ $inprogress_sop }}</text>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="info-box-content">
                    <h3>Reviewed SOP</h3>
                     <div class="flex-wrapper">
                      <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart info">
                          <path class="circle-bg"
                            d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831"
                          />
                          <path class="circle"
                          stroke-dasharray="60, 100"
                          d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <text x="18" y="20.35" class="percentage">{{ $reviewed_sop }}</text>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">
                   <div class="info-box-content">
                    <h3>Approved SOP</h3>
                     <div class="flex-wrapper">
                      <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart green">
                          <path class="circle-bg"
                            d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831"
                          />
                          <path class="circle"
                          stroke-dasharray="60, 100"
                          d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <text x="18" y="20.35" class="percentage">{{ $approved_sop }}</text>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

              </div>













            <div class="content">
            <div class="row">
            @foreach ($list_blocks as $block)
                <div class="col-md-6">
                    <h3>{{ $block['title'] }}</h3>
                    <table style="font-size: 15px;" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Last login at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($block['entries'] as $entry)
                            <tr>
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->email }}</td>
                                <td>{{ $entry->last_login_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('No entries found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
