<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>@yield('title', 'Escola Laravel')</title>
<style>body{font:16px system-ui;background:#f3f5fa;color:#18253e;margin:0}nav{background:#18253e;padding:20px;display:flex;gap:24px;align-items:center}nav a{color:white}main{max-width:1000px;margin:36px auto;padding:28px;background:white;border-radius:12px}a{color:#334db5}label{display:block;margin:16px 0}input,select,button{font:inherit;padding:10px;border:1px solid #aab3c8;border-radius:6px}button{cursor:pointer}table{width:100%;border-collapse:collapse}td,th{padding:12px;text-align:left;border-bottom:1px solid #ddd}.error{color:#a21b32}.success{color:#176b3d}</style>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body>@include('partials.menu')<main>
@if(session('success'))<p class="success">{{ session('success') }}</p>@endif
@if($errors->any())<ul class="error">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
@isset($header){{ $header }}@endisset
@yield('content')
{{ $slot ?? '' }}</main></body></html>
