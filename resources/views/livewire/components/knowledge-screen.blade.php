<div class="flex flex-col min-h-screen items-center w-full p-4">
    <div class="mt-10 w-full">
        <div class="md:col-span-1">
            <div class="flex flex-col items-center justify-center space-y-2">
                <img class="inline-block h-14 w-14 rounded-full" src="{{ $user['profile']['avatar'] }}" alt="" />
                <h3 class="text-lg font-medium leading-6 text-gray-900">Complete suas Habilidades</h3>
            </div>
        </div>
        <div class="mt-5">
            <x-start-form />

            <div class="flex flex-row w-full">
                <button wire:click="save"
                        class="flex flex-row space-x-2 justify-center items-center bg-primary-100 p-4 text-white w-full text-sm rounded-full mt-8 font-bold transform duration-150 active:scale-95"
                >
                    <span>Cadastrar Habilidades</span>
                </button>
            </div>
        </div>
    </div>
</div>
