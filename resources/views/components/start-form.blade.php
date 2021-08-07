<div x-data="form()" class="space-y-4">
    <template
        x-for="category in categories"
    >
        <div class="shadow overflow-hidden rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">

                        <label for="country" class="block text-sm font-medium text-gray-700" x-text="category.name"></label>
                        <select
                            :disabled="!category.skills.length"
                            id="country"
                            name="country"
                            autocomplete="country"
                            class="mt-1 mb-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            x-on:change="changeSkill(category.name, $event)"
                        >
                            <option value="">Selecione</option>
                            <template x-for="skill in category.skills">
                                <option :value="skill.id" x-text="skill.name"></option>
                            </template>
                        </select>


                        <div class="space-y-1">
                            <template
                                x-if="payload.hasOwnProperty(category.name)"
                            >
                                <template x-for="(skill, index) in payload[category.name]">
                                    <div class="flex flex-col p-y-4">
                                        <ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
                                            <li class="col-span-1 flex shadow-sm rounded-md">
                                                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md" x-text="skill.name"></div>
                                                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                                    <div class="flex-1 px-4 py-2 text-sm truncate">
                                                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">Qual seu nível de conhecimento?</a>
                                                        <div class="flex flex-row space-x-2">
                                                            <template x-for="i in 5">
                                                                <button x-on:click.prevent="skill.level = i" class="transform duration-150 active:scale-95">
                                                                    <svg class="h-6 w-6" :class="skill.level < i ? 'text-grey-50' : 'text-primary-100'" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                                    </svg>
                                                                </button>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    <div class="flex-shrink-0 pr-2">
                                                        <button
                                                            x-on:click.prevent="removeSkill(category.name, index)"
                                                            class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

@section('scripts')
    <script>
        function form() {
            return {
                categories: @entangle('categories'),
                payload: {},
                changeSkill(selectedCategory, event, el) {
                    const category = this.categories.find((item) => item.name === selectedCategory)
                    const skill = category.skills.find(item => item.id === parseInt(event.target.value))
                    if (this.payload.hasOwnProperty(selectedCategory)) {
                       this.payload[selectedCategory].push({
                           ...skill,
                           level: 0
                       })
                    } else {
                        this.payload[selectedCategory] = [{
                            ...skill,
                            level: 0
                        }]
                    }

                    const newSkills = category.skills.filter((item) => item.id !== skill.id)

                    this.categories = this.categories.map((item) => {
                        if (item.name === selectedCategory) {
                            item.skills = newSkills
                        }

                        return item;
                    })


                    setTimeout(() => {
                        event.target.value = ""

                    }, 100)

                },
                removeSkill(payloadCategory, position) {
                    const skill = this.payload[payloadCategory].splice(position, 1)

                    this.categories = this.categories.map((item) => {
                        if (item.name === payloadCategory) {
                            item.skills.push(skill[0])
                        }

                        return item;
                    })
                }
            }
        }
    </script>
@endsection
