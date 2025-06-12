<template>
  <svg
    :width="width"
    :height="height"
    :class="classes"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      :stroke-width="strokeWidth"
      :stroke="strokeColor"
      d="M9 5l7 7-7 7" />
  </svg>
</template>

<script setup>
  import { computed } from "vue";

  const props = defineProps({
    width: {
      type: [String, Number],
      default: 24
    },
    height: {
      type: [String, Number],
      default: 24
    },
    strokeColor: {
      type: String,
      default: "currentColor"
    },
    strokeWidth: {
      type: [String, Number],
      default: "2"
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
