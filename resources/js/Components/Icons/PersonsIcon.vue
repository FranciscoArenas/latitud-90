<template>
  <svg
    :width="width"
    :height="height"
    :class="classes"
    viewBox="0 0 46 47"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
      d="M17.3103 25.2066C21.5001 25.2066 24.8965 21.8101 24.8965 17.6204C24.8965 13.4306 21.5001 10.0342 17.3103 10.0342C13.1206 10.0342 9.72412 13.4306 9.72412 17.6204C9.72412 21.8101 13.1206 25.2066 17.3103 25.2066Z"
      :stroke="strokeColor"
      :stroke-width="strokeWidth"
      stroke-linecap="round"
      stroke-linejoin="round" />
    <path
      d="M30.5862 36.5859C30.5862 30.3007 24.6424 25.2066 17.3103 25.2066C9.97828 25.2066 4.03448 30.3007 4.03448 36.5859M28.6897 25.2066C29.9573 25.2065 31.2047 24.8888 32.3179 24.2825C33.4311 23.6761 34.3746 22.8005 35.0623 21.7356C35.7499 20.6707 36.1597 19.4504 36.2543 18.1863C36.3489 16.9222 36.1252 15.6546 35.6036 14.4992C35.0821 13.3439 34.2794 12.3376 33.2688 11.5724C32.2582 10.8072 31.0719 10.3074 29.8184 10.1187C28.5649 9.93001 27.2841 10.0584 26.093 10.4923C24.9019 10.9261 23.8385 11.6515 23 12.6021"
      :stroke="strokeColor"
      :stroke-width="strokeWidth"
      stroke-linecap="round"
      stroke-linejoin="round" />
    <path
      d="M41.9655 36.5858C41.9655 30.3006 36.0217 25.2065 28.6897 25.2065C27.1591 25.2065 24.7012 24.6508 23 22.8643"
      :stroke="strokeColor"
      :stroke-width="strokeWidth"
      stroke-linecap="round"
      stroke-linejoin="round" />
  </svg>
</template>

<script setup>
  import { computed } from "vue";

  const props = defineProps({
    width: {
      type: [String, Number],
      default: 46
    },
    height: {
      type: [String, Number],
      default: 47
    },
    strokeColor: {
      type: String,
      default: "currentColor"
    },
    strokeWidth: {
      type: [String, Number],
      default: "3.7931"
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
