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
                    <div class="mb-4">
                        <h3 class="text-lg">
                            {{ section.title }}
                        </h3>
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
