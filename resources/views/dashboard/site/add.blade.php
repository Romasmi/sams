@extends('layouts.dashboard')

@section('content')
  <form method="POST" action="{{ route('addSite') }}">
    @csrf

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
    <button type="submit" class="btn btn-default">Добавить</button>
  </form>
@endsection