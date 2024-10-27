<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    name: "Show",

    props: [
        'theme',
    ],

    data() {
    },

    components: {
        TextInput,
        InputError,
        Link
    },

    // methods: {
    //     store() {
    //         this.$inertia.post('/themes', {
    //             title: this.title,
    //             description: this.description,
    //         })
    //     },
    // },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <h3 class="text-xl">{{ theme.title }}</h3>
        </div>
    </div>
</template>
