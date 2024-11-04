<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: [
        'stats'
    ],

    layout: AdminLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="text-xl">Статистика</h3>
        </div>
        <div>
            <div v-if="stats" class="flex items-center justify-between text-center">
                <div v-for="stat in stats">
                    <h3>{{ stat.title }}</h3>
                    <p>{{ stat.count }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
