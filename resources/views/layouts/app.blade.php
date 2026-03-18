<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  <title>@yield('title', 'VeneKa Beauty')</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('order.home') }}">VeneKa Beauty</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
        </div>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <main class="container my-4 flex-grow-1">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <div class="container">
      <small>
        © {{ date('Y') }} VeneKa Beauty |
      </small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

</body>
</html>
