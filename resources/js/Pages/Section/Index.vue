<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "index",

    props: [
        'sections'
    ],

    components: {
        Link
    },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2 mb-8">
            <h3 class="text-xl">Разделы</h3>
            <Link :href="route('sections.create')"
                  class="flex justify-center mr-4 w-1/6 bg-white px-2 py-1 border border-gray-300 rounded-lg text-center">
                +
                Раздел
            </Link>
            <Link :href="route('branches.create')"
                  class="flex justify-center w-1/6 bg-white px-2 py-1 border border-gray-300 rounded-lg text-center">+
                Ветка
            </Link>
        </div>
        <div v-if="sections">
            <div v-for="section in sections" class="mb-8">
                <div v-if="section.branches.length">
                    <div class="mb-4 flex items-center">
                        <h3 class="text-lg mr-4">
                            {{ section.title }}
                        </h3>
                        <Link :href="route('sections.edit', section.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                            </svg>

                        </Link>
                    </div>
                    <div v-for="branch in section.branches">
                        <Link class="flex bg-white p-4 border border-gray-300"
                              :href="route('branches.show', branch.id)">
                            <h3>{{ branch.title }}</h3>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
