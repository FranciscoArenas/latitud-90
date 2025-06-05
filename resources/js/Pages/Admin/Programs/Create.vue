<template>
  <AdminLayout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
              Crear Programa
            </h3>
            <p class="mt-1 text-sm text-gray-600">
              Crea un nuevo programa de viaje, tour, excursión, intercambio o
              crucero.
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form
            @submit.prevent="submit"
            enctype="multipart/form-data">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <!-- Información básica -->
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <label
                      for="name"
                      class="block text-sm font-medium text-gray-700"
                      >Nombre del Programa</label
                    >
                    <input
                      type="text"
                      id="name"
                      v-model="form.name"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{ 'border-red-500': form.errors.name }" />
                    <div
                      v-if="form.errors.name"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.name }}
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="service_type"
                      class="block text-sm font-medium text-gray-700"
                      >Tipo de Servicio</label
                    >
                    <select
                      id="service_type"
                      v-model="form.service_type"
                      class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      :class="{ 'border-red-500': form.errors.service_type }">
                      <option value="">Seleccionar tipo</option>
                      <option value="tours">Tours</option>
                      <option value="excursiones">Excursiones</option>
                      <option value="intercambio">Intercambio</option>
                      <option value="cruceros">Cruceros</option>
                    </select>
                    <div
                      v-if="form.errors.service_type"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.service_type }}
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="destination"
                      class="block text-sm font-medium text-gray-700"
                      >Destino</label
                    >
                    <input
                      type="text"
                      id="destination"
                      v-model="form.destination"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{ 'border-red-500': form.errors.destination }" />
                    <div
                      v-if="form.errors.destination"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.destination }}
                    </div>
                  </div>

                  <div class="col-span-6">
                    <label
                      for="description"
                      class="block text-sm font-medium text-gray-700"
                      >Descripción</label
                    >
                    <textarea
                      id="description"
                      v-model="form.description"
                      rows="4"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{
                        'border-red-500': form.errors.description
                      }"></textarea>
                    <div
                      v-if="form.errors.description"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.description }}
                    </div>
                  </div>
                </div>

                <!-- Fechas y duración -->
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-2">
                    <label
                      for="departure_date"
                      class="block text-sm font-medium text-gray-700"
                      >Fecha de Salida</label
                    >
                    <input
                      type="date"
                      id="departure_date"
                      v-model="form.departure_date"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{
                        'border-red-500': form.errors.departure_date
                      }" />
                    <div
                      v-if="form.errors.departure_date"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.departure_date }}
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label
                      for="return_date"
                      class="block text-sm font-medium text-gray-700"
                      >Fecha de Regreso</label
                    >
                    <input
                      type="date"
                      id="return_date"
                      v-model="form.return_date"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{ 'border-red-500': form.errors.return_date }" />
                    <div
                      v-if="form.errors.return_date"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.return_date }}
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label
                      for="duration_days"
                      class="block text-sm font-medium text-gray-700"
                      >Duración (días)</label
                    >
                    <input
                      type="number"
                      id="duration_days"
                      v-model="form.duration_days"
                      min="1"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{
                        'border-red-500': form.errors.duration_days
                      }" />
                    <div
                      v-if="form.errors.duration_days"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.duration_days }}
                    </div>
                  </div>
                </div>

                <!-- Capacidad y precio -->
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="capacity"
                      class="block text-sm font-medium text-gray-700"
                      >Capacidad (personas)</label
                    >
                    <input
                      type="number"
                      id="capacity"
                      v-model="form.capacity"
                      min="1"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{ 'border-red-500': form.errors.capacity }" />
                    <div
                      v-if="form.errors.capacity"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.capacity }}
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                      for="base_price"
                      class="block text-sm font-medium text-gray-700"
                      >Precio Base (CLP)</label
                    >
                    <input
                      type="number"
                      id="base_price"
                      v-model="form.base_price"
                      min="0"
                      step="0.01"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      :class="{ 'border-red-500': form.errors.base_price }" />
                    <div
                      v-if="form.errors.base_price"
                      class="mt-2 text-sm text-red-600">
                      {{ form.errors.base_price }}
                    </div>
                  </div>
                </div>

                <!-- Imagen -->
                <div>
                  <label class="block text-sm font-medium text-gray-700"
                    >Imagen del Programa</label
                  >
                  <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                      <div
                        v-if="imagePreview"
                        class="mb-4">
                        <img
                          :src="imagePreview"
                          alt="Preview"
                          class="mx-auto h-32 w-auto object-cover rounded-lg" />
                      </div>
                      <svg
                        v-else
                        class="mx-auto h-12 w-12 text-gray-400"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 48 48">
                        <path
                          d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>
                      <div class="flex text-sm text-gray-600">
                        <label
                          for="image"
                          class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                          <span>Subir imagen</span>
                          <input
                            id="image"
                            type="file"
                            accept="image/*"
                            class="sr-only"
                            @change="handleImageChange" />
                        </label>
                        <p class="pl-1">o arrastrar y soltar</p>
                      </div>
                      <p class="text-xs text-gray-500">
                        PNG, JPG, GIF hasta 2MB
                      </p>
                    </div>
                  </div>
                  <div
                    v-if="form.errors.image"
                    class="mt-2 text-sm text-red-600">
                    {{ form.errors.image }}
                  </div>
                </div>

                <!-- Información adicional -->
                <div class="space-y-4">
                  <div>
                    <label
                      for="includes"
                      class="block text-sm font-medium text-gray-700"
                      >Incluye</label
                    >
                    <textarea
                      id="includes"
                      v-model="form.includes"
                      rows="3"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      placeholder="Servicios incluidos en el programa..."></textarea>
                  </div>

                  <div>
                    <label
                      for="excludes"
                      class="block text-sm font-medium text-gray-700"
                      >No Incluye</label
                    >
                    <textarea
                      id="excludes"
                      v-model="form.excludes"
                      rows="3"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      placeholder="Servicios no incluidos..."></textarea>
                  </div>

                  <div>
                    <label
                      for="requirements"
                      class="block text-sm font-medium text-gray-700"
                      >Requisitos</label
                    >
                    <textarea
                      id="requirements"
                      v-model="form.requirements"
                      rows="3"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      placeholder="Requisitos para participar..."></textarea>
                  </div>

                  <div>
                    <label
                      for="itinerary"
                      class="block text-sm font-medium text-gray-700"
                      >Itinerario</label
                    >
                    <textarea
                      id="itinerary"
                      v-model="form.itinerary"
                      rows="4"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      placeholder="Descripción detallada del itinerario..."></textarea>
                  </div>
                </div>

                <!-- Estado activo -->
                <div class="flex items-center">
                  <input
                    id="active"
                    v-model="form.active"
                    type="checkbox"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                  <label
                    for="active"
                    class="ml-2 block text-sm text-gray-900">
                    Programa activo (visible para los clientes)
                  </label>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <Link
                  :href="route('admin.programs.index')"
                  class="mr-3 bg-white border border-gray-300 rounded-md py-2 px-4 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Cancelar
                </Link>
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="bg-indigo-600 border border-transparent rounded-md py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                  {{ form.processing ? "Creando..." : "Crear Programa" }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
  import { ref } from "vue";
  import { Link, useForm } from "@inertiajs/vue3";
  import AdminLayout from "@/Layouts/AdminLayout.vue";

  const imagePreview = ref(null);

  const form = useForm({
    name: "",
    description: "",
    service_type: "",
    destination: "",
    departure_date: "",
    return_date: "",
    duration_days: "",
    capacity: "",
    base_price: "",
    includes: "",
    excludes: "",
    requirements: "",
    itinerary: "",
    image: null,
    active: true
  });

  const handleImageChange = (event) => {
    const file = event.target.files[0];
    if (file) {
      form.image = file;
      const reader = new FileReader();
      reader.onload = (e) => {
        imagePreview.value = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  };

  const submit = () => {
    form.post(route("admin.programs.store"), {
      onSuccess: () => {
        // Redirige automáticamente después del éxito
      }
    });
  };
</script>
