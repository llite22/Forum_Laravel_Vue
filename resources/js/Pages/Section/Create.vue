<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",

    data() {
        return {
            title: ''
        }
    },

    components: {
        Link
    },

    methods: {
        store() {
            this.$inertia.post('/sections', {
                title: this.title
            })
        }
    },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <h3 class="text-xl">Добавить раздел</h3>
            <div>
                <div class="mb-4">
                    <input placeholder="Заголовок" type="text" v-model="title" class="border-gray-300 p-2 w-1/4">
                </div>
                <div>
                    <a class="flex justify-center w-1/4 py-2 bg-sky-500 border border-sky-600 text-white text-center cursor-pointer"
                       @click.prevent="store">Добавить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
