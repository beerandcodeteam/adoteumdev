<div
    class="flex flex-col min-h-screen w-full justify-between items-center p-7 bg-gray-10 overflow-hidden"
    x-data="swipeCard()"
>
    <div class="flex flex-row items-center justify-between w-full">
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-25" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <x-logo class="w-12 h-12 text-primary-100 fill-current" />
        </div>
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-25" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
            </svg>
        </div>
    </div>

    <div
        class="flex flex-1 flex-row items-start justify-center w-full relative mt-4"
        x-ref="cardbox"
    >

        <template
            x-if="showelement"
        >
            <div
                x-ref="swipecard"
                class="flex w-full absolute transition transform duration-500 ease-in-out"
                x-on:pointerdown="mouseclick"
                x-on:pointermove="movingcard"
                x-on:pointerup="releasecard"
                x-on:pointercancel="releasecard"
                x-on:pointerleave="releasecard"
            >
                <div class="relative w-full cursor-pointer">

                    <div
                        class="flex flex-row w-full items-center absolute top-0 left-0 p-4"
                        x-ref="actionbox"
                    >
                        <div
                            x-show="like"
                            x-ref="like"
                            class="bg-green-500 py-1 px-6 text-white font-bold rounded-full"
                        >
                            LIKE
                        </div>

                        <div
                            x-show="dislike"
                            x-ref="dislike"
                            class="bg-primary-100 py-1 px-6 text-white font-bold rounded-full"
                        >
                            NOPE
                        </div>
                    </div>

                    <img class="w-full rounded-md pointer-events-none" src="https://placeimg.com/600/600/people" />

                    <div
                        class="text-md rounded-md text-white absolute bottom-0 left-0 flex flex-col w-full p-4 space-y-2 bg-gradient-to-t from-black via-black-50 "
                    >
                        <div class="flex flex-row items-center">
                            <span class="font-bold">Lucas Souza</span>
                            <span>,</span>
                            <span class="ml-1"> Brasil</span>
                        </div>
                        <span>PHP Backend Developer</span>
                        <span>3 interesses em comum [PHP, Vue, Js]</span>
                        <div class="flex flex-row items-center w-full space-x-6 ">

                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-xs font-bold ml-1">55</span>
                            </div>

                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-bold ml-1">235</span>
                            </div>

                            <div class="flex flex-row items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <span class="text-xs font-bold ml-1">55</span>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </template>

    </div>

    <div class="flex flex-row items-center justify-between w-full">
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <div class="rounded-full shadow-lg bg-white p-3">

                <x-svg-gradient
                    idGradient="dislike"
                    firstColor="#fe7754"
                    lastColor="#fd277c"
                    class="w-12 h-12" viewBox="0 0 20 20"
                >
                    <path
                        style="fill:url(#dislike);fill-opacity:1;"
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </x-svg-gradient>
            </div>
        </div>
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <div class="rounded-full shadow-lg bg-white p-3">

                <x-svg-gradient
                    idGradient="superlike"
                    firstColor="#35abf5"
                    lastColor="#22b7f9"
                    class="w-12 h-12" viewBox="0 0 20 20"
                >
                    <path
                        style="fill:url(#superlike);fill-opacity:1;"
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    />
                </x-svg-gradient>
            </div>
        </div>
        <div class="cursor-pointer transform duration-150 active:scale-95">
            <div class="rounded-full shadow-lg bg-white p-3">

                <x-svg-gradient
                    idGradient="like"
                    firstColor="#13E49B"
                    lastColor="#50ECCF"
                    class="w-12 h-12" viewBox="0 0 20 20"
                >
                    <path
                        style="fill:url(#like);fill-opacity:1;"
                        fill-rule="evenodd"
                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                        clip-rule="evenodd"
                    />
                </x-svg-gradient>
            </div>
        </div>
    </div>
</div>
