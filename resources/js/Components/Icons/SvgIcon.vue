<template>
  <component
    :is="iconComponent"
    :width="size"
    :height="size"
    :class="iconClasses"
    v-bind="iconProps" />
</template>

<script setup>
  import { computed } from "vue";
  import * as Icons from "./index.js";

  const props = defineProps({
    // Nombre del icono (ej: 'house', 'backpack', 'school')
    name: {
      type: String,
      required: true
    },
    // Tamaño del icono
    size: {
      type: [String, Number],
      default: 24
    },
    // Color del icono
    color: {
      type: String,
      default: "currentColor"
    },
    // Clases adicionales de Tailwind
    class: {
      type: [String, Array, Object],
      default: ""
    },
    // Props específicas del icono
    strokeWidth: {
      type: [String, Number],
      default: "2"
    },
    // Tipo de color (stroke o fill)
    colorType: {
      type: String,
      default: "stroke", // 'stroke' | 'fill'
      validator: (value) => ["stroke", "fill"].includes(value)
    }
  });

  // Mapear nombres simples a componentes
  const iconMap = {
    house: "HouseIcon",
    backpack: "BackpackIcon",
    school: "SchoolIcon",
    persons: "PersonsIcon",
    edit: "EditIcon",
    plus: "PlusIcon",
    check: "CheckIcon",
    "chevron-left": "ChevronLeftIcon",
    "chevron-right": "ChevronRightIcon",
    "chevron-down": "ChevronDownIcon",
    menu: "MenuIcon",
    calendar: "CalendarIcon",
    exclamation: "ExclamationIcon",
    ayuda: "AyudaIcon"
  };

  const iconComponent = computed(() => {
    const componentName = iconMap[props.name];
    return componentName ? Icons[componentName] : null;
  });

  const iconClasses = computed(() => {
    const baseClasses = "inline-block";
    const colorClass = `text-${props.color.replace("currentColor", "current")}`;

    return typeof props.class === "string"
      ? `${baseClasses} ${colorClass} ${props.class}`.trim()
      : [baseClasses, colorClass, props.class];
  });

  const iconProps = computed(() => {
    const props_obj = {
      strokeWidth: props.strokeWidth
    };

    if (props.colorType === "stroke") {
      props_obj.strokeColor = props.color;
    } else {
      props_obj.fillColor = props.color;
    }

    return props_obj;
  });
</script>
