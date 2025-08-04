document.addEventListener('DOMContentLoaded', function() {
    console.log('skripts.js loaded');

    // Dark // Light mode
    const body = document.querySelector("body");
    const modeToggle = document.querySelector(".dark-light");
    const addToCartBtn = document.querySelector(".btn");

    
    const savedMode = localStorage.getItem('darkMode');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedMode === 'dark' || (!savedMode && systemPrefersDark)) {
        body.classList.add('dark');
        modeToggle.classList.add('active');
    }

    modeToggle.addEventListener("click", () => {
        const isDark = body.classList.toggle("dark");
        modeToggle.classList.toggle("active");
        localStorage.setItem('darkMode', isDark ? 'dark' : 'light');
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('darkMode')) {
            body.classList.toggle('dark', e.matches);
            modeToggle.classList.toggle('active', e.matches);
        }
    });

    // Facebook Panel Toggle
    const fbContainer = document.getElementById('fbContainer');
    const fbToggle = document.getElementById('fbToggle');
    let isHidden = fbContainer.classList.contains('hidden');
    let touchStartX = 0;
    const SWIPE_THRESHOLD = 50; 

    // Update arrow direction based on initial state
    updateArrowDirection();

    function togglePanel() {
        isHidden = !isHidden;
        fbContainer.classList.toggle('hidden', isHidden);
        updateArrowDirection();
        
        // Add animation class
        fbContainer.classList.add('animating');
        setTimeout(() => fbContainer.classList.remove('animating'), 300);
    }

    function updateArrowDirection() {
        fbToggle.innerHTML = isHidden ? '&#8592;' : '&#8594;';
    }

    // Click/tap handler with event delegation
    fbToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        togglePanel();
    });

    // Improved touch handling
    fbContainer.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
    }, {passive: true});

    fbContainer.addEventListener('touchmove', (e) => {
        if (!isHidden) {
            // Prevent scrolling when swiping the panel
            if (e.touches[0].clientX < touchStartX) {
                e.preventDefault();
            }
        }
    }, {passive: false});

    fbContainer.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const deltaX = touchEndX - touchStartX;
        
        if (Math.abs(deltaX) > SWIPE_THRESHOLD) {
            if (deltaX < 0 && !isHidden) {
                togglePanel();
            } else if (deltaX > 0 && isHidden) {
                togglePanel();
            }
        }
    }, {passive: true});

    // Close panel when clicking outside (optional)
    document.addEventListener('click', (e) => {
        if (!fbContainer.contains(e.target) && !isHidden) {
            togglePanel();
        }
    });

    // Facebook SDK initialization
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v18.0'
        });
        
        // Refresh the plugin after it's loaded
        FB.Event.subscribe('xfbml.render', function() {
            console.log('Facebook plugin rendered');
        });
    };

    // Load Facebook SDK
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        js.async = true;
        js.defer = true;
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
});

document.getElementById("loginTrigger").onclick = function() {
    document.getElementById("myModal").style.display = "block";
};

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

// // Close modal when clicking outside the modal content
// window.onclick = function(event) {
//     if (event.target == document.getElementById("myModal")) {
//         closeModal();
//     }
// };

// Login form validation
function validateLogin() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email == "" || password == "") {
        document.getElementById("notification").innerHTML = "Lūdzu ievadi e-pastu un paroli.";
        return false;
    }

    loginUser(email, password);
}




