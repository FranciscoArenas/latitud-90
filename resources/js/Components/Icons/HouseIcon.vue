<template>
  <svg
    :width="width"
    :height="height"
    :class="classes"
    viewBox="0 0 46 46"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
      fill-rule="evenodd"
      clip-rule="evenodd"
      :fill="fillColor"
      d="M9.72418 36.0348V19.55C9.72418 19.0645 9.83292 18.6049 10.0504 18.1712C10.2679 17.7375 10.5675 17.3803 10.9494 17.0997L21.1623 9.36552C21.6971 8.95713 22.3078 8.75293 22.9944 8.75293C23.6809 8.75293 24.2954 8.95713 24.8378 9.36552L35.0507 17.0978C35.4338 17.3784 35.7335 17.7363 35.9497 18.1712C36.1672 18.6049 36.2759 19.0645 36.2759 19.55V36.0348C36.2759 36.5431 36.0869 36.9863 35.7088 37.3643C35.3308 37.7424 34.8876 37.9314 34.3794 37.9314H27.9614C27.5265 37.9314 27.1623 37.7847 26.869 37.4914C26.5757 37.1968 26.429 36.8326 26.429 36.399V27.3543C26.429 26.9206 26.2823 26.5571 25.989 26.2638C25.6944 25.9692 25.3303 25.8219 24.8966 25.8219H21.1035C20.6698 25.8219 20.3063 25.9692 20.013 26.2638C19.7184 26.5571 19.5711 26.9206 19.5711 27.3543V36.4009C19.5711 36.8345 19.4244 37.198 19.1311 37.4914C18.8377 37.7847 18.4742 37.9314 18.0406 37.9314H11.6207C11.1125 37.9314 10.6693 37.7424 10.2913 37.3643C9.9132 36.9863 9.72418 36.5431 9.72418 36.0348Z" />
  </svg>
</template>

<script setup>
  import { computed } from "vue";

  const props = defineProps({
    width: {
      type: [String, Number],
      default: 28
    },
    height: {
      type: [String, Number],
      default: 30
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
