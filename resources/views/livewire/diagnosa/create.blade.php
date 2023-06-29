<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

          <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  w-6/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
            <div class="bg-white px-4 pt-5 pb-2 sm:p-6">
                        <div class="border mb-2 border-sky-500 px-4 sm:p-2">
                            <div class="w-full inline">
                                <div class="bg-white mb-2">
                                    <h2 class="text-gray-700 text-center font-semibold">Data Pertanyaan Diagnosa</h2>
                                </div>
                                <table class=" border  border-sky-500 w-full text-sm rounded text-left text-gray-400">
                                    <thead class="text-gray-700 text-left font-semibold">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-extrabold text-blue-900 text-lg text-left">
                                                Pilih Gejala Yang dirasakan..

                                                @if($errors->all())
                                                    @include('layouts.error')
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input
                                                type="hidden"
                                                name="user_id"
                                                wire:model="user_id"
                                                value="{{ $user_id }}"
                                                >
                                        @forelse ($diagnosa_gejala as $index => $item)
                                            @forelse ($gejalas as $gejala)
                                            <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-300">
                                                <td class="px-1 py-6 text-semibold text-gray-700">
                                                    <label
                                                            for=""
                                                            {{-- wire:model="diagnosa_gejala" --}}
                                                            name="diagnosa_gejala[{{ $index }}]['gejala_id']"
                                                            class="block text-gray-700 text-sm font-bold mb-2">
                                                        <input  id="default-checkbox"
                                                                type="checkbox"
                                                                {{-- name="gejala" --}}
                                                                wire:model="gejala"
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
                                        @empty
                                            <p class="text-yellow-500 font-bold">
                                                {{ __('Data Gejala Belum Tersedia..') }}
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
                        wire:click.prevent="storeDiagnosa()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent
                        px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm
                        hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green
                        transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Simpan
                </button>
              </span>
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                <button wire:click="closeCreateModal()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2
                        bg-gray-600 text-base  text-white leading-6 font-medium text-whiteshadow-sm
                        hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue
                        transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Cancel
                </button>
              </span>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
