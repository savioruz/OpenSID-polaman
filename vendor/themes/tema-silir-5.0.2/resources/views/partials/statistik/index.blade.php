@extends('theme::template')
@include('theme::commons.globals')

@section('layout')
  @include('theme::commons.header')
  @include('theme::commons.main_nav')

  <section class="container px-3 max-w-container mx-auto space-y-5 my-5">
    @include('theme::partials.newsticker')

    <div class="content-wrapper my-5 flex-col-reverse lg:flex-row">
      <aside class="lg:w-1/4 sticky top-14 w-full" style="align-self: flex-start">
        @include('theme::partials.statistik.sidenav')
      </aside>
      <main class="card content main-content lg:w-3/4">
        @include('theme::partials.statistik.default')
        <script>const enable3d = {{ setting('statistik_chart_3d') }} ? true : false;</script>
      </main>
    </div>
    @include('theme::widgets.shortcut_links')
  </section>
@endsection