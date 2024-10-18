<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",

    props: [
        'sections'
    ],

    data() {
        return {
            title: '',
            section_id: null,
            branches: [],
            parent_id: null
        }
    },

    components: {
        Link
    },

    methods: {
        store() {
            this.$inertia.post('/branches', {
                parent_id: this.parent_id,
                section_id: this.section_id,
                title: this.title
            })
        },
        async getBranches() {
            this.parent_id = null
            try {
                const responce = await axios.get(`/sections/${this.section_id}/branches`)
                this.branches = responce.data
            } catch (error) {
                console.log(error);
            }
        }
    },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <h3 class="text-xl">Добавить ветку</h3>
            <div>
                <div class="mb-4" v-if="sections.length > 0">
                    <select @change="getBranches" class="border-gray-300 p-2 w-1/4" v-model="section_id">
                        <option value="null" selected disabled>Выберите раздел</option>
                        <option v-for="section in sections" :value="section.id">{{ section.title }}</option>
                    </select>
                </div>
                <div class="mb-4" v-if="branches.length > 0">
                    <select class="border-gray-300 p-2 w-1/4" v-model="parent_id">
                        <option value="null" selected disabled>Выберите ветку</option>
                        <option v-for="branch in  branches" :value="branch.id">{{ branch.title }}</option>
                    </select>
                </div>
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
