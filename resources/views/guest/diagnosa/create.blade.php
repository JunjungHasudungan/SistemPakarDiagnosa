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
                    <div>
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                            <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  w-6/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <form action="{{ route('guest.diagnosa.store') }}" method="post">
                                    <div class="bg-white px-4 pt-5 pb-2 sm:p-6">
                                        <div class="border mb-2 border-sky-500 px-4 sm:p-2">

                                            <div class="w-full inline">
                                                {{-- title --}}
                                                <div class="bg-white mb-2">
                                                    <h2 class="text-gray-700 text-center font-semibold">Data Pertanyaan Diagnosa</h2>
                                                </div>
                                                {{-- end title --}}
                                                <table class=" border  border-sky-500 w-full text-sm rounded text-left text-gray-400">
                                                    <thead class="text-gray-700 text-left font-semibold">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 font-extrabold text-blue-900 text-lg text-left">
                                                                Pilih Gejala Yang dirasakan..
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($gejalas as $gejala)
                                                                <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-300">
                                                                    <td class="px-1 py-6 text-semibold text-gray-700">
                                                                        <label for="" class="block text-gray-700 text-sm font-bold mb-2">
                                                                            <input  id="default-checkbox"
                                                                                    type="checkbox"
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
                                            </div>
                                        </div>
                                    </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                        <button
                                                type="submit"
                                                value="Submit"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent
                                                px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm
                                                hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green
                                                transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Simpan
                                        </button>
                                    </span>

                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                        <button
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2
                                                bg-gray-600 text-base  text-white leading-6 font-medium text-whiteshadow-sm
                                                hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue
                                                transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                <a href="{{route('guest.diagnosa.index')}}">
                                                    Cancel
                                                </a>
                                        </button>
                                    </span>
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
</x-app-layout>
