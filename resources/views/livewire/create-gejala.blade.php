<div class="border-2 px-2 py-2 rounded-lg">
    <div class="grid md:grid-cols-2 md:gap-4">
        <div class="mb-6">
            <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
            Kode Gejala
            </label>
                <input type="text"
                wire:model="kode_gejala"
                name="kode_gejala"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="kode_gejala"
                placeholder="Masukkan Kode Gejala disini..">
                @error('kode_gejala') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
        <div class="mb-6">
            <label for="completeness" class="block mb-2 text-sm font-bold text-gray-700">
            Keterangan Gejala
            </label>
            <input type="text"
                wire:model="keterangan"
                name="keterangan"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="keterangan"
                placeholder="Masukkan Keteragan gejala disini..">
                @error('keterangan') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
    </div>
    <div>
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

              <button wire:click="closeAddGejala()"
                      type="button"
                      class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2
                      bg-gray-600 text-base  text-white leading-6 font-medium text-whiteshadow-sm
                      hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue
                      transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Cancel
              </button>
            </span>
          </div>
    </div>
</div>
