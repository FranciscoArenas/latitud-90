<template>
  <section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
      <!-- Título de la sección con estilo especial -->
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-light text-gray-800">
          Transformamos
          <span
            class="inline-block bg-yellow-100 rounded-full px-3 py-1 text-gray-700"
            >cada experiencia</span
          >
          <br class="hidden sm:block" />
          en un programa único, fomentando la
          <span class="text-teal-600 font-medium">conexión, respeto</span>
          <br class="hidden sm:block" />
          y la
          <span
            class="inline-block bg-pink-100 rounded-full px-3 py-1 text-gray-700"
            >exploración.</span
          >
        </h2>
      </div>

      <!-- Sección "Sobre Latitud 90" -->
      <div class="mb-16">
        <h3 class="text-2xl text-teal-600 font-semibold mb-6">
          Sobre Latitud 90
        </h3>
        <div class="grid md:grid-cols-2 gap-8">
          <div>
            <p class="text-gray-700 mb-4">
              Con más de 25 años de experiencia, somos una empresa apasionada
              por Chile, su gente y sus paisajes. Creamos experiencias únicas a
              través de viajes educativos, culturales y corporativos, siempre
              conectando con la naturaleza y respetando el medio ambiente.
            </p>
            <p class="text-gray-700">
              Nuestro equipo diseña vivencias inolvidables, combinando
              aprendizaje, diversión y respeto por el entorno, adaptándolas a
              empresas, colegios, adultos mayores y familias.
            </p>
          </div>
          <div>
            <p class="text-gray-700 mb-4">
              A lo largo de los años, hemos inspirado a miles de personas,
              promoviendo la trascendencia y excelencia en cada programa.
            </p>
            <a
              href="#"
              class="inline-block mt-2 px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors"
              >Descubre más en nuestra web</a
            >
          </div>
        </div>
      </div>

      <!-- Cards de Propósito, Misión, Valores y Sostenibilidad -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Propósito -->
        <div
          class="bg-white rounded-lg p-6 shadow-md border-t-4 border-teal-500">
          <div class="flex justify-center mb-4">
            <div class="bg-teal-500 rounded-full p-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
          </div>
          <h4 class="text-xl font-semibold text-center mb-3">Propósito</h4>
          <p class="text-center text-gray-600">
            Inspirar a niños para la aventura, explorar y fortalecer el
            compañerismo en cada viaje
          </p>
          <div class="mt-4 border-t border-orange-300 pt-3">
            <div class="h-1 bg-orange-300 rounded"></div>
          </div>
        </div>

        <!-- Misión -->
        <div
          class="bg-white rounded-lg p-6 shadow-md border-t-4 border-teal-500">
          <div class="flex justify-center mb-4">
            <div class="bg-teal-500 rounded-full p-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
              </svg>
            </div>
          </div>
          <h4 class="text-xl font-semibold text-center mb-3">Misión</h4>
          <p class="text-center text-gray-600">
            Crear experiencias únicas de aprendizaje y entretenimiento a través
            de programas innovadores
          </p>
          <div class="mt-4 border-t border-orange-300 pt-3">
            <div class="h-1 bg-orange-300 rounded"></div>
          </div>
        </div>

        <!-- Valores -->
        <div
          class="bg-white rounded-lg p-6 shadow-md border-t-4 border-teal-500">
          <div class="flex justify-center mb-4">
            <div class="bg-teal-500 rounded-full p-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
          </div>
          <h4 class="text-xl font-semibold text-center mb-3">Valores</h4>
          <ul class="text-center text-gray-600 space-y-1">
            <li>1. Integridad - lo que somos</li>
            <li>2. Proactividad - siempre adelante</li>
            <li>3. Flexibilidad - el día a día</li>
          </ul>
          <div class="mt-4 border-t border-orange-300 pt-3">
            <div class="h-1 bg-orange-300 rounded"></div>
          </div>
        </div>

        <!-- Sostenibilidad -->
        <div
          class="bg-white rounded-lg p-6 shadow-md border-t-4 border-teal-500">
          <div class="flex justify-center mb-4">
            <div class="bg-teal-500 rounded-full p-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </div>
          </div>
          <h4 class="text-xl font-semibold text-center mb-3">Sostenibilidad</h4>
          <p class="text-center text-gray-600">
            Generamos valor con pasión, velando por el impacto social, ambiental
            y calidad de personas
          </p>
          <div class="mt-4 border-t border-orange-300 pt-3">
            <div class="h-1 bg-orange-300 rounded"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
  // No se requiere lógica adicional para este componente
</script>

<style scoped>
  /* Puedes añadir estilos específicos si son necesarios */
</style>
