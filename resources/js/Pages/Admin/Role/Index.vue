<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",

    props: [
        'roles'
    ],

    components: {
        Link
    },

    layout: AdminLayout
}
</script>

<template>
    <div>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="text-xl">Роли</h3>
            <Link :href="route('admin.roles.create')"
                  class="flex justify-center mr-4 w-1/6 bg-white px-2 py-1 border border-gray-300 rounded-lg text-center">
                +
                Роль
            </Link>
        </div>
        <div>
            <div class="overflow-x-auto flex ">
                <div class="border border-gray-200 rounded-lg flex-1">
                    <table class="text-center text-medium w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4 text-gray-700">ID</th>
                            <th class="p-4 text-gray-700">Название</th>
                            <th class="p-4 text-gray-700">Код</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="role in roles" class="text-gray-500">
                            <td class="p-4">{{ role.id }}</td>
                            <td class="p-4">{{ role.title }}</td>
                            <td class="p-4">{{ role.code }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

