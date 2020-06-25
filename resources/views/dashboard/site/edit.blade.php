@extends('layouts.dashboard')

@section('content')
  <form class="ajax-form" method="POST" action="{{ route('updateSite', ['id' => $site->id]) }}">
    @csrf

    <h2>Основные настройки</h2>
    <div class="form-group">
      <label for="name">Название</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Введите название сайта"
             value="{{ $site->name }}" required>
    </div>
    <div class="form-group">
      <label for="domain">Адрес сайта</label>
      <input type="text" class="form-control" name="domain" id="domain" placeholder="www.example.com"
             value="{{  $site->domain }}" required>
    </div>
    <div class="form-group">
      <label class="radio-inline">
        <input type="radio" name="protocol" value="https" @if ($site->protocol == 'https') checked @endif>
        https
      </label>
      <label class="radio-inline">
        <input type="radio" name="protocol" value="http" @if ($site->protocol == 'http') checked @endif>
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
              <option
                      value="{{$period['value']}}"
                      @if ($site->jobPeriods['checkHttpCode'] == $period['value']) selected @endif>
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
            @foreach(App\Model\SiteJobPeriod::periods as $period)
              <option
                      value="{{$period['value']}}"
                      @if ($site->jobPeriods['checkScoring'] == $period['value']) selected @endif>
                {{$period['name']}}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
  </form>

  <form class="ajax-form" method="POST" action="{{ route('addPages', ['id' => $site->id]) }}">
    @csrf
    <h2>Добавить страницы сайта для мониторинга</h2>
    <p>
      Вставьте адреса страниц, каждый с новой строки. Желательно вставлять только страницы с уникальным дизайном или
      особенностями интерфейса.
      Адреса ранее добавленные в систему добавляться не будут.
    </p>
    <div class="form-group">
      <textarea name="pages" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default">Добавить страницы</button>
    </div>
  </form>
  @if (count($site->pages) != 0)
    <h3>Список добавленных страниц</h3>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Адрес</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($site->pages as $page)
          <tr class="table-row">
            <td>{{$page->id}}</td>
            <td>{{$site->domain}}{{$page->link}}</td>
            <td>
              <form class="ajax-form" method="POST" action="{{ route('deletePage', ['id' => $page->id]) }}">
                @csrf
                <button type="submit" class="btn btn-link delete-button">
                  <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif

@endsection