<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Edit",

    props: [
        'section'
    ],

    data() {
        return {
            title: this.section.title
        }
    },

    components: {
        Link
    },

    methods: {
        update() {
            this.$inertia.patch(`/sections/${this.section.id}`, {
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
            <h3 class="text-xl">Отредактировать раздел</h3>
            <div>
                <div class="mb-4">
                    <input placeholder="Заголовок" type="text" v-model="title" class="border-gray-300 p-2 w-1/4">
                </div>
                <div>
                    <a class="flex justify-center w-1/4 py-2 bg-sky-500 border border-sky-600 text-white text-center cursor-pointer"
                       @click.prevent="update">Сохранить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
