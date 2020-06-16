@extends('layouts.dashboard')

@section('content')
  <form method="POST" action="{{ route('createSite') }}">
    @csrf

    <h2>Основные настройки</h2>

    <div class="form-group">
      <label for="name">Название</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Введите название сайта" {{ old('name') }} required>
    </div>
    <div class="form-group">
      <label for="domain">Адрес сайта</label>
      <input type="text" class="form-control" name="domain" id="domain" placeholder="www.example.com" value="{{ old('domain') }}" required>
    </div>
    <div class="form-group">
      <label class="radio-inline">
        <input type="radio" name="protocol" value="https" checked>
        https
      </label>
      <label class="radio-inline">
        <input type="radio" name="protocol"  value="http">
        http
      </label>
    </div>

    <h2>Настройки периодов обновления</h2>
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <div class="form-group">
          <label for="checkHttpCode">Проверка кодов ответа</label>
          <select class="form-control" id="checkHttpCode" name="jobPeriod[checkHttpCode]">
            @foreach(App\Model\SiteJobPeriod::periods as $period)
              <option value="{{$period['value']}}">{{$period['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="form-group">
          <label for="checkScoring">Проверка рейтинга производительности</label>
          <select class="form-control" id="checkScoring" name="jobPeriod[checkScoring]">
            @foreach(App\Model\SiteJobPeriod::periods as $period)
              <option value="{{$period['value']}}">{{$period['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-default">Добавить</button>
  </form>
@endsection