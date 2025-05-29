<template>
  <section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-teal-600 mb-12">
        Colegios que nos acompañan
      </h2>

      <div
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-6">
        <div
          v-for="(school, index) in schools"
          :key="index"
          class="flex flex-col items-center">
          <div
            class="bg-white rounded-full p-3 shadow-sm flex items-center justify-center h-24 w-24">
            <img
              :src="school.logo"
              :alt="school.name"
              class="h-16 w-16 object-contain" />
          </div>
          <p class="text-xs text-gray-600 mt-2 text-center">
            {{ school.name }}
          </p>
        </div>
      </div>

      <!-- Indicadores de paginación -->
      <div class="flex justify-center mt-8 gap-1">
        <button class="h-2 w-2 rounded-full bg-teal-500"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300"></button>
        <button class="h-2 w-2 rounded-full bg-gray-300"></button>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    name: "SchoolsSection",
    data() {
      return {
        schools: [
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school1.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school2.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school3.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school4.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school5.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school6.png"
          },
          {
            name: "Nombre de colegio",
            logo: "/resources/images/schools/school7.png"
          }
        ]
      };
    }
  };
</script>
