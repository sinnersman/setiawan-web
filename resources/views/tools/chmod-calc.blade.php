@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Chmod Calculator</h1>
  <p class="text-muted">Konversi oktal ⇄ simbolik. Isi salah satu.</p>
  <form method="POST" action="{{ url('/tools/chmod-calc') }}">
    @csrf
    <div class="mb-3"><label>Oktal (mis. 755)</label><input name="octal" class="form-control" pattern="[0-7]{3,4}" placeholder="755" value="{{ $result['octal'] ?? '' }}">@error('octal')<div class="text-danger">{{ $message }}</div>@enderror</div>
    <div class="mb-3"><label>Simbolik (mis. rwxr-xr-x)</label><input name="symbolic" class="form-control" placeholder="rwxr-xr-x" value="{{ $result['symbolic'] ?? '' }}"></div>
    <button class="btn btn-primary">Hitung</button>
  </form>
  @if(!empty($result))<div class="mt-4"><p>Oktal: <code>{{ $result['octal'] }}</code> — Simbolik: <code>{{ $result['symbolic'] }}</code></p></div>@endif
</div>
@endsection
