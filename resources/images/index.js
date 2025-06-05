const images = {};

// Importar todas las imágenes de la carpeta principal y subcarpetas
const modules = import.meta.glob(
  [
    "./*.{svg,png,jpg,jpeg}",
    "./experiences/*.{svg,png,jpg,jpeg}",
    "./programs/*.{svg,png,jpg,jpeg}",
    "./schools/*.{svg,png,jpg,jpeg}"
  ],
  { eager: true }
);

// Procesar cada módulo importado
Object.entries(modules).forEach(([path, module]) => {
  // Extraer el nombre del archivo sin extensión ni ruta
  const fileName = path.replace("./", "").replace(/\.\w+$/, "");

  // Para archivos en subcarpetas, crear una estructura anidada
  if (fileName.includes("/")) {
    const parts = fileName.split("/");
    const folder = parts[0];
    const file = parts[1];

    if (!images[folder]) {
      images[folder] = {};
    }
    images[folder][file] = module.default;
  } else {
    images[fileName] = module.default;
  }
});

export default images;
