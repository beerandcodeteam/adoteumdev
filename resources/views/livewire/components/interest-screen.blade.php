<div class="flex flex-col min-h-screen items-center w-full p-4">
    <div class="mt-10 sm:mt-0 w-full">
        <div class="md:col-span-1">
            <div class="flex flex-col items-center justify-center space-y-2">
                <img class="inline-block h-14 w-14 rounded-full" src="{{ $user['profile']['avatar'] }}" alt="" />
                <h3 class="text-lg font-medium leading-6 text-gray-900">Complete seus interesses</h3>
            </div>
        </div>
        <div class="mt-5">
            <form class="space-y-4">
                <x-start-form :categories="$categories" />
            </form>
        </div>
    </div>
</div>
