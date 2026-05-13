// --- ghost.js ---
const ghost = document.getElementById("ghost");

let windowW = window.innerWidth;
let windowH = window.innerHeight;
let followingMouse = false;

// Recalcular medidas cuando se cambia el tamaño
window.addEventListener("resize", () => {
  windowW = window.innerWidth;
  windowH = window.innerHeight;
});

function randomPos() {
  const x = Math.random() * (windowW - 120);
  const y = Math.random() * (windowH - 120);
  return { x, y };
}

function appearGhost() {
  // Mostrar
  ghost.style.opacity = Math.random() * 0.6 + 0.4; // entre 0.4 y 1
  ghost.style.display = "block";
  ghost.style.pointerEvents = "auto"; // 👈 clickeable

  // Nueva posición
  const { x, y } = randomPos();
  ghost.style.transform = `translate(${x}px, ${y}px)`;

  // A veces seguirá el mouse
  followingMouse = Math.random() > 0.5;

  // Desaparecer después de un rato
  setTimeout(() => {
    ghost.style.opacity = 0;
    ghost.style.pointerEvents = "none"; // 👈 ya no molesta
  }, 4000);
}

// Seguir el mouse si "quiere"
document.addEventListener("mousemove", e => {
  if (followingMouse) {
    ghost.style.transform = `translate(${e.pageX}px, ${e.pageY}px)`;
  }
});

// Hacer que aparezca cada cierto tiempo
setInterval(appearGhost, 8000); // cada 8s