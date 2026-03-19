// GSAP Intro Animation
gsap.from(".hero-text h1", { duration: 1, y: 50, opacity: 0, ease: "power4.out" });
gsap.from("#chef-img", { duration: 1.5, x: 100, opacity: 0, delay: 0.5 });

// Mouse Glow Effect
const chef = document.querySelector("#chef-img");
document.addEventListener("mousemove", (e) => {
    let x = (window.innerWidth / 2 - e.pageX) / 30;
    let y = (window.innerHeight / 2 - e.pageY) / 30;
    chef.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
});