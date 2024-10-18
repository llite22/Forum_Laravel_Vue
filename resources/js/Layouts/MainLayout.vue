<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "MainLayout",

    components: {
        Link
    }
}
</script>

<template>
    <div>
        <div class="flex justify-center bg-white border-b border-gray-300 py-4">
            <Link :href="route('sections.index')" class="w-1/2 mx-auto">Форум</Link>
        </div>
        <div class="w-1/2 mx-auto py-4">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
