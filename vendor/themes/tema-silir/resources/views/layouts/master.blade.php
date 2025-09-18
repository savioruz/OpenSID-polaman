@extends('theme::template')
@include('theme::commons.globals')

@section('layout')
  @include('theme::commons.header')
  @include('theme::commons.main_nav')

  @if ($layout === 'full-content')
    <section class="container px-3 max-w-container mx-auto w-full space-y-5 my-5">
      @include('theme::partials.newsticker')
      <main class="card content w-full">
        @yield('content')
      </main>
      @include('theme::widgets.shortcut_links')
    </section>
    @elseif($layout === 'left-sidebar')
      <section class="container px-3 max-w-container mx-auto space-y-5 my-5">
        @include('theme::partials.newsticker')
        <div class="content-wrapper my-5 lg:flex-row-reverse">
          <main class="card content">
            @yield('content')
          </main>
          @include('theme::partials.sidebar')
        </div>
        @include('theme::widgets.shortcut_links')
      </section>
    @else
      <section class="container px-3 max-w-container mx-auto space-y-5 my-5">
        @include('theme::partials.newsticker')
        <div class="content-wrapper my-5">
          <main class="card content">
            @yield('content')
          </main>
          @include('theme::partials.sidebar')
        </div>
        @include('theme::widgets.shortcut_links')
      </section>
  @endif
@endsection