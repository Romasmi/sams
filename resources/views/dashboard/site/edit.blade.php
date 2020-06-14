@extends('layouts.dashboard')

@section('content')
  <form class="ajax-form" method="POST" action="{{ route('updateSite', ['id' => $site->id]) }}">
    @csrf

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
    <p class="server-response" style="display: none;"></p>
    <button type="submit" class="btn btn-default">Сохранить</button>
  </form>
@endsection