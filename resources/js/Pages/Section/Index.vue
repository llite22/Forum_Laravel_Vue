<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "index",

    components: {
        Link
    },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2">
            <h3 class="text-xl">Разделы</h3>
            <Link :href="route('sections.create')"
                  class="flex justify-center mr-4 w-1/6 bg-white px-2 py-1 border border-gray-300 rounded-lg text-center">+
                Раздел
            </Link>
            <Link :href="route('branches.create')"
                  class="flex justify-center w-1/6 bg-white px-2 py-1 border border-gray-300 rounded-lg text-center">+
                Ветка
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>
