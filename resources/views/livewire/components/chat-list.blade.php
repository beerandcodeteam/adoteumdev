<div
    class="flex flex-col min-h-screen w-full items-center bg-gray-10 overflow-hidden"
    x-data="chatList({})"
>
    <div class="flex flex-row w-full p-7 items-start space-x-4 fixed bg-gray-10 z-50">
        <a href="{{ route('app.developers') }}"  class="cursor-pointer transform duration-150 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-25" viewBox="0 0 20 20 " fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
        <div class="flex flex-row items-center w-full cursor-pointer transform duration-150 active:scale-95">
            <img class="rounded-full h-8 w-8" src="{{ $loggedUser->profile->avatar }}" />
        </div>
    </div>

    <div class="flex flex-col w-full mt-28">
        <h3 class="text-primary-100 font-bold text-md px-7 ">
            Possíveis recrutadores
        </h3>

        <div class="flex flex-row overflow-x-scroll mt-4">
            @foreach($receivedActions as $index => $action)
                <div
                    x-on:mouseover="showActions('{{$index}}')"
                    x-on:mouseleave="hideActions('{{$index}}')"
                    class="{{ $index === 0 ? 'ml-7' : '' }} text-center min-w-16 max-w-16 h-22 mr-4 relative"
                >
                    <img class="rounded min-w-16 h-20 object-cover" src="{{ $action['from_user']['profile']['avatar'] }}" />
                    <span class="text-xs text-gray-100 font-bold break-all">{{ \Str::words($action['from_user']['name'], 1, '') }}</span>
                    <div x-ref="recruiterBg{{$index}}" class="hidden absolute top-0 left-0 bg-gray-50 rounded w-full h-full opacity-50 flex-col justify-between items-center"></div>
                    <div x-ref="recruiterActions{{$index}}" class="hidden absolute top-0 left-0 rounded w-full h-full flex-col justify-between items-center py-2">
                        <button
                            @click="action('{{ $action['from_user_id'] }}', 'dislike')"
                            class="rounded-full shadow-lg bg-transparent border border-white p-1 transform duration-150 active:scale-95"
                        >
                            <x-svg-gradient
                                idGradient="dislike"
                                firstColor="#fe7754"
                                lastColor="#fd277c"
                                class="w-8 h-8" viewBox="0 0 20 20"
                            >
                                <path
                                    style="fill:url(#dislike);fill-opacity:1;"
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </x-svg-gradient>
                        </button>
                        <button
                            @click="action('{{ $action['from_user_id'] }}', 'like')"
                            class="rounded-full shadow-lg bg-transparent border border-white p-1 transform duration-150 active:scale-95"
                        >
                            <x-svg-gradient
                                idGradient="like"
                                firstColor="#13E49B"
                                lastColor="#50ECCF"
                                class="w-8 h-8" viewBox="0 0 20 20"
                            >
                                <path
                                    style="fill:url(#like);fill-opacity:1;"
                                    fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"
                                />
                            </x-svg-gradient>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col w-full mt-4 mb-7 px-7">
        <h3 class="text-primary-100 font-bold text-md ">
            Mensagens
        </h3>

        @foreach($receivedMessages as $message)
            <a href="{{route('app.chat', ['user' => $message['from_user_id']])}}" class="flex flex-row w-full mt-4 cursor-pointer transform duration-150 active:scale-95">
                <div class="flex flex-row w-full items-center">
                    <div class="relative flex flex-col items-end justify-center">
                        <img class="rounded-full w-14 h-14 object-cover" src="{{ $message['from_user']['profile']['avatar'] }}" />
                        <div class="rounded-full absolute -right-2 h-4 w-4 border-2 border-gray-10 bg-primary-100"></div>
                    </div>
                    <div class="flex flex-col ml-4">
                        <span class="text-sm font-bold text-gray-100">{{ $message['from_user']['name'] }}</span>
{{--                        <span class="text-xs text-gray-75">{{ $message['content'] }}</span>--}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
