// Initialize Engagement Chart
function initEngagementChart() {
    const ctx = document.getElementById('engagementChart');
    if (!ctx) return;

    // Chart is available globally via CDN
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Sessions',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: true,
                borderColor: 'rgb(81, 100, 255)', // brand-500
                backgroundColor: 'rgba(81, 100, 255, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                    beginAtZero: true
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: '#64748b' // slate-500
                    }
                }
            }
        }
    });
}

// Update date and time
function updateDateTime() {
    const now = new Date();

    // Format date
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString('en-IN', options);

    // Format time
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    const timeString = `${hours}:${minutes} ${ampm}`;

    // Update the DOM
    const dateEl = document.getElementById('date');
    const timeEl = document.getElementById('time');
    if (dateEl) dateEl.textContent = dateString;
    if (timeEl) timeEl.textContent = timeString;
}

// Initialize date and time
updateDateTime();

// Update time every minute
setInterval(updateDateTime, 60000);

// Show popup function moved to global scope
function showPopup() {
    const popup = document.getElementById('subscriptionPopup');
    if (popup) {
        popup.classList.remove('opacity-0', 'invisible');
        popup.classList.add('opacity-100', 'visible');
        const popupContent = popup.querySelector('.popup-content');
        if (popupContent) {
            popupContent.classList.remove('-translate-y-12');
            popupContent.classList.add('translate-y-0');
        }
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
}

// Hide popup function
function hidePopup() {
    const popup = document.getElementById('subscriptionPopup');
    if (popup) {
        popup.classList.add('opacity-0', 'invisible');
        popup.classList.remove('opacity-100', 'visible');
        const popupContent = popup.querySelector('.popup-content');
        if (popupContent) {
            popupContent.classList.add('-translate-y-12');
            popupContent.classList.remove('translate-y-0');
        }
        document.body.style.overflow = '';
    }
}

// Subscription Popup Functionality
function setupSubscriptionPopup() {
    const popup = document.getElementById('subscriptionPopup');
    const closeBtn = document.querySelector('.close-popup');
    const form = document.getElementById('subscriptionForm');
    const emailInput = document.getElementById('email');

    if (!popup || !closeBtn || !form || !emailInput) return;

    // Check if user has already subscribed (using localStorage)
    const hasSubscribed = localStorage.getItem('newsletterSubscribed');

    // Show popup after 5 seconds if not subscribed
    if (!hasSubscribed) {
        setTimeout(showPopup, 5000);
    }

    // Close button event
    closeBtn.addEventListener('click', hidePopup);

    // Form submit event
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const email = emailInput.value.trim();
        if (email) {
            localStorage.setItem('newsletterSubscribed', 'true');
            hidePopup();
            alert('Thank you for subscribing!');
        }
    });
}

// Initialize functions when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Handle loader
    const loader = document.querySelector('.loader-overlay');

    if (loader) {
        // Hide loader when all assets are loaded
        window.addEventListener('load', function () {
            // Add a small delay for better UX
            setTimeout(function () {
                loader.classList.add('opacity-0');

                // Remove loader from DOM after animation completes
                loader.addEventListener('transitionend', function () {
                    if (loader.classList.contains('opacity-0')) {
                        loader.style.display = 'none';
                    }
                });
            }, 1000); // 1 second delay
        });

        // Fallback in case load event doesn't fire
        setTimeout(function () {
            if (!loader.classList.contains('opacity-0')) {
                loader.classList.add('opacity-0');
                loader.style.display = 'none';
            }
        }, 3000); // 3 seconds max loading time
    }

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            if (loader) {
                // loader.style.display = 'block'; // Optional: keep it hidden if not needed
            }
        });
    });


    
       // Profile Dropdown Logic
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');
    const profileWrapper = document.getElementById('profile-wrapper');

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (profileWrapper && !profileWrapper.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }

    // Initialize the subscription popup
    // setupSubscriptionPopup();

    // Add animation to news cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.news-card, .news-item').forEach(card => {
        observer.observe(card);
    });

    // Initialize charts
    initEngagementChart();

    // Initialize sidebar toggle
    const contentMenuBtn = document.getElementById('contentMenuBtn');
    const contentSubmenu = document.getElementById('contentSubmenu');
    const contentMenuIcon = document.getElementById('contentMenuIcon');

    if (contentMenuBtn && contentSubmenu && contentMenuIcon) {
        // Check if submenu should be open by default (if active)
        if (contentMenuBtn.classList.contains('bg-slate-100')) {
            contentSubmenu.classList.remove('hidden');
            contentMenuIcon.style.transform = 'rotate(180deg)';
        }

        contentMenuBtn.addEventListener('click', () => {
            contentSubmenu.classList.toggle('hidden');
            if (contentSubmenu.classList.contains('hidden')) {
                contentMenuIcon.style.transform = 'rotate(0deg)';
            } else {
                contentMenuIcon.style.transform = 'rotate(180deg)';
            }
        });
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80, // Adjust for fixed header
                behavior: 'smooth'
            });
        }
    });
});

// Add active class to current navigation item (Client-side fallback)
function setActiveNavItem() {
    // Check if Laravel is not handling it
    const navLinks = document.querySelectorAll('.main-nav a');
    // If no active class found, try to add it based on URL
    let hasActive = false;
    navLinks.forEach(link => {
        if (link.classList.contains('bg-white/10')) hasActive = true;
    });

    if (!hasActive) {
        const currentPath = window.location.pathname.split('/').pop() || 'index.html';
        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentPath ||
                (currentPath === '' && linkPath === 'index.html')) {
                link.classList.add('bg-white/10');
            }
        });
    }
}

// Initialize on load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setActiveNavItem);
} else {
    setActiveNavItem();
}

const sidebar_btn = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
sidebar_btn.addEventListener('click', () => {
   sidebar.classList.toggle('hidden');
});


