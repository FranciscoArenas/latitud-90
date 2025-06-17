<script setup>
  import Checkbox from "@/Components/Checkbox.vue";
  import GuestLayout from "@/Layouts/GuestLayout.vue";
  import InputError from "@/Components/InputError.vue";
  import InputLabel from "@/Components/InputLabel.vue";
  import PrimaryButton from "@/Components/PrimaryButton.vue";
  import TextInput from "@/Components/TextInput.vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";

  defineProps({
    canResetPassword: {
      type: Boolean
    },
    status: {
      type: String
    }
  });

  const form = useForm({
    email: "",
    password: "",
    remember: false
  });

  const submit = () => {
    form.post(route("login"), {
      onFinish: () => form.reset("password")
    });
  };
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div
      v-if="status"
      class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel
          for="email"
          value="Email" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username" />

        <InputError
          class="mt-2"
          :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password"
          value="Password" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password" />

        <InputError
          class="mt-2"
          :message="form.errors.password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox
            name="remember"
            v-model:checked="form.remember" />
          <span class="ms-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex-row items-center justify-end mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-100 flex">
          Forgot your password?
        </Link>
        <PrimaryButton
          class="ms-4 bg-turquesa w-100 flex w-full text-center justify-center mx-0 my-5 ms-0 rounded-3xl"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing">
          Iniciar sesión
        </PrimaryButton>
        <Link
          :href="route('register')"
          class="text-sm text-turquesa hover:text-white rounded-3xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 px-4 py-2 bg-white hover:bg-turquesa border-turquesa border-solid-2 border-2 w-100 flex text-center justify-center">
          Crear cuenta
        </Link>
      </div>
    </form>
  </GuestLayout>
</template>
