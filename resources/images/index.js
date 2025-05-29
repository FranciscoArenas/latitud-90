const images = {};

// Importar todas las imágenes SVG de la carpeta
const modules = import.meta.glob("./*.svg", { eager: true });

// Procesar cada módulo importado
Object.entries(modules).forEach(([path, module]) => {
  // Extraer el nombre del archivo sin extensión ni ruta
  const fileName = path.replace("./", "").replace(/\.\w+$/, "");
  images[fileName] = module.default;
});

export default images;
