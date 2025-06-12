<template>
  <svg
    :width="width"
    :height="height"
    :class="classes"
    viewBox="0 0 20 20"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
      fill-rule="evenodd"
      clip-rule="evenodd"
      :fill="fillColor"
      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
  </svg>
</template>

<script setup>
  import { computed } from "vue";

  const props = defineProps({
    width: {
      type: [String, Number],
      default: 20
    },
    height: {
      type: [String, Number],
      default: 20
    },
    fillColor: {
      type: String,
      default: "currentColor"
    },
    class: {
      type: [String, Array, Object],
      default: ""
    }
  });

  const classes = computed(() => {
    const baseClasses = "block";
    return typeof props.class === "string"
      ? `${baseClasses} ${props.class}`.trim()
      : [baseClasses, props.class];
  });
</script>
