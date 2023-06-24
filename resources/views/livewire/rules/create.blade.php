<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

          <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  w-10/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
            <div class="bg-white px-4 pt-5 pb-2 sm:p-6 sm:pb-2">
                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div class="mb-6">
                            <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
                              Keterangan Kecanduan
                            </label>
                            <select wire:model="kecanduan_id"
                                id="kecanduan_id"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white dark:border-gray-600 dark:placeholder-gray-400 font-semibold dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">-- Pilih Keterangan Kecanduan --</option>
                                    @forelse ($kecanduans as $key => $item)
                                        <option class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize" value="{{$item->id}}"> {{ $item->deskripsi }} </option>
                                    @empty
                                        <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Level Belum Tersedia..</option>
                                    @endforelse
                            </select>
                                  @error('kecanduan_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                              {{-- end kode kecanduan --}}

                              {{-- select level_kecanduan --}}
                        <div class="mb-6">
                            <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
                                Keterangan Kecanduan
                            </label>
                            <select wire:model="keterangan"
                                          id="keterangan"
                                          class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white dark:border-gray-600 dark:placeholder-gray-400 font-semibold dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          <option value="">-- Pilih Keterangan --</option>
                                              @forelse ($rule_data_pakar as $key => $item)
                                                  <option class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize" value="{{$item}}"> {{ $key }} </option>
                                              @empty
                                                  <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Level Belum Tersedia..</option>
                                              @endforelse
                            </select>
                                  @error('keterangan') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                        <div class="bg-white px-4 pt-2 pb-2 sm:p-6 sm:pb-2">
                            <div class="mb-2 w-full inline">
                                <table class="w-full text-sm rounded text-left text-gray-400">
                                    <thead class="text-xs text-gray-700 camelcase bg-gray-50 text-gray-400">
                                        <tr>
                                            <th scope="col" class=" text-sm font-bold text-gray-700">
                                               Keterangan Aturan Relasi
                                             </th>
                                             <th scope="col" class="px-2 px-3 text-sm font-bold text-gray-700">
                                               Keterangan Gejala
                                             </th>
                                             <th scope="col" class="px-2 px-3 text-sm font-bold text-gray-700">

                                              </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gejala_kecanduan as $index => $item)
                                        <tr class="bg-white w-auto">
                                            <td class="px-1 py-6">
                                                <select
                                                    wire:model="gejala_kecanduan.{{$index}}.keterangan_relasi"
                                                    name="gejala_kecanduan[ {{ $index }} ]['keterangan_relasi']"
                                                    class="border border-gray-300 text-gray-900 text-sm
                                                    rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                    block w-full p-2.5 bg-white dark:border-gray-600
                                                    dark:placeholder-gray-400
                                                    font-semibold dark:focus:ring-blue-500
                                                    dark:focus:border-blue-500"
                                                    id="">
                                                    <option value="">-- Pilih Keterangan --</option>
                                                        @forelse ($rule_data_pakar as $key => $item)
                                                            <option
                                                                class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                                value="{{ $key }}">  {{$item }}
                                                            </option>
                                                        @empty
                                                            <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Kecanduan Belum Tersedia..</option>
                                                        @endforelse
                                                </select>
                                                    @error('keterangan_relasi') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </td>
                                            <td class="px-1 py-6">
                                                <select
                                                    name="gejala_kecanduan[ {{ $index }} ][gejala_id]"
                                                    wire:model="gejala_kecanduan.{{$index}}.gejala_id"
                                                    class="border border-gray-300 text-gray-900 text-sm
                                                    rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                    block w-full p-2.5 bg-white dark:border-gray-600
                                                    dark:placeholder-gray-400
                                                    font-semibold dark:focus:ring-blue-500
                                                    dark:focus:border-blue-500"
                                                    name="role" id="">
                                                    <option value="">-- Pilih Keterangan Gejala --</option>
                                                        @forelse ($allGejala as $key => $gejala)
                                                            <option
                                                                class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                                value="{{ $gejala->id }}">  {{$gejala->keterangan }}
                                                            </option>
                                                        @empty
                                                            <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Solusi Belum Tersedia..</option>
                                                        @endforelse
                                                </select>
                                                    @error('gejala_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </td>
                                            <td class="px-1 py-6">
                                                <button href="#" wire:click.prevent="removeGejala( {{ $index }} )"
                                                    class=" w-full inline-flex place-items-center text-sm font-bold m-auto px-px space-x-4
                                                    text-center text-yellow-900">
                                                    <span class="text-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <button wire:click.prevent="addGejala()"
                                            class="w-auto text-white bg-blue-700 hover:bg-blue-800
                                            m-4
                                            focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                                            rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600
                                            hover:bg-blue-700 focus:ring-blue-800">
                                            + Gejala
                                    </button>
                                </div>
                            </div>
                        </div>
                    {{-- end solusi --}}
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                        wire:click.prevent="storeRule()"
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