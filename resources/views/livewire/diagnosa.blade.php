<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        {{-- validation for natification --}}
        @if (session()->has('success'))
            <div class="bg-green-500 text-white p-3 rounded shadow-sm mb-3">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-yellow-500 text-white p-3 rounded shadow-sm mb-3">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class=" inline-flex col-span-7 p-3 w-full">
            <button wire:click.prevent="createDiagnosa()"
                class="bg-blue-500 hover:bg-blue-700 w-40
                text-white font-bold rounded-md my-3 inline-flex py-2 px-5">
                <svg class="w-5 h-6 -ml-1 inline-flex"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                    clip-rule="evenodd" />
                </svg>
            <span class="m-auto">
               Diagnosa
            </span>
            </button>
            {{-- button --}}
            {{-- end button --}}
                @if ($create_modal)
                    @include('livewire.diagnosa.create')
                @endif

                {{-- @if ($edit_modal)
                    @include('livewire.gejala.edit')
                @endif

                @if (!$cari_gejala)
                    @include('livewire.gejala.cari-gejala')
                @endif

                @if ($edit_modal)
                    @include('livewire.gejala.edit')
                @endif --}}
        </div>
    </div>

    {{-- table --}}
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Keterangan Kecanduan
                </th>
                <th scope="col" class="px-6 py-3">
                    Keterangan Gejala
                </th>
                <th scope="col" class="px-6 py-3">
                    Keterangan Solusi
                </th>
                <th scope="col" class="px-6 py-3">
                    Waktu Diagnosa
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($diagnosa as $item)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$loop->iteration}}
                        </th>
                        <td class="px-6 py-4">
                                {{ $item->level->keterangan ?? ''}} | {{ $item->deskripsi ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            @forelse ($item->gejalaKecanduan as $gejala)
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                    <li>
                                       {{ $gejala->keterangan ?? '' }}
                                    </li>
                                </ul>
                            @empty
                                <p class="font-bold text-yellow-400">
                                    {{ __('Data Gejala Belum Tersedia..') }}
                                </p>
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                            @forelse ($item->solusiKecanduan as $solusi)
                                <span class="font-semibold text-green-300">
                                    {{$solusi->keterangan ?? ''}}
                                </span>
                            @empty
                                <p class="font-semibold text-yellow-300">
                                    {{ __('Data Solusi Belum Tersedia..') }}
                                </p>
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                           {{ \Carbon\Carbon::parse($created_at)->translatedFormat('d F Y') }}
                           - {{ \Carbon\Carbon::parse($created_at)->format('H:i') }}
                        </td>
                    </tr>
                    @empty
                    <div class="bg-yellow-500 text-white p-3 rounded shadow-sm mb-3">
                        Data Gejala Belum Tersedia.
                    </div>
            @endforelse
        </tbody>
    </table>
    {{-- end table --}}
</div>
