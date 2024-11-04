<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";

export default {
    name: "Create",

    components: {InputError},

    props: [
        'sections'
    ],

    data() {
        return {
            title: '',
            section_id: null,
            branches: [],
            branch_id: null
        }
    },

    methods: {
        store() {
            this.$inertia.post('/admin/roles', {
                title: this.title,
                section_id: this.section_id,
                branch_id: this.branch_id
            })
        },
        async getBranches() {
            this.branch_id = null
            try {
                const res = await axios.get(`/sections/${this.section_id}/branches`)
                this.branches = res.data
            } catch (error) {
                console.log(error);
            }
        }
    },

    layout: AdminLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="text-xl">Добавить роль</h3>
        </div>
        <div>
            <div class="border border-gray-200 rounded-lg">
                <div>
                    <div class="mb-4" v-if="sections.length > 0">
                        <select @change="getBranches" class="border-gray-300 p-2 w-1/4" v-model="section_id">
                            <option value="null" selected disabled>Выберите раздел</option>
                            <option v-for="section in sections" :value="section.id">{{ section.title }}</option>
                        </select>
                        <InputError :message="$page.props.errors.section_id"/>
                    </div>
                    <div class="mb-4" v-if="branches.length > 0">
                        <select class="border-gray-300 p-2 w-1/4" v-model="branch_id">
                            <option value="null" selected disabled>Выберите ветку</option>
                            <option v-for="branch in  branches" :value="branch.id">{{ branch.title }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <input placeholder="Заголовок" type="text" v-model="title"
                               class="border-gray-300 p-2 w-1/4">
                        <InputError :message="$page.props.errors.title"/>
                    </div>
                    <div>
                        <a class="flex justify-center w-1/4 py-2 bg-sky-500 border border-sky-600 text-white text-center cursor-pointer"
                           @click.prevent="store">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

