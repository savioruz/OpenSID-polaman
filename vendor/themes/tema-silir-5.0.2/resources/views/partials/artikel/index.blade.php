@extends('theme::template')
@include('theme::commons.globals')

@php
  $title = (!empty($judul_kategori))? $judul_kategori: 'Artikel Terkini';
  $slug = 'terkini';
  if(is_array($title)){
    $slug = $title['slug'];
    $title = $title['kategori'];
  }
@endphp

@section('layout')
  @php $home_style = theme_config('home_style') ?? beranda @endphp
  @include("theme::partials.home.$home_style")
@endsection