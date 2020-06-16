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
        </tr>
        </thead>
        <tbody>

        @foreach ($sites as $site)
          <tr>
            <td>{{$site->id}}</td>
            <td>{{$site->name}}</td>
            <td>
              @if ($site->protocol == 'https')
                <i class="fa fa-lock" aria-hidden="true"></i>
              @endif
              {{$site->domain}}
            </td>
            <td class="text-center">
              {{$site->lastHttpCode()->http_code}}
              <div class="option-date">({{$site->lastHttpCode()->updated_at->format('d.m.y H:i')}})</div>
            </td>
            <td>
              <a href="{{ route('editSite', ['id' => $site->id]) }}">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
              </a>
              <a href="{{ route('editSite', ['id' => $site->id]) }}">
                <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection
