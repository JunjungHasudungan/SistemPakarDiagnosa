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
            <div class="bg-white px-4 pt-5 pb-2 sm:p-6">
                <div class="border border-sky-500 mb-2 py-2 px-2">
                    <div class="bg-white mb-2">
                        <h2 class="text-gray-700 text-center font-semibold">Data Kecanduan</h2>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div class="mb-2">
                            {{-- <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
                              Kode Kecanduan
                            </label> --}}
                                <input type="text"
                                wire:model="kode_kecanduan"
                                name="kode_kecanduan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="kode_kecanduan"
                                placeholder="Masukkan Kode Kecanduan disini..">
                                  @error('kode_kecanduan') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                              {{-- end kode kecanduan --}}

                              {{-- select level_kecanduan --}}
                        <div class="mb-2">
                            {{-- <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
                                Level Kecanduan
                            </label> --}}
                            <select wire:model="level_id"
                                          id="level_id"
                                          class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white dark:border-gray-600 dark:placeholder-gray-400 font-semibold dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          <option value="">-- Pilih Level --</option>
                                              @forelse (\App\Helpers\LevelKecanduan::LevelKecanduan as $key => $item)
                                                  <option class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize" value="{{$item}}"> {{ $key }} </option>
                                              @empty
                                                  <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Level Belum Tersedia..</option>
                                              @endforelse
                            </select>
                                  @error('level_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                          <div class="">
                            {{-- input keterangan kecanduan --}}
                            <div class="mb-4">
                               {{-- <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Keterangan Kecanduan</label> --}}
                               <input type="text"
                               wire:model="deskripsi"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="deskripsi"
                               placeholder="Masukkan Keterangan Kecanduan disini..">
                               @error('deskripsi') <span class="text-red-500">{{ $message }}</span>@enderror
                           </div>
                           {{-- end input keterangan kecanduan --}}
                     </div>
                </div>
                {{-- solusi --}}
                        <div class="border mb-2 border-sky-500 px-4 sm:p-2">
                            <div class="w-full inline">
                                <div class="bg-white">
                                    <h2 class="text-gray-700 text-center font-semibold">Data Solusi</h2>
                                </div>
                                <table class="w-full text-sm rounded text-left text-gray-400">
                                    {{-- <thead class="text-xs text-gray-700 camelcase bg-gray-50 text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">
                                                Untuk siapa
                                             </th>
                                             <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">
                                               Solusi
                                             </th>
                                             <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">

                                              </th>
                                        </tr>
                                    </thead> --}}
                                    <tbody>
                                        @foreach ($kecanduan_solusi as $index => $item)
                                        <tr class="w-auto">
                                         {{-- select to_role --}}
                                            <td class="px-1 py-6 ">
                                                <select
                                                    wire:model="kecanduan_solusi.{{$index}}.role"
                                                    name="kecanduan_solusi[ {{ $index }} ]['role']"
                                                    class="border border-gray-300 text-gray-900 text-sm
                                                    rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                    block w-full bg-white dark:border-gray-600
                                                    dark:placeholder-gray-400
                                                    font-semibold dark:focus:ring-blue-500
                                                    dark:focus:border-blue-500"
                                                    id="">
                                                    <option value="">-- Pilih Untuk Siapa --</option>
                                                        @forelse ($roles as $key => $role)
                                                            <option
                                                                class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                                value="{{ $key }}">  {{$role }}
                                                            </option>
                                                        @empty
                                                            <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Kecanduan Belum Tersedia..</option>
                                                        @endforelse
                                                </select>
                                                    @error('role') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </td>
                                            {{-- end select to_role --}}

                                            {{-- input text area keterangan solusi --}}
                                            <td class="px-1 py-6">
                                                <select
                                                    name="kecanduan_solusi[ {{ $index }} ][solusi_id]"
                                                    wire:model="kecanduan_solusi.{{$index}}.solusi_id"
                                                    class="border border-gray-300 text-gray-900 text-sm
                                                    rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                    block w-full p-2.5 bg-white dark:border-gray-600
                                                    dark:placeholder-gray-400
                                                    font-semibold dark:focus:ring-blue-500
                                                    dark:focus:border-blue-500"
                                                    name="role" id="">
                                                    <option value="">-- Pilih Keterangan Solusi --</option>
                                                        @forelse ($all_kecanduan as $key => $solution)
                                                            <option
                                                                class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                                value="{{ $solution->id }}">  {{$solution->keterangan }}
                                                            </option>
                                                        @empty
                                                            <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Solusi Belum Tersedia..</option>
                                                        @endforelse
                                                </select>
                                                    @error('solusi_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </td>
                                            {{-- end input text area keterangan solusi --}}

                                            {{-- button clear --}}
                                            <td class="px-1 py-6">
                                                <button href="#" wire:click.prevent="removeSolution( {{ $index }} )"
                                                    class=" w-full inline-flex place-items-center text-sm font-bold m-auto px-px space-x-4
                                                    text-center text-yellow-900">
                                                    <span class="text-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                            {{-- end button clear --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <button wire:click.prevent="addSolution()"
                                            class="w-auto text-white bg-blue-700 hover:bg-blue-800
                                            m-4
                                            focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                                            rounded-lg text-sm px-4 py-2 text-center bg-blue-600
                                            hover:bg-blue-700 focus:ring-blue-800">
                                            + Solusi
                                    </button>
                                </div>
                            </div>
                        </div>
                    {{-- end solusi --}}

                    {{-- data gejala --}}
                    <div class="border border-sky-500 px-4 p-2">
                        <div class="w-full inline">
                            <div class="bg-white">
                                <h2 class="text-gray-700 text-center font-semibold">Data Gejala</h2>
                            </div>
                            <table class="w-full text-sm rounded text-left text-gray-400">
                                {{-- <thead class="text-xs text-gray-700 camelcase bg-gray-50 text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">
                                            Untuk siapa
                                         </th>
                                         <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">
                                           Solusi
                                         </th>
                                         <th scope="col" class="px-1 px-1 text-sm font-bold text-gray-700">

                                          </th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    @foreach ($kecanduan_gejala as $index => $item)
                                    <tr class="bg-white w-auto">
                                     {{-- select to_role --}}
                                        <td class="px-1 py-6">
                                            <select
                                                wire:model="kecanduan_gejala.{{$index}}.gejala_id"
                                                name="kecanduan_gejala[ {{ $index }} ]['gejala_id']"
                                                class="border border-gray-300 text-gray-900 text-sm
                                                rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                block w-full bg-white dark:border-gray-600
                                                dark:placeholder-gray-400
                                                font-semibold dark:focus:ring-blue-500
                                                dark:focus:border-blue-500"
                                                id="">
                                                <option value="">-- Pilih Keterangan Gejala --</option>
                                                    @forelse ($all_gejala as $gejala)
                                                        <option
                                                            class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                            value="{{ $gejala->id }}">  {{$gejala->keterangan }}
                                                        </option>
                                                    @empty
                                                        <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Kecanduan Belum Tersedia..</option>
                                                    @endforelse
                                            </select>
                                                @error('gejala_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </td>

                                                                             {{-- select to_role --}}
                                        <td class="px-1 py-6">
                                            <select
                                                wire:model="kecanduan_gejala.{{$index}}.keterangan_relasi"
                                                name="kecanduan_gejala[ {{ $index }} ]['keterangan_relasi']"
                                                class="border border-gray-300 text-gray-900 text-sm
                                                rounded-lg focus:ring-blue-500 focus:border-blue-500
                                                block w-full bg-white dark:border-gray-600
                                                dark:placeholder-gray-400
                                                font-semibold dark:focus:ring-blue-500
                                                dark:focus:border-blue-500"
                                                id="">
                                                <option value="">-- Pilih Keterangan Relasi --</option>
                                                    @forelse ($keterangan_rule as $key => $keterangan)
                                                        <option
                                                            class="font-normal hover:font-bold border-gray-300 rounded-lg capitalize"
                                                            value="{{ $key }}">  {{$keterangan }}
                                                        </option>
                                                    @empty
                                                        <option class="font-normal bg-yellow-400 hover:font-bold capitalize">Data Kecanduan Belum Tersedia..</option>
                                                    @endforelse
                                            </select>
                                                @error('keterangan_relasi') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </td>
                                        {{-- end select to_role --}}

                                        {{-- button clear --}}
                                        <td class="px-1 py-6">
                                            <button href="#" wire:click.prevent="removeDataGejala( {{ $index }} )"
                                                class=" w-full inline-flex place-items-center text-sm font-bold m-auto px-px space-x-4
                                                text-center text-yellow-900">
                                                <span class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>
                                        {{-- end button clear --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="">
                                <button wire:click.prevent="addDataGejala()"
                                        class="w-auto text-white bg-blue-700 hover:bg-blue-800
                                        m-4
                                        focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                                        rounded-lg text-sm px-4 py-2 text-center bg-blue-600
                                        hover:bg-blue-700 focus:ring-blue-800">
                                        + Gejala
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- end data gejala --}}
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                        wire:click.prevent="storeKecanduan()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent
                        px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm
                        hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green
                        transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Simpan
                </button>
              </span>
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                <button wire:click="closeEditModal()"
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
