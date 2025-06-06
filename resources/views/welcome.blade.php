<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Pengelola Kehadiran SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: {
              600: '#00FF62FF',
              700: '#3CFF00FF',
              800: '#023609FF',
              900: '#62CA00FF',
            },
            secondary: {
              400: '#fbbf24',
              500: '#f59e0b',
            },
            accent: {
              500: '#10b981',
            }
          },
          boxShadow: {
            'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
            'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            'button': '0 2px 5px rgba(0, 0, 0, 0.1)',
          },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-up': 'slideUp 0.3s ease-out',
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite'
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            slideUp: {
              '0%': { transform: 'translateY(20px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' }
            }
          }
        }
      }
    }
  </script>
  <script src="https://unpkg.com/feather-icons"></script>
  <title>Hadirin - Sistem Kehadiran SMKN 1 Kota Bengkulu</title>
  <style>
    @media (max-width: 640px) {
      .header-height {
        height: auto;
        min-height: 18rem;
      }
      
      .card-square {
        aspect-ratio: 1/1;
      }
      
      .card-rectangle {
        aspect-ratio: 2/1;
      }
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #a1a1a1;
    }
    
    /* Smooth transitions */
    a, button {
      transition: all 0.2s ease;
    }
    
    /* Card hover effect */
    .card-hover-effect:hover {
      transform: translateY(-3px);
    }
    
    /* Active tab indicator */
    .active-tab-indicator {
      position: relative;
    }
    
    .active-tab-indicator::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 20px;
      height: 3px;
      background-color: #fbbf24;
      border-radius: 3px;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen antialiased">

  <!-- Header -->
  <header class="w-full header-height rounded-b-3xl bg-gradient-to-br from-primary-800 to-primary-900 px-6 py-8 md:px-8 md:py-10 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
      <div class="absolute top-10 left-20 w-32 h-32 rounded-full bg-white animate-pulse-slow"></div>
      <div class="absolute bottom-10 right-20 w-24 h-24 rounded-full bg-secondary-400 animate-pulse-slow animation-delay-1000"></div>
      <div class="absolute top-1/3 right-1/4 w-16 h-16 rounded-full bg-white animate-pulse-slow animation-delay-1500"></div>
    </div>
    
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-start">
        <div class="flex items-center">
          <div class="text-white font-bold text-xl flex items-center">
            <span class="bg-white/10 backdrop-blur-sm px-3 py-1 rounded-lg flex items-center">
              <i data-feather="clock" class="mr-2 w-5 h-5 text-secondary-400"></i>
              HADIRIN
            </span>
          </div>
        </div>
        <div class="flex space-x-2">
          <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
          <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
          <div class="w-3 h-3 bg-red-400 rounded-full"></div>
        </div>
      </div>

      <div class="text-white text-center mt-8 md:mt-10">
        <div class="mx-auto w-24 h-24 md:w-28 md:h-28 bg-white/10 backdrop-blur-sm rounded-full p-4 shadow-lg flex items-center justify-center">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Kota Bengkulu" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-3xl md:text-4xl font-bold tracking-tight mt-4">SMKN 1 Kota Bengkulu</h1>
        <p class="text-lg md:text-xl text-blue-100 mt-1">Sistem Pengelola Kehadiran Digital</p>
        
        <!-- Current date display -->
        <div class="mt-3 inline-block bg-white/10 backdrop-blur-sm px-4 py-1 rounded-full text-sm">
          <span id="current-date" class="font-medium"></span>
        </div>
      </div>

      <nav class="flex justify-center mt-8 md:mt-10 space-x-2 md:space-x-4 lg:space-x-6">
        <button id="b1" onclick="switchTab(1)" class="text-white font-medium md:font-semibold text-sm md:text-base px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 flex items-center relative group">
          <i data-feather="tool" class="mr-2 w-4 h-4 md:w-5 md:h-5"></i> 
          <span>Tools</span>
          <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
        </button>
        <button id="b2" onclick="switchTab(2)" class="text-white font-medium md:font-semibold text-sm md:text-base px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 flex items-center relative group">
          <i data-feather="printer" class="mr-2 w-4 h-4 md:w-5 md:h-5"></i> 
          <span>Prints</span>
          <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
        </button>
        <button id="b3" onclick="switchTab(3)" class="text-white font-medium md:font-semibold text-sm md:text-base px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 flex items-center relative group">
          <i data-feather="info" class="mr-2 w-4 h-4 md:w-5 md:h-5"></i> 
          <span>Info</span>
          <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
        </button>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="px-4 py-6 md:px-8 md:py-10 max-w-6xl mx-auto transition-all duration-300">

    <!-- Tools Tab -->
    <div id="tab1" class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 md:gap-6 transition-opacity duration-300">
      <!-- Card 1 -->
      <a href="/users" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
        <div class="h-full p-5 md:p-6 flex flex-col items-center justify-center text-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-4 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
            <img src="https://img.icons8.com/ios-filled/50/1e40af/add-user-group-man-man.png" class="w-7 h-7 md:w-8 md:h-8" alt="Input Anggota" />
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Input Anggota</h3>
          <p class="text-xs text-gray-500">Tambah atau edit data anggota</p>
          <div class="mt-3 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
            Akses sekarang <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
          </div>
        </div>
      </a>
      
      <!-- Card 2 -->
      <a href="/events" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
        <div class="h-full p-5 md:p-6 flex flex-col items-center justify-center text-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-4 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
            <img src="https://img.icons8.com/ios-filled/50/1e40af/edit-calendar.png" class="w-7 h-7 md:w-8 md:h-8" alt="Input Kegiatan" />
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Input Kegiatan</h3>
          <p class="text-xs text-gray-500">Kelola jadwal kegiatan</p>
          <div class="mt-3 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
            Akses sekarang <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
          </div>
        </div>
      </a>
      
      <!-- Card 3 -->
      <a href="{{ route('generate.id.show') }}" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
        <div class="h-full p-5 md:p-6 flex flex-col items-center justify-center text-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-4 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiMxZTQwYWYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS1pZC1jYXJkLWljb24gbHVjaWRlLWlkLWNhcmQiPjxwYXRoIGQ9Ik0xNiAxMGgyIi8+PHBhdGggZD0iTTE2IDE0aDIiLz48cGF0aCBkPSJNNi4xNyAxNWEzIDMgMCAwIDEgNS42NiAwIi8+PGNpcmNsZSBjeD0iOSIgY3k9IjExIiByPSIyIi8+PHJlY3QgeD0iMiIgeT0iNSIgd2lkdGg9IjIwIiBoZWlnaHQ9IjE0IiByeD0iMiIvPjwvc3ZnPg==" class="w-7 h-7 md:w-8 md:h-8" alt="Generate ID" />
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Generate ID</h3>
          <p class="text-xs text-gray-500">Buat kartu identitas</p>
          <div class="mt-3 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
            Akses sekarang <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
          </div>
        </div>
      </a>
      
      <!-- Card 4 -->
      <a href="{{ route('scan.show') }}" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
        <div class="h-full p-5 md:p-6 flex flex-col items-center justify-center text-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-4 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
            <i data-feather="maximize" class="w-7 h-7 md:w-8 md:h-8 text-primary-700"></i>
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Scan Kehadiran</h3>
          <p class="text-xs text-gray-500">Scan QR code presensi</p>
          <div class="mt-3 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
            Akses sekarang <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
          </div>
        </div>
      </a>
    </div>

    <!-- Prints Tab -->
   <!-- Prints Tab -->
<div id="tab2" class="hidden grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 md:gap-6 transition-opacity duration-300">
  <!-- Rectangle Card (Full width on mobile) -->
  <a href="{{ route('print.harian') }}" class="md:col-span-2 bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
    <div class="p-3 md:p-6 flex flex-col md:flex-row items-center">
      <div class="w-10 h-10 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-green-50 to-green-100 mb-2 md:mb-0 md:mr-6 flex items-center justify-center group-hover:from-green-100 group-hover:to-green-200 transition-colors duration-200">
        <i data-feather="calendar" class="w-6 h-6 md:w-8 md:h-8 text-accent-500"></i>
      </div>
      <div class="text-center md:text-left flex-1">
        <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Print Kehadiran Harian</h3>
        <p class="text-xs text-gray-500">Laporan kehadiran harian lengkap dengan statistik</p>
      </div>
      <div class="mt-2 md:mt-0 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
        Cetak laporan <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
      </div>
    </div>
  </a>
  
  <!-- Square Card 1 -->
  <a href="{{ route('print.bulanan') }}" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
    <div class="p-3 md:p-6 flex flex-col items-center justify-center text-center">
      <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-2 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
        <i data-feather="file-text" class="w-6 h-6 md:w-8 md:h-8 text-primary-700"></i>
      </div>
      <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Laporan Bulanan</h3>
      <p class="text-xs text-gray-500">Rekapitulasi kehadiran bulanan</p>
      <div class="mt-2 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
        Cetak laporan <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
      </div>
    </div>
  </a>
  
  <!-- Square Card 2 -->
  <a href="{{ route('print.card.id') }}" class="card-square bg-white rounded-xl shadow-card hover:shadow-card-hover transition-all duration-200 group overflow-hidden border border-gray-100 animate-fade-in animate-slide-up card-hover-effect">
    <div class="p-3 md:p-6 flex flex-col items-center justify-center text-center">
      <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 mb-2 flex items-center justify-center group-hover:from-blue-100 group-hover:to-blue-200 transition-colors duration-200">
        <img src="https://img.icons8.com/ios-filled/50/1e40af/print.png" class="w-6 h-6 md:w-8 md:h-8" alt="Print ID" />
      </div>
      <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Print Semua ID</h3>
      <p class="text-xs text-gray-500">Cetak semua kartu identitas</p>
      <div class="mt-2 text-xs text-primary-700 font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
        Cetak sekarang <i data-feather="chevron-right" class="w-3 h-3 ml-1"></i>
      </div>
    </div>
  </a>
</div>

    <!-- Info Tab -->
    <div id="tab3" class="hidden transition-opacity duration-300 animate-fade-in">
      <div class="bg-white rounded-xl shadow-card p-6 md:p-8">
        <div class="flex items-center mb-4 md:mb-6">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center mr-3">
            <i data-feather="info" class="w-5 h-5 text-white"></i>
          </div>
          <h2 class="text-xl md:text-2xl font-bold text-gray-800">Tentang Hadirin</h2>
        </div>
        
        <div class="space-y-4 md:space-y-5">
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-3 h-3 rounded-full bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center">
                <div class="w-1 h-1 bg-white rounded-full"></div>
              </div>
            </div>
            <div class="ml-3">
              <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Sistem Pengelola Kehadiran</h3>
              <p class="text-gray-700 text-sm md:text-base">
                Hadirin merupakan solusi digital untuk pengelolaan kehadiran di lingkungan sekolah dengan fitur lengkap dan antarmuka yang intuitif.
              </p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-3 h-3 rounded-full bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center">
                <div class="w-1 h-1 bg-white rounded-full"></div>
              </div>
            </div>
            <div class="ml-3">
              <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Fitur Unggulan</h3>
              <p class="text-gray-700 text-sm md:text-base">
                Dengan desain responsif dan performa optimal, Hadirin mampu mengakomodasi kebutuhan pencatatan kehadiran dalam berbagai situasi.
              </p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-3 h-3 rounded-full bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center">
                <div class="w-1 h-1 bg-white rounded-full"></div>
              </div>
            </div>
            <div class="ml-3">
              <h3 class="text-sm md:text-base font-semibold text-gray-800 mb-1">Pengembangan</h3>
              <p class="text-gray-700 text-sm md:text-base">
                Dikembangkan oleh Guru Produktif Jurusan PPLG SMKN 1 Kota Bengkulu sebagai produk inovasi untuk mendukung digitalisasi sekolah.
              </p>
            </div>
          </div>
          
          <div class="pt-4 mt-4 border-t border-gray-100">
            <div class="flex flex-wrap items-center justify-between">
              <div class="flex items-center mb-2 md:mb-0">
                <i data-feather="code" class="w-4 h-4 text-gray-500 mr-2"></i>
                <span class="text-xs text-gray-500">Versi 2.1.0</span>
              </div>
              <div class="flex items-center">
                <i data-feather="calendar" class="w-4 h-4 text-gray-500 mr-2"></i>
                <span class="text-xs text-gray-500">Terakhir diperbarui: Juni 2023</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script>
    function switchTab(id) {
      // Hide all tabs
      for (let i = 1; i <= 3; i++) {
        document.getElementById('tab' + i).classList.add('hidden');
        document.getElementById('b' + i).classList.remove('bg-white/20', 'active-tab-indicator');
      }
      
      // Show selected tab
      document.getElementById('tab' + id).classList.remove('hidden');
      document.getElementById('b' + id).classList.add('bg-white/20', 'active-tab-indicator');
      
      // Store selected tab in sessionStorage
      sessionStorage.setItem('selectedTab', id);
    }

    // Initialize feather icons
    feather.replace();
    
    // Set current date
    function updateCurrentDate() {
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const now = new Date();
      document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
    }
    
    // Set initial tab from sessionStorage or default to 1
    document.addEventListener('DOMContentLoaded', () => {
      updateCurrentDate();
      const selectedTab = sessionStorage.getItem('selectedTab') || 1;
      switchTab(selectedTab);
      
      // Add animation delay to cards
      const cards = document.querySelectorAll('[id^="tab"] a, [id^="tab"] div');
      cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 50}ms`;
      });
    });
  </script>
</body>
</html>