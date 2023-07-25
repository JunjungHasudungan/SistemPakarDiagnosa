<div class="mb-2">
    <div class="border border-gray-800 px-2 py-2 rounded-lg">
        <div class="text-center text-xl border border-gray-600 bg-gray-200 rounded-lg">
            <h2 class="text-gray-600 font-extrabold">Data Pakar Diagnosa</h2>
        </div>

        <div class="mt-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                {{-- col #Kecanduan  --}}
                <a href="{{ route('admin.kecanduan.index') }}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>

                        <h2 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">Relasi Data Kecanduan ( {{count($this->all_kecanduan)}} )</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Data kecanduan merupakan data basis pengetahuan yang merelasikan antara data kecanduan, data gejala dan beberapa solusi yang disediakan..
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>
                {{-- end coloum Kecanduan --}}

                <a href="{{route('admin.gejala.index')}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>

                        <h2 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">Data Gejala ( {{ count( $this->all_gejala ) }} )</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                           Data Gejala merupakan keterangan gejala yang terjadi pada pecandu serta berelasi antara data gejala dan data kecanduan yang telah tersedia..
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>

                <a href="{{ route('admin.solusi.index') }}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                        </div>

                        <h2 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">Data Solusi ( {{ count( $this->all_solusi ) }} )</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                           Data Solusi Merupakan keterangan solusi terhadap keterangan Kecanduan yang dialami oleh pasien..
                        </p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<div>
    <div>
        <div class="border border-gray-800 px-2 py-2 rounded-lg">
            <div class="text-center text-xl border border-gray-600 rounded-lg bg-gray-100 mb-2">
                <h2 class="text-gray-600 font-extrabold">Data Hasil Diagnosa</h2>
            </div>

                <div class="relative overflow-x-auto">
                    <div class="divide-y mb-1 flow-root w-full px-2 py-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        @if ( count($this->all_diagnosa ) > 0)
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($users as $user)
                                    @if ( count($user->diagnosa) > 0 )
                                        <li class="px-2 py-2">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                                        {{ $user->name }} ( {{ count($user->diagnosa) }} )
                                                    </h2>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @empty
                                    <div class="px-2 py-2 border-b bg-gray-900 rounded-lg">
                                        <p class=" px-2 text-yellow-400 font-bold">
                                            {{ __('Hasil Diagnosa Belum ada..') }}
                                        </p>
                                    </div>
                                @endforelse
                            </ul>
                        @else
                            <div class="px-2 py-2 border-b bg-gray-900 rounded-lg">
                                <p class=" px-2 text-yellow-400 font-bold">
                                    {{ __('Hasil Diagnosa Belum ada..') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
    {{-- end hasil diagnosa --}}
</div>



{{-- password --}}
