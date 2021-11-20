<div
    class="flex flex-col min-h-screen justify-between w-full items-center bg-gray-10 overflow-hidden"
    x-data="{}"
>
    <div class="flex flex-row w-full px-7 py-4 justify-between items-center fixed bg-gray-10 z-50 shadow">
        <a href="{{ route('app.developers') }}"  class="cursor-pointer transform duration-150 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-25" viewBox="0 0 20 20 " fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
        <div class="flex flex-col items-center">
            <img class="rounded-full h-8 w-8" src="https://picsum.photos/200/300" />
            <span class="text-gray-75 text-xs font-bold mt-2">Nome do caboclo</span>
        </div>
        <div></div>
    </div>
    <div class="flex flex-col flex-1 w-full mt-28 px-7">

        <div class="flex flex-row w-full mt-4 cursor-pointer transform duration-150 active:scale-95">
            <div class="flex flex-row w-full items-center">
                <div class="relative flex flex-col min-w-8 items-end justify-center">
                    <img class="rounded-full min-w-8 h-8 object-cover" src="https://picsum.photos/200/300" />
                </div>
                <div class="flex flex-col ml-4 bg-gray-200 rounded p-2">
                    <span class="text-xs text-gray-75">E ai mano Brown</span>
                </div>
            </div>
        </div>

        <div class="flex flex-row w-full mt-4 cursor-pointer transform duration-150 active:scale-95">
            <div class="flex flex-row w-full justify-end">
                <div class="flex flex-col mr-4 bg-blue-100 rounded p-2">
                    <span class="text-xs text-white">E ai mano Brown Teste steste eaei ajkajkasjd ashjdahsjdh akajskjdas </span>
                </div>

                <div class="relative flex flex-col items-end justify-center">
                    <img class="rounded-full min-w-8 h-8 object-cover" src="https://picsum.photos/200/300" />
                </div>
            </div>
        </div>

    </div>
    <div class="flex flex-row w-full bg-gray-10 fixed bottom-0 p-7">
        <div class="relative w-full flex flex-col items-end justify-center">
            <input name="chat" class="placeholder-gray-65 py-1 pl-4 pr-14 rounded-full w-full bg-gray-35 border border-gray-65" placeholder="Digite uma mensagem" />
            <button class="bg-transparent text-sm text-gray-65 absolute mr-2">Enviar</button>
        </div>
    </div>

</div>
