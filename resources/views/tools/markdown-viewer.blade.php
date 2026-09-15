@extends('layouts.app')
@section('content')
<div class="container py-10" style="max-width:720px">
  <h1>Markdown Viewer</h1>
  <p class="text-muted">Render Markdown dengan aman (HTML di-escape, link hanya http/https).</p>
  <form method="POST" action="{{ url('/tools/markdown-viewer') }}">
    @csrf
    <div class="mb-3"><textarea name="markdown" class="form-control font-monospace" rows="6" required>{{ $input ?? '' }}</textarea></div>
    <button class="btn btn-primary">Render</button>
  </form>
  @if(!empty($result))<div class="mt-4 border rounded p-3">{!! $result !!}</div>@endif
</div>
@endsection
