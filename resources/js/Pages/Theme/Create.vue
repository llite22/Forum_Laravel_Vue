<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
  name: "Create",

  props: [
    'branch',
  ],

  data() {
    return {
      title: '',
      description: '',
    }
  },

  components: {
    TextInput,
    InputError,
    Link
  },

  methods: {
    store() {
      this.$inertia.post('/themes', {
        title: this.title,
        description: this.description,
        branch_id: this.branch.id
      })
    },
  },

  layout: MainLayout
}
</script>

<template>
  <div>
    <div class="flex flex-col gap-2 mb-4">
      <h3 class="text-xl">Добавить тему</h3>
      <div>
        <div class="mb-4">
          <TextInput placeholder="Заголовок" type="text" v-model="title" class="border-gray-300 p-2 w-1/2"/>
          <InputError :message="$page.props.errors.title"/>
        </div>
        <div class="mb-4">
          <textarea placeholder="Описание" type="text" v-model="description" class="border-gray-300 p-2 w-1/2">

          </textarea>
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
