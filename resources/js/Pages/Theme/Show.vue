<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",

    props: [
        'theme',
    ],

    data() {
        return {}
    },

    components: {},

    methods: {
        async store() {
            if (this.$refs.editor.innerHTML === '') return null
            try {
                const res = await axios.post('/messages', {
                    content: this.$refs.editor.innerHTML,
                    theme_id: this.theme.id
                })
                this.theme.messages.push(res.data)
                this.$refs.editor.innerHTML = ''
            } catch (error) {
                console.error(error);
            }
        },

        async toggleLike(message) {
            try {
                await axios.post(`/messages/${message.id}/likes`)
                message.is_liked ? message.likes-- : message.likes++
                message.is_liked = !message.is_liked
            } catch (error) {
                console.error(error);
            }
        },
        quote(content) {
            if (window.getSelection().toString()) {
                content = window.getSelection().toString()
            }

            const editor = this.$refs.editor;
            const oldText = editor.innerHTML
            editor.innerHTML = `${oldText}<br><blockquote> ${content} </blockquote><br>`
        },
        answer(message) {
            const title = `<div class="w-full bg-gray-200 border border-gray-300 p-2">Ответ пользователю @${message.user.id} ${message.user.name} ${message.time}</div>`

            const editor = this.$refs.editor;
            const oldText = editor.innerHTML
            editor.innerHTML = `${oldText} ${title}<blockquote> ${message.content} </blockquote><br>`
        },
        openComplaint(message) {
            message.body = ''
            message.is_complaint = !message.is_complaint
        },
        async complaint(message) {
            if (message.body === '') return null
            try {
                const res = await axios.post(`/messages/${message.id}/complaints`, {
                    body: message.body,
                    theme_id: message.theme_id
                })
                message.is_not_solved_complaint = res.data.is_not_solved_complaint
                message.body = ''
            } catch (error) {
                console.error(error);
            }
        },
        async storeImage(e) {
            const file = e.target.files[0]
            const formData = new FormData()
            formData.append('image', file)

            try {
                const res = await axios.post('/images', formData)
                const image = `<span hidden>img_id=${res.data.id}</span> <img src="${res.data.url}" alt="img" />`
                const editor = this.$refs.editor;
                const oldText = editor.innerHTML
                editor.innerHTML = `${oldText}<br> ${image} <br>`
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
                    <div class="w-full max-w-24 max-h-24 bg-gray-300 rounded-full mx-auto mb-2 overflow-hidden">
                        <img class="w-full h-full object-cover" v-if="message.user.avatar_url"
                             :src="message.user.avatar_url"
                             :alt="message.user.name">
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
                        <div class="mb-4" v-if="message.is_not_solved_complaint">
                            <p class="w-full bg-red-100  border border-red-200 p-2">Ваша жалоба в рассмотрении</p>
                        </div>
                        <div class="mb-4">
                            <p v-html="message.content"></p>
                        </div>
                        <div class="flex items-center justify-end w-full mb-4">
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <a @click.prevent="openComplaint(message)" href="#"
                                       class="text-sm rounded-lg bg-white border border-red-800 inline-flex py-2 px-3 text-center text-red-800">Пожаловаться</a>
                                </div>
                                <div class="mr-4">
                                    <a @click.prevent="quote(message.content)" href="#"
                                       class="text-sm rounded-lg bg-sky-600 border border-sky-700 inline-flex py-2 px-3 text-center text-white">Цитировать</a>
                                </div>
                                <div class="mr-4">
                                    <a @click.prevent="answer(message)" href="#"
                                       class="text-sm rounded-lg bg-indigo-600 border border-indigo-700 inline-flex py-2 px-3 text-center text-white">Ответить</a>
                                </div>
                                <span class="mr-2">
                                    {{ message.likes }}
                                </span>
                                <a @click.prevent="toggleLike(message)" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         :class="[message.is_liked ? 'fill-sky-600' : 'stroke-sky-600', 'size-5']">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center" v-if="message.is_complaint">
                            <input v-model="message.body"
                                   class="p-2 w-9/12 rounded-r-none rounded-lg border border-gray-300" type="text">
                            <a @click.prevent="complaint(message)" href="#"
                               class="w-3/12 rounded-l-none text-center bg-red-800 text-white p-2 rounded-lg">Отправить</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-white border-gray-300 border p-4">
            <div class="mb-4">
                <h3 class="text-xl">Добавить сообщение</h3>
            </div>
            <div class="mb-4">
                <div class="bg-gray-50 border-gray-100 p-2 w-full">
                    <div>
                        <a @click.prevent="this.$refs.image.click()" href="#" class="flex w-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                            </svg>
                        </a>
                        <input @change="storeImage" hidden ref="image" type="file">
                    </div>
                </div>
                <div ref="editor" @keydown="handleKeydown" class="w-full border border-gray-300 p-2"
                     contenteditable="true">
                </div>
            </div>
            <div class="flex items-center">
                <a @click.prevent="store" class="w-1/4 p-2 bg-sky-600 text-white text-center border border-sky-700"
                   href="#">Опубликовать</a>
            </div>
        </div>
    </div>
</template>

<style>

blockquote {
    display: flex;
    flex-direction: column;
    padding: 4px;
    padding-left: 6px;
    border-left: 4px solid #a0aec0;
    background-color: #f6f6f6;
}
</style>

