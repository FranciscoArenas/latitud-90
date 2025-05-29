<template>
  <footer
    class="bg-cyan-700 text-white pt-12 pb-8 px-12 sm:px-6 lg:px-12 rounded-b-lg">
    <div class="w-100 mx-12">
      <div
        class="flex flex-col md:flex-row md:justify-between items-center md:items-start mb-8">
        <div class="mb-6 md:mb-0">
          <img
            :src="images['logoSrc']"
            alt="Latitud 90 Logo"
            class="h-16 w-auto" />
        </div>

        <div class="text-center md:text-right w-105 md:w-auto">
          <h3 class="text-xl font-semibold mb-4">
            Suscríbete a nuestro newsletter
          </h3>
          <div
            class="flex flex-col sm:flex-row items-center justify-center md:justify-end relative">
            <input
              type="email"
              placeholder="Ingresa tu email aquí"
              class="sm:w-80 px-4 py-2 rounded-full bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-400 mb-4 sm:mb-0 sm:mr-4 pr-20"
              style="min-width: 300px" />
            <button
              class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-[#26A69A] hover:bg-[#26A69A] text-white font-semibold py-2 px-6 rounded-full transition-colors duration-200">
              Suscríbete
            </button>
          </div>
        </div>
      </div>

      <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8 text-sm items-center">
        <div class="flex justify-center space-x-2">
          <img
            :src="images['arrow']"
            alt="Teléfono"
            class="w-10 h-10" />
          <a
            href="mailto:contacto@latitud90.com"
            class="hover:underline"
            >Email general: <br />
            contacto@latitud90.com</a
          >
        </div>

        <div class="flex justify-center space-x-2">
          <img
            :src="images['arrow']"
            alt="Teléfono"
            class="w-10 h-10" />
          <a
            href="mailto:educacion@latitud90.com"
            class="hover:underline"
            >Viajes de estudio y CEAL: <br />
            educacion@latitud90.com</a
          >
        </div>

        <div class="flex justify-center space-x-2">
          <img
            :src="images['map']"
            alt="Ubicación"
            class="w-10 h-10" />
          <a
            >Ubicación <br />
            Carlos Antúnez 1941, Providencia</a
          >
        </div>

        <div class="flex justify-center space-x-2">
          <img
            :src="images['preguntasFrecuentes']"
            alt="Preguntas Frecuentes"
            class="w-10 h-10" />
          <a
            href="#"
            class="hover:underline"
            >Tienes dudas? <br />
            Haz click aquí</a
          >
        </div>
      </div>

      <hr class="border-t border-teal-700 my-8" />

      <div
        class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-300">
        <p class="mb-4 md:mb-0">
          Copyright © 2025 Latiud90| Términos y condiciones
        </p>
        <div class="flex space-x-4">
          <a
            href="#"
            class="hover:text-white transition-colors duration-200">
            <img
              :src="images['facebookIcon']"
              alt="Facebook"
              class="h-6 w-6" />
          </a>
          <a
            href="#"
            class="hover:text-white transition-colors duration-200">
            <img
              :src="images['twitterIcon']"
              alt="Twitter"
              class="h-6 w-6" />
          </a>
          <a
            href="#"
            class="hover:text-white transition-colors duration-200">
            <img
              :src="images['instagramIcon']"
              alt="Instagram"
              class="h-6 w-6" />
          </a>
          <a
            href="#"
            class="hover:text-white transition-colors duration-200">
            <img
              :src="images['linkedinIcon']"
              alt="LinkedIn"
              class="h-6 w-6" />
          </a>
          <a
            href="#"
            class="hover:text-white transition-colors duration-200">
            <img
              :src="images['youtubeIcon']"
              alt="YouTube"
              class="h-6 w-6" />
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
  import images from "@images/index.js";
</script>

<style scoped></style>
