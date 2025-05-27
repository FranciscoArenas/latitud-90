<template>
  <header
    class="bg-transparent text-white p-4 absolute w-100 top-3 z-50 left-3 right-3">
    <nav class="container mx-auto flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <a
          href="/"
          class="text-lg font-bold">
          <img
            :src="logoSrc"
            alt="Logo"
            class="h-8" />
        </a>
      </div>

      <ul class="flex space-x-8">
        <li>
          <a
            href="#"
            class="hover:text-teal-400 transition-colors duration-200"
            >Sobre nosotros</a
          >
        </li>
        <li>
          <a
            :href="route('ecommerce.find-reservation')"
            class="hover:text-teal-400 transition-colors duration-200"
            >Nuestros programas</a
          >
        </li>
        <li>
          <a
            href="#"
            class="hover:text-teal-400 transition-colors duration-200"
            >Empresas</a
          >
        </li>
        <li>
          <a
            :href="route('login')"
            class="hover:text-teal-400 transition-colors duration-200"
            >Contáctanos</a
          >
        </li>
      </ul>

      <div>
        <button
          class="bg-turquesa text-white font-semibold py-2 px-6 rounded-full transition-colors duration-200 shadow-lg">
          Pagar programa
        </button>
      </div>
    </nav>
  </header>
</template>

<script setup>
  import logoSrc from "@images/logo.svg";
</script>

<style scoped></style>
