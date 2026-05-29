// ================= AOS ANIMATION =================

AOS.init({
    duration: 1000,
    once: true
});


// ================= DARK MODE =================

const themeToggle = document.getElementById("themeToggle");

themeToggle.addEventListener("click", () => {

    document.body.classList.toggle("light-mode");

    // ICON CHANGE

    if(document.body.classList.contains("light-mode")){

        themeToggle.innerHTML =
        `<i class="fa-solid fa-sun"></i>`;

    }
    else{

        themeToggle.innerHTML =
        `<i class="fa-solid fa-moon"></i>`;

    }

});


// ================= COUNTER ANIMATION =================

const counters = document.querySelectorAll(".counter");

counters.forEach(counter => {

    counter.innerText = "0";

    const updateCounter = () => {

        const target = +counter.getAttribute("data-target");

        const current = +counter.innerText;

        const increment = target / 100;

        if(current < target){

            counter.innerText =
            `${Math.ceil(current + increment)}`;

            setTimeout(updateCounter, 20);

        }
        else{

            counter.innerText = target + "+";

        }

    };

    updateCounter();

});


// ================= NAVBAR BACKGROUND =================

window.addEventListener("scroll", () => {

    const navbar = document.querySelector(".navbar");

    if(window.scrollY > 50){

        navbar.style.background = "#020617";
        navbar.style.padding = "12px 0";
        navbar.style.boxShadow = "0 5px 25px rgba(0,0,0,0.3)";

    }
    else{

        navbar.style.background = "rgba(0,0,0,0.6)";
        navbar.style.padding = "18px 0";
        navbar.style.boxShadow = "none";

    }

});


// ================= ACTIVE NAV LINK =================

const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-link");

window.addEventListener("scroll", () => {

    let current = "";

    sections.forEach(section => {

        const sectionTop = section.offsetTop - 150;
        const sectionHeight = section.clientHeight;

        if(pageYOffset >= sectionTop){

            current = section.getAttribute("id");

        }

    });

    navLinks.forEach(link => {

        link.classList.remove("active");

        if(link.getAttribute("href").includes(current)){

            link.classList.add("active");

        }

    });

});


// ================= SMOOTH SCROLL =================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {

    anchor.addEventListener("click", function(e){

        e.preventDefault();

        const target = document.querySelector(
            this.getAttribute("href")
        );

        target.scrollIntoView({
            behavior: "smooth"
        });

    });

});


// ================= HERO TEXT TYPING EFFECT =================

const textArray = [
    "Digital Marketing",
    "Social Media Branding",
    "Video Production",
    "Creative Strategy"
];

let textIndex = 0;
let charIndex = 0;

const typingElement = document.createElement("span");

typingElement.classList.add("typing-text");

const heroHeading =
document.querySelector(".hero h1");

heroHeading.appendChild(document.createElement("br"));
heroHeading.appendChild(typingElement);

function typeEffect(){

    if(charIndex < textArray[textIndex].length){

        typingElement.textContent +=
        textArray[textIndex].charAt(charIndex);

        charIndex++;

        setTimeout(typeEffect, 100);

    }
    else{

        setTimeout(eraseEffect, 1500);

    }

}

function eraseEffect(){

    if(charIndex > 0){

        typingElement.textContent =
        textArray[textIndex].substring(0, charIndex - 1);

        charIndex--;

        setTimeout(eraseEffect, 50);

    }
    else{

        textIndex++;

        if(textIndex >= textArray.length){

            textIndex = 0;

        }

        setTimeout(typeEffect, 300);

    }

}

typeEffect();


// ================= SCROLL REVEAL EFFECT =================

const revealElements =
document.querySelectorAll(".service-card, .portfolio-card, .testimonial-card");

window.addEventListener("scroll", revealOnScroll);

function revealOnScroll(){

    const triggerBottom =
    window.innerHeight / 1.2;

    revealElements.forEach(element => {

        const elementTop =
        element.getBoundingClientRect().top;

        if(elementTop < triggerBottom){

            element.classList.add("show");

        }

    });

}

revealOnScroll();


// ================= FLOATING PARTICLES =================

const hero = document.querySelector(".hero");

for(let i = 0; i < 20; i++){

    let particle =
    document.createElement("span");

    particle.classList.add("particle");

    particle.style.left =
    Math.random() * 100 + "%";

    particle.style.animationDuration =
    (Math.random() * 5) + 5 + "s";

    particle.style.animationDelay =
    Math.random() * 5 + "s";

    hero.appendChild(particle);

}


// ================= PRELOADER =================

window.addEventListener("load", () => {

    const preloader =
    document.querySelector(".preloader");

    if(preloader){

        preloader.style.opacity = "0";

        setTimeout(() => {

            preloader.style.display = "none";

        }, 500);

    }

});


// ================= BUTTON HOVER GLOW =================

const buttons =
document.querySelectorAll(".btn-custom");

buttons.forEach(button => {

    button.addEventListener("mousemove", e => {

        const x = e.pageX - button.offsetLeft;
        const y = e.pageY - button.offsetTop;

        button.style.setProperty("--x", x + "px");
        button.style.setProperty("--y", y + "px");

    });

});


// ================= MOBILE MENU CLOSE =================

const navItems =
document.querySelectorAll(".nav-link");

const navbarCollapse =
document.querySelector(".navbar-collapse");

navItems.forEach(item => {

    item.addEventListener("click", () => {

        if(navbarCollapse.classList.contains("show")){

            new bootstrap.Collapse(navbarCollapse).toggle();

        }

    });

});


// ================= CUSTOM CURSOR EFFECT =================

const cursor = document.createElement("div");

cursor.classList.add("custom-cursor");

document.body.appendChild(cursor);

document.addEventListener("mousemove", e => {

    cursor.style.left = e.clientX + "px";
    cursor.style.top = e.clientY + "px";

});


// ================= PAGE SCROLL PROGRESS BAR =================

const progressBar =
document.createElement("div");

progressBar.classList.add("progress-bar-top");

document.body.appendChild(progressBar);

window.addEventListener("scroll", () => {

    const scrollTop =
    document.documentElement.scrollTop;

    const scrollHeight =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;

    const scrollPercent =
    (scrollTop / scrollHeight) * 100;

    progressBar.style.width =
    scrollPercent + "%";

});


// Light Mode
document.body.classList.add("light-mode");

// Dark Mode
document.body.classList.remove("light-mode");

