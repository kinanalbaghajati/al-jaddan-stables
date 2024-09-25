const nav = gsap.timeline({ paused: true, duration: 0.1 });
const hamburger = document.querySelector(".hamburger input");

nav.from("#mobile-menu", {
  opacity: 0,
  duration: 0.15,
  display: "none",
});
nav.from("#mobile-menu li", {
  x: 100,
  opacity: 0,
  stagger: 0.05,
});
hamburger.addEventListener("change", (ev) => {
  if (!ev.target.checked) nav.reverse();
  else nav.play();
});
