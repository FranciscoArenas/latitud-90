<template>
  <header class="absolute top-0 z-50 shadow-lg w-full">
    <nav
      class="flex items-center justify-between mx-auto px-6 md:px-16 lg:px-24 xl:px-[90px] h-[104px] max-w-[1380px] w-full rounded-[20px]shadow-md">
      <div class="flex items-center">
        <a
          href="/"
          class="text-lg font-bold">
          <img
            :src="[!logo ? logoSrc : logoColorSrc]"
            alt="Logo Latitud 90"
            class="h-12" />
        </a>
      </div>

      <!-- Botón menú móvil -->
      <button
        @click="toggleMobileMenu"
        class="md:hidden flex items-center p-2 rounded-md hover:bg-gray-100">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <ul class="hidden md:flex space-x-6 lg:space-x-8">
        <li>
          <a
            href="#"
            class="hover:text-teal-500 font-medium transition-colors duration-200"
            >Sobre nosotros</a
          >
        </li>
        <li>
          <a
            href="#"
            class="hover:text-teal-500 font-medium transition-colors duration-200"
            >Nuestros programas</a
          >
        </li>
        <li>
          <a
            href="#"
            class="hover:text-teal-500 font-medium transition-colors duration-200"
            >Empresas</a
          >
        </li>
        <li>
          <a
            href="#"
            class="hover:text-teal-500 font-medium transition-colors duration-200"
            >Inscripciones</a
          >
        </li>
      </ul>

      <div class="hidden md:block">
        <button
          class="bg-teal-500 text-blanco hover:bg-teal-600 font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-md">
          Pagar programa
        </button>
      </div>
    </nav>

    <!-- Menú móvil -->
    <transition name="mobile-menu">
      <div
        v-if="mobileMenuOpen"
        class="fixed inset-0 z-50 bg-white mt-[104px]">
        <div class="container mx-auto px-6 py-8">
          <ul class="space-y-6">
            <li>
              <a
                href="#"
                class="hover:text-teal-500 font-medium text-lg block"
                >Sobre nosotros</a
              >
            </li>
            <li>
              <a
                href="#nuestrosProgramas"
                class="hover:text-teal-500 font-medium text-lg block"
                >Nuestros programas</a
              >
            </li>
            <li>
              <a
                href="#"
                class="hover:text-teal-500 font-medium text-lg block"
                >Empresas</a
              >
            </li>
            <li>
              <a
                href="#"
                class="hover:text-teal-500 font-medium text-lg block"
                >Inscripciones</a
              >
            </li>
            <li class="pt-4">
              <button
                class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-6 w-full rounded-lg transition-all duration-200 shadow-md">
                Pagar programa
              </button>
            </li>
          </ul>
        </div>
      </div>
    </transition>
  </header>
</template>

<script setup>
  import logoSrc from "@images/logo.svg";
  import logoColorSrc from "@images/logo-color.svg";
  import { ref } from "vue";

  defineProps({
    logo: {
      type: Boolean,
      required: true
    }
  });
  const mobileMenuOpen = ref(false);

  const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
  };
</script>

<style scoped>
  .mobile-menu-enter-active,
  .mobile-menu-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
  }

  .mobile-menu-enter-from,
  .mobile-menu-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }
</style>
