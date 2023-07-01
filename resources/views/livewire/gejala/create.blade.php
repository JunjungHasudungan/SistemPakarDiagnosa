<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center max-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

          <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

          <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle
                sm:my-8 sm:align-middle  w-8/12" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                @csrf
            <div class="px-4 pt-1 pb-1 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mb-2">
                        <h2 class="text-gray-700 text-center font-semibold">Data Gejala</h2>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div class="mb-6">
                            {{-- <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
                              Kode Kecanduan
                            </label> --}}
                                <input type="text"
                                wire:model="kode_gejala"
                                name="kode_gejala"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="kode_gejala"
                                placeholder="Masukkan Kode Kecanduan disini..">
                                  @error('kode_gejala') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                              {{-- end kode kecanduan --}}

                              {{-- select level_kecanduan --}}
                        <div class="mb-6">
                            {{-- <label for="keterangan" class="block mb-2 text-sm font-bold text-gray-700">
                                Keterangan Kegala
                            </label> --}}
                            <input type="text"
                                wire:model="keterangan"
                                name="keterangan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="keterangan"
                                placeholder="Masukkan Keterangan Kecanduan disini..">
                                  @error('keterangan') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>
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
