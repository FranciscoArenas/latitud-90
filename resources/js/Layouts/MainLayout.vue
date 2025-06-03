<template>
  <div>
    <!-- Header -->
    <Header
      :logo="true"
      class="bg-blanco text-gris-1 relative w-[96%] rounded-2xl mx-auto" />

    <!-- Contenido principal -->
    <main>
      <slot></slot>
    </main>

    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>

<script setup>
  import Header from "@/Components/Header.vue";
  import { ref } from "vue";
  import Footer from "@/Components/Footer.vue";
  import logoSrc from "@images/logo.svg";
</script>
