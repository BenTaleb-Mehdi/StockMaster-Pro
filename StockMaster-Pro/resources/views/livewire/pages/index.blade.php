<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster - Pro Resource Management</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header { 
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        }
        /* Smooth transition for all hover states */
        * { transition: all 0.2s ease-in-out; }
    </style>
</head>

<body class="bg-gray-50 text-slate-800 antialiased">

    <header class="sticky top-0 inset-x-0 z-50 w-full glass-header">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between py-4">
            <div class="flex items-center justify-between">
                <a class="flex-none text-2xl font-bold flex items-center gap-3" href="/">
                    <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-200 group">
                        <i data-lucide="package" class="w-6 h-6 text-white group-hover:rotate-12"></i>
                    </div>
                    <span class="text-slate-900 font-extrabold tracking-tight">StockMaster</span>
                </a>
                <div class="sm:hidden">
                    <button type="button" class="p-2 inline-flex items-center bg-white border border-gray-200 rounded-lg shadow-sm">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="hidden sm:block overflow-hidden basis-full grow transition-all duration-300">
                <div class="flex flex-col gap-8 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    <a class="text-sm font-bold text-slate-600 hover:text-blue-600" href="#features">Features</a>
                    <a class="text-sm font-bold text-slate-600 hover:text-blue-600" href="#categories">Categories</a>
                    <a class="text-sm font-bold text-slate-600 hover:text-blue-600" href="#inventory">Inventory</a>
                    <a href="/login" class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-slate-900 text-white hover:bg-blue-600 shadow-md transform hover:-translate-y-0.5">
                        <i data-lucide="user-circle" class="w-4 h-4"></i>
                        Member Area
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main id="content">
        <!-- Hero Section -->
        <section class="relative bg-white pt-24 pb-32 border-b border-gray-100 overflow-hidden">
            <div class="absolute top-0 start-1/2 -translate-x-1/2 -z-10 w-full h-full opacity-40">
                <div class="absolute top-[-10%] start-[10%] w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-[-10%] end-[5%] w-[400px] h-[400px] bg-indigo-50 rounded-full blur-[100px]"></div>
            </div>

            <div class="max-w-[85rem] mx-auto px-4 text-center">
                <div class="inline-flex items-center gap-x-2 bg-blue-50/80 border border-blue-100 text-xs font-bold text-blue-700 p-1.5 ps-4 rounded-full mb-10">
                    LATEST NEWS
                    <span class="py-1 px-3 rounded-full bg-blue-600 text-white flex items-center gap-1 hover:bg-blue-700 cursor-pointer">
                        2024 Inventory Update <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    </span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight mb-8">
                    Smart Internal <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Resource Planning</span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed mb-12">
                    Eliminate inventory chaos. A centralized platform to track, reserve, and manage your team's shared equipment in real-time.
                </p>

                <div class="max-w-2xl mx-auto">
                    <div class="p-2 bg-white border border-gray-200 rounded-2xl shadow-2xl shadow-blue-100/50 flex flex-col sm:flex-row items-center gap-2">
                        <div class="relative w-full">
                            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input type="text" class="w-full py-4 ps-12 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 text-slate-900 placeholder-slate-400" placeholder="Find MacBook, Cameras, tools...">
                        </div>
                        <button class="w-full sm:w-auto py-4 px-10 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-12 bg-slate-900">
            <div class="max-w-[85rem] mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <p class="text-4xl font-black text-white mb-1 group-hover:text-blue-400">1,200+</p>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Items</p>
                    </div>
                    <div class="text-center group border-l border-slate-800">
                        <p class="text-4xl font-black text-white mb-1 group-hover:text-blue-400">45</p>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Categories</p>
                    </div>
                    <div class="text-center group border-l border-slate-800">
                        <p class="text-4xl font-black text-white mb-1 group-hover:text-blue-400">15</p>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Locations</p>
                    </div>
                    <div class="text-center group border-l border-slate-800">
                        <p class="text-4xl font-black text-white mb-1 group-hover:text-blue-400">99.9%</p>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Accuracy</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-white">
            <div class="max-w-[85rem] mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl font-black text-slate-900 mb-4">Everything you need to stay organized</h2>
                    <p class="text-slate-500 text-lg leading-relaxed">Powerful features designed to simplify the way your team manages shared resources.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-blue-600 group-hover:text-white transform group-hover:-translate-y-1 transition-all">
                            <i data-lucide="zap" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Live Tracking</h3>
                        <p class="text-slate-500 text-center text-sm leading-relaxed">Instant updates on item availability and location across all warehouses.</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-orange-600 group-hover:text-white transform group-hover:-translate-y-1 transition-all">
                            <i data-lucide="shield-check" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Secure Access</h3>
                        <p class="text-slate-500 text-center text-sm leading-relaxed">Advanced permission levels ensure only the right people access specific assets.</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-green-600 group-hover:text-white transform group-hover:-translate-y-1 transition-all">
                            <i data-lucide="bar-chart-3" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Smart Analytics</h3>
                        <p class="text-slate-500 text-center text-sm leading-relaxed">Deep insights into asset usage, depreciation, and stock replenishment needs.</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-purple-600 group-hover:text-white transform group-hover:-translate-y-1 transition-all">
                            <i data-lucide="calendar-heart" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Reservations</h3>
                        <p class="text-slate-500 text-center text-sm leading-relaxed">Hassle-free booking system for your team to reserve items in advance.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section id="categories" class="py-24 bg-gray-50 border-y border-gray-100">
            <div class="max-w-[85rem] mx-auto px-4">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 mb-2">Browse Categories</h2>
                        <p class="text-slate-500">Quickly find what you need by department.</p>
                    </div>
                    <a href="#" class="hidden md:flex items-center gap-2 font-bold text-blue-600 hover:underline">
                        Explore all <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white">
                            <i data-lucide="monitor" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Electronics</h3>
                        <p class="text-sm text-slate-500 mt-1">Laptops, Screens, Tablets</p>
                    </div>
                    <div class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white">
                            <i data-lucide="wrench" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Maintenance</h3>
                        <p class="text-sm text-slate-500 mt-1">Tools & Repair Kits</p>
                    </div>
                    <div class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white">
                            <i data-lucide="camera" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Photography</h3>
                        <p class="text-sm text-slate-500 mt-1">Cameras, Lenses, Lighting</p>
                    </div>
                    <div class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white">
                            <i data-lucide="truck" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Logistics</h3>
                        <p class="text-sm text-slate-500 mt-1">Shipping & Transport</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Inventory Highlight Section -->
        <section id="inventory" class="py-24 bg-white">
            <div class="max-w-[85rem] mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6">Popular Assets</h2>
                    <p class="text-lg text-slate-500">Most requested items available for checkout right now.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Product Card -->
                    <div class="group bg-slate-50 rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:bg-white transition-all duration-300">
                        <div class="h-64 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="laptop" class="w-24 h-24 text-slate-300 group-hover:scale-110 group-hover:text-blue-500 transition duration-500"></i>
                            <div class="absolute top-6 right-6">
                                <span class="py-2 px-4 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-100 text-green-700 shadow-sm border border-green-200 flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Available
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-black text-slate-900 group-hover:text-blue-600 transition-colors mb-2">MacBook Pro 16"</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8">M2 Max chip, 64GB RAM. Ideal for high-end rendering and software builds.</p>
                            <button class="w-full py-4 bg-slate-900 text-white font-black rounded-2xl group-hover:bg-blue-600 shadow-xl active:scale-95 transition-all">
                                Reserve Item
                            </button>
                        </div>
                    </div>
                    <!-- Product Card -->
                    <div class="group bg-slate-50 rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:bg-white transition-all duration-300">
                        <div class="h-64 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="video" class="w-24 h-24 text-slate-300 group-hover:scale-110 group-hover:text-orange-500 transition duration-500"></i>
                            <div class="absolute top-6 right-6">
                                <span class="py-2 px-4 rounded-full text-[10px] font-black uppercase tracking-wider bg-orange-100 text-orange-700 shadow-sm border border-orange-200">
                                    In Use
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-black text-slate-900 group-hover:text-orange-600 transition-colors mb-2">Sony FX3 Cinema</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8">Full-frame cinema camera with XLR handle. Compact beast for professional video.</p>
                            <button disabled class="w-full py-4 bg-gray-200 text-gray-400 font-black rounded-2xl cursor-not-allowed">
                                Waitlist
                            </button>
                        </div>
                    </div>
                    <!-- Product Card -->
                    <div class="group bg-slate-50 rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:bg-white transition-all duration-300">
                        <div class="h-64 bg-slate-100 flex items-center justify-center relative">
                            <i data-lucide="hard-drive" class="w-24 h-24 text-slate-300 group-hover:scale-110 group-hover:text-green-500 transition duration-500"></i>
                            <div class="absolute top-6 right-6">
                                <span class="py-2 px-4 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-100 text-green-700 shadow-sm border border-green-200 flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Available
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-black text-slate-900 group-hover:text-green-600 transition-colors mb-2">SSD Drive 4TB</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8">High-speed NVMe portable drive. Rugged casing for field work.</p>
                            <button class="w-full py-4 bg-slate-900 text-white font-black rounded-2xl group-hover:bg-green-600 shadow-xl active:scale-95 transition-all">
                                Reserve Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-blue-600 relative overflow-hidden">
            <div class="max-w-[85rem] mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-8">Ready to organize your team?</h2>
                    <p class="text-blue-100 text-lg mb-12">Join hundreds of teams managing their local resources with StockMaster Pro.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-6">
                        <a href="#" class="py-4 px-10 bg-white text-blue-600 font-black rounded-2xl shadow-2xl hover:scale-105 transition-all">
                            Get Started Now
                        </a>
                        <a href="#" class="py-4 px-10 bg-blue-700 text-white font-black rounded-2xl border border-blue-500 hover:bg-blue-800 transition-all">
                            Request Demo
                        </a>
                    </div>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-400 rounded-full opacity-20"></div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-24">
        <div class="max-w-[85rem] mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-20 border-b border-slate-800 pb-20">
                <div class="col-span-full lg:col-span-1">
                    <a class="flex items-center gap-3 mb-8" href="/">
                        <div class="bg-blue-600 p-2 rounded-xl">
                            <i data-lucide="package" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight">StockMaster</span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed">The internal OS for your team's hardware. Track everything, lose nothing.</p>
                </div>

                <div>
                    <h4 class="font-bold uppercase tracking-widest text-[10px] text-slate-500 mb-8">Navigation</h4>
                    <div class="flex flex-col gap-4 text-sm font-bold text-slate-400">
                        <a href="#" class="hover:text-white">Dashboard</a>
                        <a href="#" class="hover:text-white">All Assets</a>
                        <a href="#" class="hover:text-white">Categories</a>
                        <a href="#" class="hover:text-white">Help Center</a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold uppercase tracking-widest text-[10px] text-slate-500 mb-8">Organization</h4>
                    <div class="flex flex-col gap-4 text-sm font-bold text-slate-400">
                        <a href="#" class="hover:text-white">About Us</a>
                        <a href="#" class="hover:text-white">Guidelines</a>
                        <a href="#" class="hover:text-white">Internal Policy</a>
                        <a href="#" class="hover:text-white">Contact Info</a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold uppercase tracking-widest text-[10px] text-slate-500 mb-8">Company</h4>
                    <div class="flex flex-col gap-4 text-sm font-bold text-slate-400">
                        <a href="#" class="hover:text-white">Careers</a>
                        <a href="#" class="hover:text-white">Brand Assets</a>
                        <a href="#" class="hover:text-white">Newsletter</a>
                    </div>
                </div>

                <div class="col-span-full md:col-span-1">
                    <h4 class="font-bold uppercase tracking-widest text-[10px] text-slate-500 mb-8">Connect</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-blue-600 transition-all">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-gray-700 transition-all">
                            <i data-lucide="github" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-blue-800 transition-all">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-xs font-bold text-slate-500">
                <p>© 2024 StockMaster Pro. Engineered for efficiency.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Initialize Icons
        lucide.createIcons();
    </script>
</body>
</html>