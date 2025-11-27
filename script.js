// Smooth scroll for navbar links
document.querySelectorAll(".nav-link").forEach((link) => {
  link.addEventListener("click", (e) => {
    const href = link.getAttribute("href");
    if (href.startsWith("#")) {
      e.preventDefault();
      document.querySelector(href).scrollIntoView({ behavior: "smooth" });
    }
  });
});

// Cursor tracking
const cursorDot = document.getElementById("cursorDot");
document.addEventListener("mousemove", (e) => {
  cursorDot.style.top = e.clientY + "px";
  cursorDot.style.left = e.clientX + "px";
});

// Dynamic "currently learning" section (DOM event)
const learningCard = document.querySelector(".dynamic-skill");
const learningText = document.getElementById("learningText");
learningCard.addEventListener("click", () => {
  learningText.textContent = "React, Node.js, Data Structures & Algorithms";
});

// Project details toggle (DOM + dynamic section)
document.querySelectorAll(".toggle-details").forEach((btn) => {
  btn.addEventListener("click", () => {
    const details = btn.nextElementSibling;
    const visible = details.style.display === "block";
    details.style.display = visible ? "none" : "block";
    btn.textContent = visible ? "Show Details" : "Hide Details";
  });
});

// Contact form validation
const form = document.getElementById("contactForm");
const nameInput = document.getElementById("name");
const usnInput = document.getElementById("usn");
const emailInput = document.getElementById("email");
const subjectInput = document.getElementById("subject");
const messageInput = document.getElementById("message");
const successMsg = document.getElementById("formSuccess");

// Simple VTU-like USN regex: 1RV22CS001 etc.
const usnPattern = /^[0-9][A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{3}$/i;

form.addEventListener("submit", (e) => {
  let valid = true;
  successMsg.textContent = "";

  // Name
  if (nameInput.value.trim().length < 3) {
    setError("nameError", "Name must be at least 3 characters");
    valid = false;
  } else {
    clearError("nameError");
  }

  // USN
  if (!usnPattern.test(usnInput.value.trim())) {
    setError("usnError", "Enter a valid USN (e.g., 1RV22CS001)");
    valid = false;
  } else {
    clearError("usnError");
  }

  // Email
  if (!emailInput.value.includes("@")) {
    setError("emailError", "Enter a valid email address");
    valid = false;
  } else {
    clearError("emailError");
  }

  // Subject
  if (subjectInput.value.trim().length < 3) {
    setError("subjectError", "Subject is required");
    valid = false;
  } else {
    clearError("subjectError");
  }

  // Message
  if (messageInput.value.trim().length < 10) {
    setError("messageError", "Message must be at least 10 characters");
    valid = false;
  } else {
    clearError("messageError");
  }

  if (!valid) {
    e.preventDefault();
    return;
  }

  // If you are only using GitHub Pages (no PHP), prevent submit & show message
  // Comment this block when testing PHP on localhost.
  /*
  e.preventDefault();
  successMsg.textContent = "Form validation successful! (Backend disabled on GitHub Pages)";
  form.reset();
  */
});

function setError(id, msg) {
  document.getElementById(id).textContent = msg;
}

function clearError(id) {
  document.getElementById(id).textContent = "";
}

// Dynamic footer year
document.getElementById("year").textContent = new Date().getFullYear();