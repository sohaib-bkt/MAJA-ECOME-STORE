<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <!-- Custom StyleSheet -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    
    <title>Login</title>
  </head>
  <body>
    <!-- Header -->
    <x-nav></x-nav>
    <!-- Login -->
    <div class="container">
      <div class="login-form">
        <form action="{{ route('loginAction') }}" method="POST">
          @csrf
          <h1>Login</h1>
          <p>
              Already have an account? Login or
              <a href="{{ route('signup') }}">Sign Up</a>
          </p>
      
          <div class="mb-4">
              <label for="email" class="block text-gray-700">Email</label>
              <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              @error('email')
                  <p class="text-red-500 text-lg">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="mb-4">
              <label for="password" class="block text-gray-700">Password</label>
              <input type="password" placeholder="Enter Password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              @error('password')
                  <p class="text-red-500 text-lg">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="buttons">
              <button type="submit" class="signupbtn bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Login</button>
          </div>
      </form>
      </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Custom Script -->
    <script src="{{asset('js/index.js')}}"></script>
  </body>
</html>