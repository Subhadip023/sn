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
    form.addEventListener('submit', function(e) {
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
document.addEventListener('DOMContentLoaded', function() {
    // Handle loader
    const loader = document.querySelector('.loader-overlay');
    
    if (loader) {
        // Hide loader when all assets are loaded
        window.addEventListener('load', function() {
            // Add a small delay for better UX
            setTimeout(function() {
                loader.classList.add('opacity-0');
                
                // Remove loader from DOM after animation completes
                loader.addEventListener('transitionend', function() {
                    if (loader.classList.contains('opacity-0')) {
                        loader.style.display = 'none';
                    }
                });
            }, 1000); // 1 second delay
        });
        
        // Fallback in case load event doesn't fire
        setTimeout(function() {
            if (!loader.classList.contains('opacity-0')) {
                loader.classList.add('opacity-0');
                loader.style.display = 'none';
            }
        }, 3000); // 3 seconds max loading time
    }
    
    // Initialize the subscription popup
    setupSubscriptionPopup();
    
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

// Add active class to current navigation item
function setActiveNavItem() {
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.main-nav a');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPath || 
            (currentPath === '' && linkPath === 'index.html')) {
            link.parentElement.classList.add('active');
        } else {
            link.parentElement.classList.remove('active');
        }
    });
}

// Initialize on load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setActiveNavItem);
} else {
    setActiveNavItem();
}

