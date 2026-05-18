// ================================
// University Department Portal JS
// REAL backend-based authentication
// ================================

// DOM Elements
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mainNav = document.getElementById("mainNav");
const loginModal = document.getElementById("loginModal");
const publicWebsite = document.getElementById("publicWebsite");

// -------------------------------
// ================================
// University Department Portal JS
// REAL backend-based authentication
// ================================

// DOM Elements
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mainNav = document.getElementById("mainNav");
const loginModal = document.getElementById("loginModal");
const publicWebsite = document.getElementById("publicWebsite");

// -------------------------------
// Mobile menu
// -------------------------------
let isMobileMenuOpen = false;

if (mobileMenuBtn && mainNav) {
    mobileMenuBtn.addEventListener("click", () => {
        isMobileMenuOpen = !isMobileMenuOpen;
        mainNav.style.display = isMobileMenuOpen ? "block" : "none";
        mobileMenuBtn.innerHTML = isMobileMenuOpen
            ? '<i class="fas fa-times"></i>'
            : '<i class="fas fa-bars"></i>';
    });
}

// -------------------------------
// Login Modal
// -------------------------------
function openLoginModal(role) {
    const modalTitle = document.getElementById("modalTitle");
    const roleSelect = document.getElementById("role");

    modalTitle.textContent =
        role === "student" ? "Student Login" :
        role === "staff" ? "Faculty Login" :
        "Admin Login";

    roleSelect.value = role;
    loginModal.style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeLoginModal() {
    loginModal.style.display = "none";
    document.getElementById("loginForm").reset();
    document.body.style.overflow = "auto";
}

// Close modal outside click
window.addEventListener("click", e => {
    if (e.target === loginModal) closeLoginModal();
});

// -------------------------------
// LOGIN (REAL BACKEND)
// -------------------------------
async function handleLogin(event) {
    event.preventDefault();

    const form = document.getElementById("loginForm");
    const submitBtn = document.getElementById("loginSubmitBtn");
    const formData = new FormData(form);

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';

    try {
        const response = await fetch("Backend/api/login.php", {
            method: "POST",
            body: formData,
            credentials: 'same-origin'
        });

        const data = await response.json();

        if (!response.ok || data.success !== true) {
            alert(data.error || "Invalid login");
            return;
        }

        // Frontend should redirect based on returned user role
        const role = data.user?.role || '';
        if (role === 'admin') {
            window.location.href = 'admin/dashboard.php';
        } else if (role === 'staff') {
            window.location.href = 'staff/dashboard.php';
        } else if (role === 'student') {
            window.location.href = 'student/dashboard.php';
        } else {
            window.location.href = 'Index.php';
        }

    } catch (err) {
        console.error(err);
        alert("Server error. Check console.");
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Login';
    }
}

// -------------------------------
// LOGOUT
// -------------------------------
function logout() {
    fetch("Backend/api/logout.php")
        .then(() => {
            window.location.href = "Index.php";
        })
        .catch(() => {
            alert("Logout failed");
        });
}

// -------------------------------
// Smooth scrolling
// -------------------------------
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", e => {
        const href = anchor.getAttribute("href");
        if (href === "#") return;

        const target = document.querySelector(href);
        if (!target) return;

        e.preventDefault();
        window.scrollTo({
            top: target.offsetTop - 80,
            behavior: "smooth"
        });
    });
});
