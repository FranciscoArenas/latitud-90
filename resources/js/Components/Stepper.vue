<template>
  <!-- Título y pasos -->
  <div class="lg:col-span-6 mb-8 px-4">
    <h1 class="text-center text-2xl sm:text-3xl font-semibold text-gray-800">
      {{ tittle }}
    </h1>

    <!-- Indicadores de pasos -->
    <div class="mx-auto w-full max-w-2xl px-4 pb-10">
      <div
        class="relative mt-14 flex justify-between before:absolute before:top-1/2 before:left-0 before:h-1 before:w-full before:bg-slate-200 before:transform before:-translate-y-1/2">
        <div
          v-for="({ step, label }, index) in steps"
          :key="step"
          class="relative z-10">
          <div
            :class="[
              'flex w-10 h-10 items-center justify-center rounded-full border-2 border-zinc-200  transition-all delay-200 ease-in',
              activeStep == step ? 'border-slate-400 bg-turquesa' : 'bg-gris-4'
            ]">
            <span
              class="text-white text-lg"
              :class="[
                activeStep == step
                  ? 'font-semibold  bg-turquesa'
                  : 'font-medium '
              ]">
              {{ step }}
            </span>
          </div>
          <div
            class="absolute top-14 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <span
              class="text-sm font-semibold text-zinc-400 whitespace-nowrap"
              >{{ label }}</span
            >
          </div>
        </div>
        <div
          class="absolute top-1/2 left-0 h-1 bg-turquesa transition-all delay-200 ease-in transform -translate-y-1/2"
          :style="{ width: progressWidth }"></div>
      </div>
    </div>
  </div>
</template>
<script setup>
  import { defineProps, computed, ref } from "vue";
  const props = defineProps({
    step: {
      type: Number,
      required: true
    },
    tittle: {
      type: String,
      default: "Selecciona el método de pago"
    }
  });
  // Configuración de pasos
  const steps = [
    { step: 1, label: "Selecciona viaje a pagar" },
    { step: 2, label: "Selecciona método de pago" },
    { step: 3, label: "Completar pago" },
    { step: 4, label: "Pagar programa" }
  ];
  const activeStep = ref(props.step); // Paso actual
  // Calcular ancho de progreso
  const progressWidth = computed(() => {
    const progress = ((activeStep.value - 1) / (steps.length - 1)) * 100;
    return `${progress}%`;
  });
</script>
