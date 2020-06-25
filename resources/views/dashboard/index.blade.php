@extends('layouts.dashboard')

@section('content')
    <p class="text-muted">
      <i class="fa fa-lock" aria-hidden="true"></i> - защищённый SSL сертификатом сайт,
      <i class="fa fa-edit" aria-hidden="true"></i> - редактировать,
      <i class="fa fa-archive" aria-hidden="true"></i> - в архив
    </p>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Название</th>
          <th>Адрес</th>
          <th class="text-center">Код ответа</th>
          <th class="text-center">PS</th>
          <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($sites as $site)
          <tr class="table-row">
            <td>{{$site->id}}</td>
            <td>{{$site->name}}</td>
            <td>
              @if ($site->protocol == 'https')
                <i class="fa fa-lock" aria-hidden="true"></i>
              @endif
              <a href="{{$site->protocol}}://{{$site->domain}}" target="_blank" title="Перейти на сайте {{$site->name}}">
                {{$site->domain}}
              </a>
            </td>
            <td class="text-center">
            @if ($site->lastHttpCode())
              {{$site->lastHttpCode()->http_code}}
                <div class="option-date">({{$site->lastHttpCode()->updated_at->format('d.m.y H:i')}})</div>
            @else
              -
            @endif
            </td>
            <td class="text-center">
              @if ($site->lastGoogleScore()->mobile)
                <span class="google-score">
                <i class="fa fa-mobile-phone"></i> {{$site->lastGoogleScore()->mobile->score}}
                </span>
              @endif
              @if ($site->lastGoogleScore()->desktop)
                <span class="google-score">
                <i class="fa fa-desktop"></i> {{$site->lastGoogleScore()->desktop->score}}
                </span>
              @endif
              @if ($site->lastGoogleScore()->updatedAt)
                <div class="option-date">({{$site->lastGoogleScore()->updatedAt->format('d.m.y H:i')}})</div>
              @else
                -
              @endif
            </td>
            <td>
              <a href="{{ route('showSite', ['id' => $site->id]) }}" title="Просмотр статистики сайта" class="btn btn-link">
                <i class="fa fa-area-chart fa-fw" aria-hidden="true"></i>
              </a>

              <a href="{{ route('editSite', ['id' => $site->id]) }}" title="Перейти к редактированию сайта" class="btn btn-link">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
              </a>

              <form class="ajax-form d-inline-block" method="POST" action="{{ route('metricsFullUpdate')}}">
                @csrf
                <input type="hidden" name="siteId" value="{{$site->id}}">

                @if ($site->metricsOnUpdating())
                  <button type="submit" title="Обновить показатели" class="btn btn-link update-metrics-button update-button loading" disabled>
                    <i class="fa fa-spinner fa-fw" aria-hidden="true"></i>
                  </button>
                @else
                <button type="submit" title="Обновить показатели" class="btn btn-link update-metrics-button update-button">
                  <i class="fa fa-play fa-fw" aria-hidden="true"></i>
                </button>
                @endif
              </form>


              <button type="button" title="Поместить в архив" class="btn btn-link delete-button">
                <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
              </button>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection
