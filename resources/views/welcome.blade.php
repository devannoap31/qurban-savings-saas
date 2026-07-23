<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabungan Kurban Multi-Tenant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center bg-white p-10 rounded-2xl shadow-lg border border-gray-100">
            <h1 class="text-4xl font-bold text-emerald-600 mb-4">🚀 Welcome to Core App</h1>
            <p class="text-gray-500 mb-8">Sistem Monolithic MVC untuk Web Tabungan Kurban Multi-Tenant</p>
            
            <div class="flex justify-center gap-4">
                <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-semibold text-sm">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </div>
                <div class="bg-purple-50 text-purple-700 px-4 py-2 rounded-lg font-semibold text-sm">
                    PHP v{{ PHP_VERSION }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
