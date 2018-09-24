@extends('layouts.app')

@section('content')
    <div class="withsidebar container">
        <main class="withsidebar__main">
            @yield('main-content')
        </main>
        <aside class="withsidebar__sidebar">
            @yield('sidebar')
        </aside>
    </div>
@endsection