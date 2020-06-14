@extends('layouts.dashboard')

@section('content')
    <h3 class="box-title">Basic Table</h3>
    <p class="text-muted">Add class <code>.table</code></p>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Название</th>
          <th>Адрес</th>
          <th></th>
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
            <td>
              <a href="{{ route('editSite', ['id' => $site->id]) }}">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
              </a>
              <a href="{{ route('editSite', ['id' => $site->id]) }}">
                <i class="fa fa-archive fa-fw" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection
