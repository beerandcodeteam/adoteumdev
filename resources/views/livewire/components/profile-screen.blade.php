<div
    class="flex flex-col min-h-screen justify-between w-full items-center bg-gray-10 overflow-hidden"
    x-data="{
        loggedUser: @entangle('loggedUser'),
        files: null
    }"
>
    <div class="flex flex-row w-full px-7 py-4 justify-between items-center fixed bg-gray-10 z-50 shadow">
        <a href="{{ route('app.developers') }}"  class="cursor-pointer transform duration-150 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-25" viewBox="0 0 20 20 " fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
        <div>

        </div>
    </div>

    <div class="mt-20 w-full">
        <div class="md:col-span-1">
            <div class="flex flex-col items-center justify-center space-y-2">
                @if($this->imageProfile)
                    <img class="inline-block h-24 w-24 rounded-full" src="{{ $this->imageProfile->temporaryUrl() }}"
                         alt="" />
                @else
                    <img class="inline-block h-24 w-24 rounded-full" src="{{ $loggedUser['profile']['avatar'] }}" alt="" />
                @endif
                <div class="flex flex-row w-1/3 items-center justify-center">
                    <form name="formAvatar" action="" method="post" wire:submit.prevent="uploadAvatar">
                        <label
                            class="w-full min-w-full block flex flex-row items-center justify-center px-2 h-10
                            bg-white rounded-md shadow-md uppercase border border-primary-100
                            cursor-pointer hover:bg-primary-100 hover:text-white text-primary-100
                            ease-linear transition-all space-x-4 duration-150"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 py-1" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <input wire:model="imageProfile" type="file" class="hidden" name="imageProfile"
                                   x-on:change="files = Object.values($event.target.files)" accept="image/jpg,image/jpeg,image/png"
                            />
                            <span
                                x-text="files
                                            ? files.map(file => file.name).join(', ')
                                            : 'Selecione o Avatar'"
                                  class="w-full max-w-full text-xs items-center"></span>
                        </label>
                        <div class="w-full flex flex-row justify-end">
                            <button type="submit" @click="files = null" x-show="files != null"
                                class="mt-2 text-xs bg-white rounded-md shadow-md uppercase border
                                    border-primary-100 cursor-pointer hover:bg-primary-100 hover:text-white text-primary-100
                                    ease-linear transition-all py-1 px-2"
                            >Salvar</button>
                        </div>
                    </form>
                </div>

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $loggedUser['name'] }}</h3>
            </div>
        </div>
        <div class="mt-5 px-2">
            <div class="flex flex-row w-full">
                <a href="{{ route('app.interest', 'edit') }}"
                    class="flex flex-row space-x-2 justify-center items-center bg-primary-100 p-4 text-white
                    w-full text-sm rounded-full mt-8 font-bold transform duration-150 active:scale-95"
                >
                    <span>Alterar interesses</span>
                </a>
            </div>
            <div class="flex flex-row w-full">
                <a href="{{ route('app.knowledge', 'edit') }}"
                    class="flex flex-row space-x-2 justify-center items-center bg-primary-100 p-4 text-white
                    w-full text-sm rounded-full mt-8 font-bold transform duration-150 active:scale-95"
                >
                    <span>Alterar habilidades</span>
                </a>
            </div>
        </div>
    </div>
</div>
