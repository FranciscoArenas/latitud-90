<template>
  <div class="background-pattern-container">
    <AyudaIcon
      class="background-pattern"
      :width="width"
      :height="height"
      :opacity="opacity"
      :backgroundColor="backgroundColor"
      :patternColor1="patternColor1"
      :patternColor2="patternColor2"
      :patternColor3="patternColor3"
      :patternColor4="patternColor4"
      :patternColor5="patternColor5" />
    <div class="content">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
  import AyudaIcon from "@/Components/Icons/AyudaIcon.vue";

  defineProps({
    width: {
      type: [String, Number],
      default: "100%"
    },
    height: {
      type: [String, Number],
      default: "100%"
    },
    opacity: {
      type: [String, Number],
      default: 0.1
    },
    backgroundColor: {
      type: String,
      default: "#F9F9F9"
    },
    patternColor1: {
      type: String,
      default: "#D54B44"
    },
    patternColor2: {
      type: String,
      default: "#FBBD51"
    },
    patternColor3: {
      type: String,
      default: "#4B8D7F"
    },
    patternColor4: {
      type: String,
      default: "#1A4B75"
    },
    patternColor5: {
      type: String,
      default: "#007E93"
    }
  });
</script>

<style scoped>
  .background-pattern-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .background-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }

  .content {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
  }
</style>
