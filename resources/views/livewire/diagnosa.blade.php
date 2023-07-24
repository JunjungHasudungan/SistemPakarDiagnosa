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

                @if ($create_modal)
                    @include('livewire.diagnosa.create')
                @endif

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
                    Keterangan Solusi
                </th>
                <th scope="col" class="px-6 py-3">
                    Waktu Diagnosa
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($diagnosas as $diagnosa)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$loop->iteration}}
                        </th>
                        <td class="px-6 py-4">
                             {{ $diagnosa->kecanduan->deskripsi ?? '' }}
                        </td>

                        @php
                        // catch data solusi from relationship of kencanduan

                            $solusi = $diagnosa->kecanduan->solusiKecanduan;

                        @endphp

                        <td class="px-6 py-4">

                            @forelse ($solusi as $item)
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                    <li>
                                       {{ $item->keterangan}}
                                    </li>
                                </ul>
                            @empty
                                <p class="font-bold text-yellow-400">
                                    {{ __('Data Gejala Belum Tersedia..') }}
                                </p>
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                           {{ \Carbon\Carbon::parse($diagnosa->created_at)->translatedFormat('d F Y') }}
                           - {{ \Carbon\Carbon::parse($diagnosa->created_at)->format('H:i') }}
                        </td>
                    </tr>
                    @empty
                    <div class="bg-yellow-500 text-white p-3 rounded shadow-sm mb-3">
                        Hasil Diagnosa Belum ada..
                    </div>
            @endforelse
        </tbody>
    </table>
    {{-- end table --}}
</div>
