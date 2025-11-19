<!--
    شريط جانبي احترافي قابل للطي لـ KOK GYM.
    - يستخدم Tailwind CSS و Alpine.js لحركة سلسة (transition-all duration-300).
    - يستمع لحدث @sidebar-toggle.window للتحكم في حالته.
-->
<aside 
    x-data="{ isSidebarOpen: true }"
    @sidebar-toggle.window="isSidebarOpen = !isSidebarOpen"
    :class="isSidebarOpen ? 'w-64' : 'w-20'" 
    class="sidebar-scroll bg-gray-950/95 backdrop-blur-sm min-h-screen shadow-2xl shadow-cyan-900/50
           text-gray-200 p-4 relative transition-all duration-300 ease-in-out flex flex-col justify-between fixed top-0 right-0 z-50">
    
    <!-- ستايل مخصص (CSS) لتحسين شريط التمرير والأداء -->
    <style>
        .sidebar-scroll {
            max-height: 100vh;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }
    </style>

    <div>
        <!-- زر الفتح والإغلاق (Toggle Button) -->
        <button 
            @click="$dispatch('sidebar-toggle')"
            :class="isSidebarOpen ? 'rotate-0' : 'rotate-180'"
            class="absolute top-4 -right-3 p-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-full 
                   shadow-xl transition-all duration-300 transform ring-4 ring-gray-950 z-20 focus:outline-none focus:ring-cyan-500">
            <!-- أيقونة سهم -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- قسم ملف المستخدم (User Profile) -->
        <div class="border-b border-gray-800 pb-4 mb-4" x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
            <div class="flex items-center space-x-4">
                <img class="w-12 h-12 rounded-full border-2 border-cyan-500 shadow-md" 
                     src="https://placehold.co/100x100/1e293b/FFFFFF?text=AH" 
                     alt="ملف المستخدم" 
                     onerror="this.onerror=null;this.src='https://placehold.co/100x100/1e293b/FFFFFF?text=AH';">
                
                <div class="flex flex-col">
                    <span class="font-bold text-lg text-white">أحمد بك</span>
                    <span class="text-sm text-cyan-400">Gym Manager</span>
                </div>
            </div>
        </div>
        
        <!-- الشعار المصغر/الشعار الكامل (عندما يكون الشريط مغلقاً) -->
        <div class="flex items-center justify-center h-16 pt-2 pb-4" x-show="!isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
            <span class="text-4xl font-extrabold text-cyan-400">K</span>
        </div>

        <!-- قائمة التنقل (Navigation Links) -->
        <nav class="space-y-2 mt-4">
            
            <template x-for="item in [
                { name: 'الرئيسية', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', current: true },
                { name: 'إدارة الأعضاء', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', current: false },
                { name: 'الخطط التدريبية', icon: 'M9 19V6l2-2 2 2v13M9 19h6M12 4v16', current: false },
                { name: 'تقارير الأداء', icon: 'M7 12h10m-2 4h4m-10-8h4m2 0h4m-2 8h4m-6-4h4m-2-4h4', current: false },
                { name: 'المدفوعات', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM4 14s.5-2 3-2 3 2 3 2m6 0s.5-2 3-2 3 2 3 2', current: false },
            ]">
                <!-- الرابط -->
                <a href="#" :class="item.current ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group relative overflow-hidden transform hover:scale-[1.02]">
                    
                    <!-- الأيقونة -->
                    <svg class="w-6 h-6 z-10" :class="item.current ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon"></path>
                    </svg>

                    <!-- اسم الرابط (يظهر فقط عند الفتح) -->
                    <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms
                          class="mr-4 font-semibold text-lg whitespace-nowrap z-10"
                          :class="item.current ? 'text-white' : 'text-gray-200 group-hover:text-cyan-400'">
                        <span x-text="item.name"></span>
                    </span>
                    
                    <!-- تلميح الأدوات (Tooltip - يظهر عند الإغلاق) -->
                    <div x-show="!isSidebarOpen" x-cloak
                         class="absolute left-full top-1/2 -translate-y-1/2 mr-4 px-3 py-1 bg-gray-700 text-white text-sm rounded-lg 
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-30">
                        <span x-text="item.name"></span>
                    </div>
                </a>
            </template>
        </nav>
    </div>

    <!-- الإعدادات وتسجيل الخروج (في الأسفل) -->
    <nav class="space-y-2 pb-4 pt-8 border-t border-gray-800">
        <a href="#" class="flex items-center p-3 rounded-xl transition-all duration-200 group relative overflow-hidden 
                           text-gray-400 hover:bg-gray-800 hover:text-red-500 transform hover:scale-[1.02]">
            
            <div class="absolute inset-0 transform translate-x-full transition-transform duration-500 group-hover:translate-x-0 bg-red-600/20"></div>

            <svg class="w-6 h-6 z-10 text-gray-500 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>

            <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms
                  class="mr-4 font-semibold text-lg whitespace-nowrap z-10 text-gray-200 group-hover:text-red-500">
                تسجيل الخروج
            </span>
            <div x-show="!isSidebarOpen" x-cloak
                 class="absolute left-full top-1/2 -translate-y-1/2 mr-4 px-3 py-1 bg-gray-700 text-white text-sm rounded-lg 
                        opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-30">
                تسجيل الخروج
            </div>
        </a>
    </nav>
</aside>