@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Cron Parser</h1>
  <p class="text-muted">Deskripsi jadwal cron dalam Bahasa Indonesia. Format: <code>menit jam tanggal bulan hari</code>.</p>
  <form method="POST" action="{{ url('/tools/cron-parser') }}">
    @csrf
    <div class="mb-3"><input name="expression" class="form-control" required placeholder="0 7 * * 1" value="{{ $input ?? '' }}"></div>
    <button class="btn btn-primary">Parse</button>
  </form>
  @if(!empty($error))<div class="alert alert-danger mt-3">{{ $error }}</div>@endif
  @if(!empty($result))<div class="mt-4"><p><strong>{{ $result['description'] }}</strong></p>
  <ul>@foreach($result['fields'] as $k=>$v)<li>{{ $k }}: <code>{{ $v }}</code></li>@endforeach</ul></div>@endif
</div>
@endsection
