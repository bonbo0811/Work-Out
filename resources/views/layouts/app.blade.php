<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="sticky-top">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navappmenu" aria-controls="navappmenu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand fw-bolder" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navappmenu">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown list-unstyled">
                            <a class="nav-link dropdown-toggle text-decoration-none" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                PROJECTS
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <!-- TODO: href=" # "にそれぞれルーティングを指定 -->
                                <li><a class="dropdown-item small" href="{{ route('home') }}">全てのプロジェクト</a></li>
                                <li><a class="dropdown-item small" href="{{ route('PreparationProject') }}">準備中プロジェクト</a></li>
                                <li><a class="dropdown-item small" href="{{ route('ExecutionProject') }}">実行中プロジェクト</a></li>
                                <li><a class="dropdown-item small" href="{{ route('CompletionProject') }}">完了済プロジェクト</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown list-unstyled">
                            <a class="nav-link dropdown-toggle text-decoration-none" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                MEMBERS
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <!-- TODO: href=" # "にそれぞれルーティングを指定 -->
                                <li><a class="dropdown-item small" href="{{ route('MemberList') }}">メンバー一覧</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </header>

        <main class="main">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
        @endif

        <div class="row" style='height: 92vh;'>
            <div class="col-md-3 p-0">
                <div class="card h-100">
                    <div class="card-header fw-bolder d-flex">Projects<a class='ml-auto'><i class="fas fa-plus-circle"></i></a></div>
                    @if($project_box == 'on')
                        <div class="mt-3 mb-2 text-end">
                            <button class="btn-sm btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#RegistProject-modal">新規登録</button>
                            @include('modal.new-project-modal',['id'=>'RegistProject-modal','name'=>'プロジェクト'])
                        </div> <!-- mt-1 mb-3 text-end -->
                    @elseif($project_box == 'off')
                        <div class="mt-5 p-1"></div>
                    @endif
                        <div class="card-body px-4 py-2 mb-5">
                            @foreach($projects AS $project)
                            <div class="list-group">
                                <a href="" class="list-group-item list-group-item-primary list-group-item-action" data-bs-toggle="modal" data-bs-target="#project{{ $project->id }}">{{ $project->name }}</a>
                                @include('modal.project-detail-modal')
                            </div>
                            @endforeach
                            <div class="mt-4">
                                {{ $projects->links() }}
                            </div>
                        </div>
                        
                </div>
            </div>

                @yield('content')
            </div>
        </div> <!-- row justify-content-center -->
        </main>
    </div>
    @yield('footer')
</body>
</html>
