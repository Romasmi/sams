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
        </tr>
        </thead>
        <tbody>

        @foreach ($sites as $site)
          <tr>
            <td>{{$site->id}}</td>
            <td>{{$site->name}}</td>
            <td>{{$site->protocol}}://{{$site->domain}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection
