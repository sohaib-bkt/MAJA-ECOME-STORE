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
    <title>Sign Up</title>
  </head>
  <body>
    <!-- Navigation -->
    <x-nav></x-nav>
    <!-- Login -->
    <div class="container">
      <div class="login-form">
        <form action="{{ route('signupAction') }}" method="POST">
          @csrf
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account. or <a href="{{ route('login') }}">Login</a></p>
      
          <div class="mb-4">
              <label for="email" class="block text-gray-700">Email</label>
              <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              
              @error('email')
                <p class="text-red-500 text-lg" style="margin-bottom: 0px">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="w-full md:flex md:justify-between mb-4">
              <div class="w-full md:w-1/3 mb-4 md:mb-0">
                  <label for="name" class="block text-gray-700">Name</label>
                  <input type="text" placeholder="Enter Your Name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                  @error('name')
                    <p class="text-red-500 text-lg" style="margin-bottom: 0px">{{ $message }}</p>
                  @enderror
              </div>
              
              <div class="w-full md:w-1/3">
                  <label for="age" class="block text-gray-700">Age</label>
                  <input type="number" placeholder="Enter Your Age" name="age" value="{{ old('age') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                  @error('age')
                      <p class="text-red-500 text-lg" style="margin-bottom: 0px">{{ $message }}</p>
                  @enderror
              </div>
          </div>
      
          <div class="mb-4">
              <label for="password" class="block text-gray-700">Password</label>
              <input type="password" placeholder="Enter Password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              @error('password')
                  <p class="text-red-500 text-lg" style="margin-bottom: 0px">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="mb-4">
              <label for="password_confirmation" class="block text-gray-700">Repeat Password</label>
              <input type="password" placeholder="Repeat Password" name="password_confirmation" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              @error('password_confirmation')
                  <p class="text-red-500 text-lg" style="margin-bottom: 0px">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="buttons">
              <button type="submit" class="signupbtn bg-blue-500 text-white p-2 rounded">Sign Up</button>
          </div>
      </form>
      </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Custom Script -->
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>