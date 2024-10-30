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
        return {}
    },

    components: {
        TextInput,
        InputError,
        Link
    },

    methods: {
        async store() {
            try {
                await axios.post('/messages', {
                    content: this.$refs.editor.innerHTML,
                    theme_id: this.theme.id
                })
                this.$refs.editor.innerHTML = ''
            } catch (error) {
                console.error(error);
            }
        }
    },

    layout: MainLayout
}
</script>

<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <h3 class="text-xl">{{ theme.title }}</h3>
        </div>
        <div v-if="theme.messages.length">
            <div v-for="message in theme.messages" class="flex bg-white border border-gray-300">
                <div class="p-4 w-1/6 border-r border-gray-300">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto mb-2">

                    </div>
                    <div>
                        <h3 class="text-center">{{ message.user.name }}</h3>
                    </div>
                </div>
                <div class="p-4 w-5/6">
                    <div class="mb-2">
                        <p class="text-sm italic">{{ message.time }}</p>
                    </div>
                    <div>
                        <p v-html="message.content"></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-white border-gray-300 border p-4">
            <div class="mb-4">
                <h3 class="text-xl">Добавить сообщение</h3>
            </div>
            <div class="mb-4">
                <div ref="editor" class="w-full border border-gray-300 p-2" contenteditable="true">
                </div>
            </div>
            <div class="flex">
                <a @click.prevent="store" class="w-1/4 p-2 bg-sky-600 text-white text-center border border-sky-700"
                   href="#">Опубликовать</a>
            </div>
        </div>
    </div>
</template>
