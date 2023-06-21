<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

          <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  w-10/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-4 sm:p-6 sm:pb-2">

                @if ($create_modal_gejala)
                    {{-- <livewire:create-gejala /> --}}
                    @include('livewire.create-gejala')
                @endif

                <div class="bg-white px-4 pb-2 sm:p-6 sm:pb-2">
                    <div class="mb-2 w-full inline">
                        <table class="w-full text-sm rounded text-left text-gray-400">
                            <thead class="text-xs text-gray-700 camelcase bg-gray-50 text-gray-400">
                                <tr>
                                    <th scope="col" class=" text-sm font-bold text-gray-700">
                                        Keterangan Kecanduan
                                    </th>
                                    <th scope="col" class="px-2 px-3 text-sm font-bold text-gray-700">
                                        Keterangan Gejala
                                    </th>
                                    <th scope="col" class="px-2 px-3 text-sm font-bold text-gray-700">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach ($kecanduan_solusi as $index => $item) --}}
                                <tr class="w-full">
                                    <td class="px-1 py-6">
                                        <select
                                            wire:model="kecanduan_id"
                                            name="kecanduan_id"
                                            class="border border-gray-300 text-gray-900 text-sm
                                            rounded-lg focus:ring-blue-500 focus:border-blue-500
                                            block w-full p-2.5 bg-white dark:border-gray-600
                                            dark:placeholder-gray-400
                                            font-semibold dark:focus:ring-blue-500
                                            dark:focus:border-blue-500"
                                            id="">
                                                <option value=""> -- Pilih Keterangan Kecanduan -- </option>
                                                    @forelse ($kecanduans as $kecanduan)
                                                        <option
                                                            class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                            value="{{ $kecanduan->id }}">  {{ $kecanduan->kode_kecanduan }} | {{$kecanduan->deskripsi }}
                                                        </option>
                                                    @empty
                                                        <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Kecanduan Belum Tersedia..</option>
                                                    @endforelse
                                        </select>
                                                @error('kecanduan_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </td>
                                    <td class="px-1 py-6">
                                        <select
                                            name="gejala_id"
                                            wire:model="gejala_id"
                                            class="border border-gray-300 text-gray-900 text-sm
                                            rounded-lg focus:ring-blue-500 focus:border-blue-500
                                            block w-full p-2.5 bg-white dark:border-gray-600
                                            dark:placeholder-gray-400
                                            font-semibold dark:focus:ring-blue-500
                                            dark:focus:border-blue-500"
                                            name="role" id="">
                                            <option value="">-- Pilih keterangan Gejala --</option>
                                                @forelse ($gejalas as $gejala)
                                                    <option
                                                        class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                        value="{{ $gejala->id }}">   {{$gejala->keterangan }}
                                                    </option>
                                                @empty
                                                    <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Solusi Belum Tersedia..</option>
                                                @endforelse
                                        </select>
                                            @error('gejala_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </td>
                                    <td class="px-6 py-4">
                                        <button  wire:click="addDataGejala()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Tambah Gejala
                                        </button>

                                        <button  wire:click="deleteDataGejala()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Hapus Gejala
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            <div class="inline py-6 px-4">
                                <div class="inline-flex gap-2 rounded-md shadow-sm" role="group">
                                    <button
                                        type="button"
                                        class="w-auto text-white bg-blue-700 hover:bg-blue-800
                                        focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                                        rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600
                                        hover:bg-blue-700 focus:ring-blue-800">
                                    Tambah Relasi
                                    </button>
                                    <button
                                        type="button"
                                        class="w-auto text-white bg-yellow-700 hover:bg-yellow-800
                                        focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium
                                        rounded-lg text-sm px-5 py-2.5 text-center bg-yellow-600
                                        hover:bg-yellow-700 focus:ring-yellow-800">
                                    Hapus Relasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                        wire:click.prevent="storeGejala()"
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
