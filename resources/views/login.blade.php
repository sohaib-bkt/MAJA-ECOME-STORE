<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <!-- Custom StyleSheet -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <title>Connexion - MAJĀA</title>
    <style>
      @keyframes border-grow {
        from { width: 0; }
        to { width: 25%; }
      }
      
      @keyframes input-appear {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @keyframes error-shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(8px); }
        75% { transform: translateX(-8px); }
      }
      .animate-border-grow {
        animation: border-grow 0.8s ease-out forwards;
      }

      .animate-input-appear {
        animation: input-appear 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
      }

      .animate-error-shake {
        animation: error-shake 0.4s ease-in-out;
      }

      @keyframes border-grow {
        from { width: 0; opacity: 0; }
        to { width: 25%; opacity: 1; }
      }

      @keyframes input-appear {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @keyframes error-shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(8px); }
        75% { transform: translateX(-8px); }
      }

      .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
      }

      @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
      }
    </style>
  </head>
  <body class="bg-gray-50">
    <!-- En-tête -->
    <x-nav></x-nav>

    <!-- Connexion -->
    <div class="container">
      <div class="login-form animate-fade-in-up">
        <form action="{{ route('loginAction') }}" method="POST" class="space-y-6">
          @csrf
          <h1 class="border-b-4 border-[#C9B194] w-1/4 mb-6 animate-border-grow [animation-delay:0.3s]">Connexion</h1>
          <p class="opacity-0 animate-fade-in [animation-delay:0.5s]">
            Vous avez déjà un compte? Connectez-vous ou
            <a href="{{ route('signup') }}" class="text-[#C9B194] hover:text-[#B89E80] transition-colors font-bold">
              Inscrivez-vous
            </a>
          </p>
      
          <div class="mb-4 opacity-0 animate-input-appear [animation-delay:0.7s]">
              <label for="email" class="block text-gray-700 mb-2">Email</label>
              <input type="text" placeholder="Entrez votre email" name="email" 
                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#C9B194] focus:ring-2 focus:ring-[#C9B194]/50 transition-all duration-300"
                     value="{{ old('email') }}" required />
              @error('email')
                <p class="text-red-500 text-lg mt-2 animate-error-shake">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="mb-4 opacity-0 animate-input-appear [animation-delay:0.9s]">
              <label for="password" class="block text-gray-700 mb-2">Mot de passe</label>
              <input type="password" placeholder="Entrez votre mot de passe" name="password" 
                     class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#C9B194] focus:ring-2 focus:ring-[#C9B194]/50 transition-all duration-300"
                     required />
              @error('password')
                  <p class="text-red-500 text-lg mt-2 animate-error-shake">{{ $message }}</p>
              @enderror
          </div>
      
          <div class="buttons opacity-0 animate-fade-in [animation-delay:1.1s]">
              <button type="submit" 
                      class="signupbtn bg-[#C9B194] hover:bg-[#B89E80] text-white px-8 py-3 rounded-full 
                             transition-all duration-300 hover:scale-105 hover:shadow-lg 
                             focus:outline-none focus:ring-2 focus:ring-[#C9B194] focus:ring-offset-2">
                Se connecter
              </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Pied de page -->
    <x-footer></x-footer>

    <!-- Script personnalisé -->
    <script src="{{asset('js/index.js')}}"></script>
  </body>
</html>