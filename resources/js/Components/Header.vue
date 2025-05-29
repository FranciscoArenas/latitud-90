<template>
  <header
    class="bg-transparent text-white p-2 absolute w-100 top-0 z-50 left-0 right-0">
    <nav class="container mx-auto flex items-center justify-between px-4">
      <div class="flex items-center space-x-2">
        <a
          href="/"
          class="text-lg font-bold">
          <img
            :src="logoSrc"
            alt="Logo Latitud 90"
            class="h-10" />
        </a>
      </div>

      <ul class="hidden md:flex space-x-8">
        <li>
          <a
            href="#"
            class="hover:text-teal-400 transition-colors duration-200"
            >Sobre nosotros</a
          >
        </li>
        <li>
          <a
            href="#"
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
            href="#"
            class="hover:text-teal-400 transition-colors duration-200"
            >Inscripciones</a
          >
        </li>
      </ul>

      <div>
        <button
          class="bg-teal-500 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200 shadow-lg">
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
