<div>
    <div
        class="flex flex-col items-center justify-center min-h-screen w-full bg-gradient-to-tr from-primary-100 to-secondary-100"
    >
        <div class="flex flex-1 flex-col items-center justify-end text-2xl px-10">

            <div class="flex flex-row items-center justify-center text-2xl text-white p-4 mb-24 space-x-2">
                <x-logo class="w-14 h-14 fill-current" />
                <span class="font-bold">AdoteUm.Dev</span>
            </div>

            <p class="text-center text-white text-xs">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa dolor dolorem,
                dolorum eius enim facilis illum magnam mollitia neque nisi optio porro quibusdam
                quis reiciendis soluta suscipit temporibus vero vitae!
            </p>

            <button wire:click="loginWithGoogle"
                class="flex flex-row space-x-2 justify-center items-center bg-white p-4 text-gray-100 w-full text-sm rounded-full mt-8 font-bold transform duration-150 active:scale-95"
            >
                <x-icon-google class="h-4 w-4 fill-current" />
                <span>Entrar como Recrutador</span>
            </button>

            <button wire:click="loginWithGithub"
                class="flex flex-row space-x-2 justify-center items-center border-white border-2 border-solid p-4 text-white mb-8 mt-4 w-full text-sm rounded-full font-bold transform duration-150 active:scale-95"
            >
                <x-icon-github class="w-4 h-4 fill-current" />
                <span>Entrar como Dev</span>
            </button>

        </div>
    </div>
</div>
