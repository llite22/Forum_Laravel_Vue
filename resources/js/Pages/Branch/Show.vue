<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",

    props: [
        'branch'
    ],

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <h3 class="text-xl">{{ branch.title }}</h3>
        </div>
    </div>
</template>

<style scoped>

</style>
