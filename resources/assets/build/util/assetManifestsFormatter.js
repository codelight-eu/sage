const path = require('path');

module.exports = (key, value) => {
  if (typeof value === 'string') {
    return value;
  }
  const manifest = value;

  Object.keys(manifest).forEach((src) => {
    const sourcePath = path.basename(path.dirname(src));
    const targetPath = path.basename(path.dirname(manifest[src]));

    if (src.toLowerCase().startsWith('svg-sprites')) {
      /**
      * Hack to remove cachebuster from svg-sprites manifest key
      * see this: https://github.com/kisenka/svg-sprite-loader/issues/166 
      *
      * This might need to be reworked at some point.
      *
      * Before:
      *   {
      *     "svg-sprites/sprites_abcdef.svg": "svg-sprites/sprites_abcdef.svg"
      *   }
      * After:
      *   {
      *     "svg-sprites/sprites.svg": "svg-sprites/sprites_abcdef.svg"
      *   }
      */
      let newSrc = src.replace(/_.*\./, '.');
      manifest[newSrc] = manifest[src];
      delete manifest[src];
    } else if (sourcePath === targetPath) {
      return;
    } else {
      /**
      * Hack to prepend scripts/ or styles/ to manifest keys
      *
      * This might need to be reworked at some point.
      *
      * Before:
      *   {
      *     "main.js": "scripts/main_abcdef.js"
      *     "main.css": "styles/main_abcdef.css"
      *   }
      * After:
      *   {
      *     "scripts/main.js": "scripts/main_abcdef.js"
      *     "styles/main.css": "styles/main_abcdef.css"
      *   }
      */
      manifest[`${targetPath}/${src}`] = manifest[src];
      delete manifest[src];
    }
  });
  return manifest;
};
