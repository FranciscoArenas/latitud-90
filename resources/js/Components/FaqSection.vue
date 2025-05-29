<template>
  <section class="py-12 bg-teal-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-white mb-12">Preguntas frecuentes</h2>

      <div class="max-w-3xl mx-auto space-y-4">
        <!-- FAQ Item 1 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(0)">
            <span class="text-teal-600 font-medium"
              >¿Cómo solicito el descuento de hermanas mellizas o gemelas?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 0 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 0"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              Puedes solicitar el descuento contactando a nuestro servicio de
              atención al cliente con la documentación necesaria que acredite el
              parentesco.
            </p>
          </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(1)">
            <span class="text-teal-600 font-medium"
              >¿Cómo activar los costos para el pago mensual con tarjeta de
              débito o transferencia electrónica a través de la tarjeta
              online?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 1 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 1"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              En caso de elegir esta opción de pago debes escribir a
              pagos@latitud90.com
            </p>
          </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(2)">
            <span class="text-teal-600 font-medium"
              >¿Cómo puedo confirmar que he pagado?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 2 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 2"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              Recibirás un correo electrónico de confirmación una vez que tu
              pago haya sido procesado correctamente.
            </p>
          </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(3)">
            <span class="text-teal-600 font-medium"
              >¿Un caso de no ser apoderado o representante legal puede
              pagar?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 3 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 3"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              Sí, cualquier persona puede realizar el pago en nombre del
              estudiante, solo necesitarás proporcionar la información del
              alumno en el proceso de pago.
            </p>
          </div>
        </div>

        <!-- FAQ Item 5 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(4)">
            <span class="text-teal-600 font-medium"
              >¿Hasta cuándo tengo plazo para pagar el viaje de estudios?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 4 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 4"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              El plazo de pago depende de las condiciones específicas de cada
              viaje. Te recomendamos revisar la información proporcionada por tu
              colegio o contactar directamente con nuestro equipo de atención al
              cliente.
            </p>
          </div>
        </div>

        <!-- FAQ Item 6 -->
        <div class="bg-white rounded-lg overflow-hidden">
          <button
            class="flex items-center justify-between w-full p-4 text-left"
            @click="toggleFaq(5)">
            <span class="text-teal-600 font-medium"
              >¿Qué pasa si la operación del pago con mi tarjeta de débito o
              transferencia bajó de normeno?</span
            >
            <svg
              :class="{ 'rotate-180': openFaq === 5 }"
              class="h-5 w-5 text-teal-600 transform transition-transform duration-200"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div
            v-if="openFaq === 5"
            class="p-4 pt-0 bg-white">
            <p class="text-gray-600">
              Si experimentas problemas con tu pago, por favor comunícate
              inmediatamente con nuestro equipo de soporte a través de
              pagos@latitud90.com para que podamos ayudarte a resolverlo.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    name: "FaqSection",
    data() {
      return {
        openFaq: null,
        faqs: [
          {
            question:
              "¿Cómo solicito el descuento de hermanas mellizas o gemelas?",
            answer:
              "Puedes solicitar el descuento contactando a nuestro servicio de atención al cliente con la documentación necesaria que acredite el parentesco."
          },
          {
            question:
              "¿Cómo activar los costos para el pago mensual con tarjeta de débito o transferencia electrónica a través de la tarjeta online?",
            answer:
              "En caso de elegir esta opción de pago debes escribir a pagos@latitud90.com"
          },
          {
            question: "¿Cómo puedo confirmar que he pagado?",
            answer:
              "Recibirás un correo electrónico de confirmación una vez que tu pago haya sido procesado correctamente."
          },
          {
            question:
              "¿Un caso de no ser apoderado o representante legal puede pagar?",
            answer:
              "Sí, cualquier persona puede realizar el pago en nombre del estudiante, solo necesitarás proporcionar la información del alumno en el proceso de pago."
          },
          {
            question:
              "¿Hasta cuándo tengo plazo para pagar el viaje de estudios?",
            answer:
              "El plazo de pago depende de las condiciones específicas de cada viaje. Te recomendamos revisar la información proporcionada por tu colegio o contactar directamente con nuestro equipo de atención al cliente."
          },
          {
            question:
              "¿Qué pasa si la operación del pago con mi tarjeta de débito o transferencia bajó de normeno?",
            answer:
              "Si experimentas problemas con tu pago, por favor comunícate inmediatamente con nuestro equipo de soporte a través de pagos@latitud90.com para que podamos ayudarte a resolverlo."
          }
        ]
      };
    },
    methods: {
      toggleFaq(index) {
        this.openFaq = this.openFaq === index ? null : index;
      }
    }
  };
</script>
