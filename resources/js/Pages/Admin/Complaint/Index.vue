<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",

    props: [
        'complaints'
    ],

    components: {
        Link
    },

    methods: {
        async update(complaint) {
            try {
                await axios.patch(`/admin/complaints/${complaint.id}`, {})
                complaint.is_solved = !complaint.is_solved
            } catch (error) {
                console.error(error);
            }
        }
    },

    layout: AdminLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="text-xl">Жалобы</h3>
        </div>
        <div>
            <div class="overflow-x-auto flex ">
                <div class="border border-gray-200 rounded-lg flex-1">
                    <table class="text-center text-medium w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4 text-gray-700">ID</th>
                            <th class="p-4 text-gray-700">Текст</th>
                            <th class="p-4 text-gray-700">Пользователь</th>
                            <th class="p-4 text-gray-700">Ссылка(Сообщение)</th>
                            <th class="p-4 text-gray-700">Статус</th>
                            <th class="p-4 text-gray-700">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="complaint in complaints" class="text-gray-500">
                            <td class="p-4">{{ complaint.id }}</td>
                            <td class="p-4">{{ complaint.body }}</td>
                            <td class="p-4">{{ complaint.user.name }}</td>
                            <td class="p-4">
                                <Link
                                    :href="route('themes.show', complaint.theme_id) + `#${complaint.message_id}`">
                                    Ссылка
                                </Link>
                            </td>
                            <td class="p-4 whitespace-nowrap">{{ complaint.is_solved ? 'Решено' : 'В работе' }}</td>
                            <td class="p-4">
                                <a @click.prevent="update(complaint)" href="#" class="flex w-6 h-6 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         :class="[complaint.is_solved ? 'stroke-green-700' : 'stroke-red-700', 'size-6']">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

