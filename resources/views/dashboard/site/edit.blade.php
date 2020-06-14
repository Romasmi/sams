@extends('layouts.dashboard')

@section('content')
  <form class="ajax-form" method="POST" action="{{ route('updateSite', ['id' => $site->id]) }}">
    @csrf

    <h2>Основные настройки</h2>
    <div class="form-group">
      <label for="name">Название</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Введите название сайта" value="{{ $site->name }}" required>
    </div>
    <div class="form-group">
      <label for="domain">Адрес сайта</label>
      <input type="text" class="form-control" name="domain" id="domain" placeholder="www.example.com" value="{{  $site->domain }}" required>
    </div>
    <div class="form-group">
      <label class="radio-inline">
        <input type="radio" name="protocol" value="https" @if ($site->protocol == 'https') checked @endif>
        https
      </label>
      <label class="radio-inline">
        <input type="radio" name="protocol"  value="http" @if ($site->protocol == 'http') checked @endif>
        http
      </label>
    </div>
    <h2>Настройки периодов обновления</h2>
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <div class="form-group">
          <label for="checkHttpCode">Проверка кодов ответа</label>

          <select class="form-control" id="checkHttpCode" name="jobPeriod[checkHttpCode]">
            @foreach(App\SiteJobPeriod::periods as $period)
              <option
                      value="{{$period['value']}}"
                      @if ($jobPeriods['checkHttpCode'] == $period['value']) selected @endif>
                {{$period['name']}}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="form-group">
          <label for="checkScoring">Проверка рейтинга производительности</label>
          <select class="form-control" id="checkScoring" name="jobPeriod[checkScoring]">
            @foreach(App\SiteJobPeriod::periods as $period)
              <option
                      value="{{$period['value']}}"
                      @if ($jobPeriods['checkScoring'] == $period['value']) selected @endif>
                {{$period['name']}}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <p class="server-response" style="display: none;"></p>
    <button type="submit" class="btn btn-default">Сохранить</button>
  </form>
@endsection