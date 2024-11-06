<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "AdminLayout",

    components: {
        Link
    }
}
</script>

<template>
    <div>
        <div class="flex justify-center bg-white border-b border-gray-300 py-4">
            <div class="w-1/2 mx-auto">
                <Link :href="route('sections.index')" class="mr-4">Форум</Link>
                <Link :href="route('users.personal')">Личный кабинет</Link>
            </div>
        </div>
        <div class="flex items-start gap-4 w-1/2 mx-auto py-4">
            <div class="w-1/4 bg-white border border-gray-300">
                <h3 class="text-xl p-4">Меню</h3>
                <div>
                    <div>
                        <Link class="flex p-4 w-full border-t border-b border-gray-300"
                              :href="route('admin.main.index')">
                            Статистика
                        </Link>
                    </div>
                    <div>
                        <Link class="flex p-4 w-full border-t border-b border-gray-300"
                              :href="route('admin.complaints.index')">
                            Жалобы
                        </Link>
                    </div>
                    <div>
                        <Link class="flex p-4 w-full border-t border-b border-gray-300"
                              :href="route('admin.roles.index')">
                            Роли
                        </Link>
                    </div>
                    <div>
                        <Link class="flex p-4 w-full border-t border-b border-gray-300"
                              :href="route('admin.users.index')">
                            Пользователи
                        </Link>
                    </div>
                </div>
            </div>
            <div class="w-3/4 bg-white p-4 border border-gray-300">
                <slot/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
