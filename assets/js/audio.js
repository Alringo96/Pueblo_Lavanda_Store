// --- audio.js ---
/* IDs esperados en el DOM:
   #toggleMusic, #musicIcon, #bgMusic, #ghostSound, #ghost, #ghostPopup, #ghostMessage, #closePopup
   Asegúrate de incluir este script **después** del HTML que contiene esos elementos.
*/

const musicBtn   = document.getElementById('toggleMusic');
const musicIcon  = document.getElementById('musicIcon');
const bgMusic    = document.getElementById('bgMusic');
const ghostSound = document.getElementById('ghostSound');
const ghostEl    = document.getElementById('ghost');

// popup elementos
const ghostPopup   = document.getElementById('ghostPopup');
const ghostMessage = document.getElementById('ghostMessage');
const closePopup   = document.getElementById('closePopup');

if (!musicBtn || !musicIcon || !bgMusic) {
  console.warn('audio.js: faltan elementos de audio en el DOM (toggleMusic / musicIcon / bgMusic)');
}

// bandera para evitar otorgar el premio más de una vez
let descuentoActivo = false;

// Toggle música ON/OFF (volume icons: bi-volume-off / bi-volume-up)
if (musicBtn) {
  musicBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (!bgMusic) {
      console.warn('audio.js: #bgMusic no encontrado.');
      return;
    }

    if (bgMusic.paused) {
      bgMusic.play()
        .then(() => {
          if (musicIcon) {
            musicIcon.classList.remove('bi-volume-off');
            musicIcon.classList.add('bi-volume-up');
          }
        })
        .catch(err => {
          console.error('audio.js: error al reproducir bgMusic:', err);
        });
    } else {
      bgMusic.pause();
      if (musicIcon) {
        musicIcon.classList.remove('bi-volume-up');
        musicIcon.classList.add('bi-volume-off');
      }
    }
  });
}

// Click en el fantasma → efecto sonoro + premio
if (ghostEl) {
  ghostEl.addEventListener('click', () => {
    if (descuentoActivo) return;

    if (ghostSound) {
      ghostSound.play().catch(err => console.error('audio.js: error al reproducir ghostSound:', err));
    } else {
      console.warn('audio.js: #ghostSound no encontrado.');
    }

    // Mostrar popup personalizado en lugar de alert
    if (ghostPopup && ghostMessage) {
      ghostMessage.textContent = "👻 ¡Un espíritu te ha seguido!... En lugar de asustarte, te concede un 5% de descuento en tu carrito.";
      ghostPopup.style.display = "flex";
    } else {
      console.warn('audio.js: popup del fantasma no encontrado en el DOM.');
    }

    descuentoActivo = true;
    localStorage.setItem('descuentoFantasma', '5');
    console.log('audio.js: descuentoFantasma guardado en localStorage');
  });
} else {
  console.warn('audio.js: #ghost no encontrado. El click no funcionará.');
}

// Cerrar popup
if (closePopup && ghostPopup) {
  closePopup.addEventListener('click', () => {
    ghostPopup.style.display = "none";
  });
}
