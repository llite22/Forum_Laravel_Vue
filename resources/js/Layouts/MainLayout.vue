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
            <div class="flex gap-4 w-1/2 mx-auto">
                <Link :href="route('sections.index')">Форум</Link>
                <Link :href="route('users.personal')">Личный кабинет</Link>
                <Link :href="route('admin.main.index')">Админ панель</Link>
            </div>
        </div>
        <div class="w-1/2 mx-auto py-4">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
