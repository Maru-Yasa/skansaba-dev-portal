<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Skansaba Dev</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex flex-col justify-center items-center">
                <div class="w-full mt-5 px-5 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($projects as $project)
                    <div class="card card-compact bg-base-100 shadow-xl">
                        <figure><img src="/images/project/{{ $project->images[0]->path }}" alt="Shoes" /></figure>
                        <div class="card-body">
                          <div class="">
                            <h2 class="text-2xl font-bold mb-0">{{ $project->title }}</h2>
                            <h2 class="text-slate-700 text-xl font-semibold">{{ $project->author }}</h2>
                          </div>
                          <p>{{ $project->description }}</p>
                          <div class="card-actions justify-between mt-3 items-center">
                            <button onclick="visit('{{ $project->id }}', '{{ $project->link }}')" href="{{ $project->link }}" class="btn btn-sm btn-primary">Kunjungi</button>
                            <span class="badge-info badge gap-2"><i class="bi bi-eye-fill"></i> {{ $project->visitor }}</span>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </main>
        </div>

        <script>
            var IP;
            function getIP(json) {
                IP = json.ip
            }

            async function visit(project_id, href) {
                const rawResponse = await fetch(`{{ route('visitor.store') }}`, {
                  method: 'POST',
                  headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    ip:IP,
                    project_id: project_id
                  })
                });
                setTimeout(() => {
                    window.location = href
                }, 2000);
            }
        </script>
        <script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>
    </body>
</html>
