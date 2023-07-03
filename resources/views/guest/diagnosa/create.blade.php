<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                            <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  w-6/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                                <div class="bg-white px-4 pt-5 pb-2 sm:p-6">
                                    <div class="border mb-2 border-sky-500 px-4 sm:p-2">
                                        <div class="w-full inline">
                                            {{-- title --}}
                                            <div class="bg-white mb-2">
                                                <h2 class="text-gray-700 text-center font-semibold">Data Pertanyaan Diagnosa</h2>
                                            </div>
                                            {{-- end title --}}
                                            <table class=" border border-sky-500 w-full text-sm rounded text-left text-gray-400">
                                                <thead class="text-gray-700 text-left font-semibold">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 bg-gray-400  font-extrabold text-blue-900 text-lg text-left">
                                                            Pilih Gejala Yang dirasakan..
                                                            @if($errors->all())
                                                                @include('layouts.error')
                                                            @endif
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <form action="{{ route('guest.diagnosa.store') }}" method="post">
                                                        @csrf

                                                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                                                        @forelse ($gejalas as $gejala)
                                                                <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-300">
                                                                    <td class="px-1 py-6 text-semibold text-gray-700">
                                                                        <label for="" class="block text-gray-700 text-sm font-bold mb-2">
                                                                            <input  id="default-checkbox"
                                                                                    type="checkbox"
                                                                                    name="gejala[]"
                                                                                    value=" {{  $gejala->id }} "
                                                                                    class="w-4 h-4 mx-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                                                                {{ $gejala->keterangan ?? '' }}
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <p class="text-bold text-yellow-900">
                                                                    {{ __('Data gejala belum tersedia..') }}
                                                                </p>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <div class="w-full mt-2 justify-left item-left">
                                                    <button class="px-2 py-2 rounded-lg text-white border-gray-900 bg-green-900 hover:bg-green-500"
                                                            type="submit"
                                                            value="submit">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
