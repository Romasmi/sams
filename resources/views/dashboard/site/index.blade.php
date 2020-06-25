@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-8">
      <h2>Фильтрация</h2>
      <form class="row" method="GET" action="{{ route('showSite', ['id' => $site->id]) }}">
        @csrf
        <div class="form-group col-xs-12 col-md-4 col-lg-3">
          <label for="dateFrom">От</label>
          <input type="date" name="dateFrom" class="form-control" id="dateFrom" value="{{$filter->dateFrom}}">
        </div>
        <div class="form-group col-xs-12 col-md-4 col-lg-3">
          <label for="dateTo">До</label>
          <input type="date" name="dateTo" class="form-control" id="dateTo" value="{{$filter->dateTo}}">
        </div>
        <div class="form-group col-xs-12 col-md-4 col-lg-2">
          <label for="dataCount">Кол-во измерений</label>
          <input type="number" name="limit" class="form-control" id="dataCount" value="{{$filter->limit}}">
        </div>
        <div class="col-xs-12">
          <button type="submit" class="btn btn-default">Обновить</button>
        </div>
      </form>
    </div>
    <div class="col-md-4 text-right">
      <a href="{{ route('editSite', ['id' => $site->id]) }}" title="Перейти к редактированию сайта">Редактировать
        сайт</a>
    </div>
  </div>
  <h2>Периоды мониторинга</h2>
  <ul class="options-list">
    @foreach(\App\Model\SiteJobPeriod::jobName as $key => $value)
      <li>{{$value}}: <span class="value">{{Str::lower($site->jobPeriods[$key])}}</span></li>
    @endforeach
  </ul>
  <h3>Мониторинг рейтинга производительности</h3>
  @foreach($site->stat as $page)
    <h4>Страница: {{$site->protocol}}://{{$site->domain}}{{$page['url']}}</h4>

    <ul class="list-inline text-right">
      <li>
        <h5>
          <i class="fa fa-circle m-r-5 text-info"></i>
          Mobile
          <i class="fa fa-mobile-phone"></i>
        </h5>
      </li>
      <li>
        <h5>
          <i class="fa fa-circle m-r-5 text-inverse"></i>
          Desktop
          <i class="fa fa-desktop"></i>
        </h5>
      </li>
    </ul>

    <div class="google-score-chart" id="googleScoreChart{{$loop->iteration}}" data-stat="{{$page['stat']}}" style="height: 405px;"></div>

  @endforeach

@endsection

@section('scripts')
  <script src="{{ asset('bower_components/chartist-js/dist/chartist.min.js') }}"></script>
  <script src="{{ asset('bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>

  <script>
      $(function () {

          $('.google-score-chart').each(function () {
              let _this = $(this);
              const stat = _this.data('stat');
              let chart = new Chartist.Line('#' + _this.attr('id'), {
                  labels: stat.label,
                  series: [
                      stat.data.desktop,
                      stat.data.mobile
                  ]
              }, {
                  top: 0,
                  low: 1,
                  showPoint: true,
                  fullWidth: true,
                  plugins: [
                      Chartist.plugins.tooltip()
                  ]
              });
          });
      });
  </script>

@endsection

