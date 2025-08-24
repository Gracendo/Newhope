<!-- Menu Navigation starts -->
    <nav>
      <div class="app-logo">
        <a class="logo d-inline-block" href="{{route('home')}}" >
           <div style="display:flex;align-items:center">
            <img src="{{asset('assets/frontend/images/loader.svg')}}" style="width:55px" alt="Logo" ><span  style="margin-left:10px;color :#FF6600; font-size:60"> Newhope </span>
           </div>
          
        </a>

        <span class="bg-light-primary toggle-semi-nav">
          <i class="ti ti-chevrons-right f-s-20"></i>
        </span>
      </div>
      <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
          <li class="no-sub">
            <a class=""  href="{{route('admin.home')}}" onclick="window.location.href='{{ route('admin.home') }}'; return false;">
              <i class="ph-duotone  ph-house-line"></i>
              dashboard
              <!-- <span class="badge text-bg-success badge-notification ms-2">4</span> -->
            </a>
          </li>
           <li class="menu-title"> <span>Campaign Management</span></li>

          <li class="no-sub">
            <a class="" href="{{route('admin.campaign')}}" onclick="window.location.href='{{ route('admin.campaign') }}'; return false;">
              <i class="ph-duotone  ph-stack"></i>
              Campaigns
            </a>
          </li>
          
          @canany(['user-list','user-create'])
            <li class="menu-title"> <span>User Management</span></li>
            <li class="no-sub">
              <a class="" href="{{route('admin.manageUsers')}}" onclick="window.location.href='{{ route('admin.manageUsers') }}'; return false;">
                <i class="fa-solid fa-user fa-fw"></i>  All users
              </a>
            </li>
          @endcanany
          
          <li class="no-sub">
            <a class=""href="{{route('admin.profilePersonalInfo')}}" onclick="window.location.href='{{ route('admin.profilePersonalInfo') }}'; return false;">
              <i class="fa-solid fa-user fa-fw"></i>  My profile
            </a>
          </li>
           <li class="menu-title"> <span>Donation Management</span></li>
                <li class="no-sub">
            <a class=""href="{{route('donation_management')}}" onclick="window.location.href='{{ route('donation_management') }}'; return false;">
              <i class="fa-solid fa-eur fa-fw"></i>  Donations
            </a>
          </li>
          

        </ul>
      </div>

      <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
      </div>

    </nav>
    <!-- Menu Navigation ends -->

<!-- Floating Assistant Button Start -->
<div class="floating-assistant" id="floatingAssistant">
    <svg class="assistant-icon" viewBox="0 0 24 24">
        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8-8 3.58-8 8 3.58 8 8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11z"/>
        <path d="M12 17.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
        <circle cx="12" cy="2" r="1.5" fill="white" opacity="0.8"/>
        <circle cx="8.5" cy="9.5" r="1.2"/>
        <circle cx="15.5" cy="9.5" r="1.2"/>
    </svg>
    <span class="assistant-text">Chat with our assistant</span>
    <div class="popup-message" id="popupMessage">
        How can I help you?
    </div>
</div>
<!-- Floating Assistant Button End -->

<style>
/* Floating Button Styles */
.floating-assistant {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FF6600, #ff8533);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(255, 102, 0, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 9999; /* Higher z-index for admin panels */
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    overflow: visible;
}

.floating-assistant:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 35px rgba(255, 102, 0, 0.6);
    width: auto;
    min-width: 60px;
    padding: 0 20px;
    border-radius: 30px;
}

.floating-assistant.dragging {
    transform: rotate(5deg);
    box-shadow: 0 15px 40px rgba(255, 102, 0, 0.7);
}

/* Icon and Text */
.assistant-icon {
    width: 28px;
    height: 28px;
    fill: white;
    transition: all 0.3s ease;
}

.assistant-text {
    color: white;
    font-weight: 600;
    font-size: 14px;
    white-space: nowrap;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
    margin-left: 8px;
}

.floating-assistant:hover .assistant-icon {
    opacity: 0;
    transform: scale(0.8);
}

.floating-assistant:hover .assistant-text {
    opacity: 1;
    transform: translateX(0);
}

/* Popup Message */
.popup-message {
    position: absolute;
    bottom: 80px;
    right: 0;
    background: white;
    color: #333;
    padding: 15px 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    font-size: 14px;
    font-weight: 500;
    opacity: 0;
    transform: translateY(20px) scale(0.8);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
    white-space: nowrap;
    border: 2px solid #FF6600;
}

.popup-message::after {
    content: '';
    position: absolute;
    top: 100%;
    right: 20px;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 10px solid #FF6600;
}

.popup-message.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}

/* Pulse Animation */
.floating-assistant::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 102, 0, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0;
    }
}

/* Floating Animation */
.floating-assistant {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.floating-assistant:hover {
    animation: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-assistant {
        bottom: 20px;
        right: 20px;
        width: 55px;
        height: 55px;
    }
    
    .assistant-text {
        font-size: 12px;
    }
    
    .popup-message {
        font-size: 13px;
        padding: 12px 16px;
        bottom: 75px;
    }
}

/* Admin Panel Specific Adjustments */
@media (min-width: 992px) {
    /* Adjust position if sidebar is open */
    body.sidebar-open .floating-assistant {
        right: 280px; /* Adjust based on your sidebar width */
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    class FloatingAssistant {
        constructor() {
            this.button = document.getElementById('floatingAssistant');
            if (!this.button) return;
            
            this.popup = document.getElementById('popupMessage');
            this.isDragging = false;
            this.dragOffset = { x: 0, y: 0 };
            this.popupInterval = null;
            this.chatUrl = "{{ route('chat.view') }}";
            this.popupIntervalTime = 300000; // 5 minutes
            
            this.init();
        }

        init() {
            this.setupEventListeners();
            this.startPopupTimer();
        }

        setupEventListeners() {
            // Click event
            this.button.addEventListener('click', (e) => {
                if (!this.isDragging) {
                    this.handleClick();
                }
            });

            // Mouse events for dragging
            this.button.addEventListener('mousedown', (e) => this.startDrag(e));
            document.addEventListener('mousemove', (e) => this.drag(e));
            document.addEventListener('mouseup', () => this.stopDrag());

            // Touch events for mobile dragging
            this.button.addEventListener('touchstart', (e) => this.startDrag(e.touches[0]));
            document.addEventListener('touchmove', (e) => this.drag(e.touches[0]));
            document.addEventListener('touchend', () => this.stopDrag());

            // Prevent context menu on right click
            this.button.addEventListener('contextmenu', (e) => e.preventDefault());
        }

        startDrag(e) {
            this.isDragging = true;
            this.button.classList.add('dragging');
            
            const rect = this.button.getBoundingClientRect();
            this.dragOffset.x = e.clientX - rect.left;
            this.dragOffset.y = e.clientY - rect.top;
            
            this.button.style.transition = 'none';
            this.hidePopup();
        }

        drag(e) {
            if (!this.isDragging) return;
            
            e.preventDefault();
            
            const x = e.clientX - this.dragOffset.x;
            const y = e.clientY - this.dragOffset.y;
            
            // Keep button within viewport bounds
            const maxX = window.innerWidth - this.button.offsetWidth;
            const maxY = window.innerHeight - this.button.offsetHeight;
            
            const constrainedX = Math.max(0, Math.min(x, maxX));
            const constrainedY = Math.max(0, Math.min(y, maxY));
            
            this.button.style.left = constrainedX + 'px';
            this.button.style.top = constrainedY + 'px';
            this.button.style.right = 'auto';
            this.button.style.bottom = 'auto';
        }

        stopDrag() {
            if (!this.isDragging) return;
            
            this.isDragging = false;
            this.button.classList.remove('dragging');
            this.button.style.transition = '';
            
            // Small delay to prevent click event from firing immediately after drag
            setTimeout(() => {
                this.isDragging = false;
            }, 100);
        }

        handleClick() {
            // Add click animation
            this.button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.button.style.transform = '';
            }, 150);
            
            // Redirect to chat page
            window.location.href = this.chatUrl;
        }

        showPopup() {
            this.popup.classList.add('show');
            
            // Hide popup after 4 seconds
            setTimeout(() => {
                this.hidePopup();
            }, 4000);
        }

        hidePopup() {
            this.popup.classList.remove('show');
        }

        startPopupTimer() {
            // Show popup every 5 minutes (300000 milliseconds)
            this.popupInterval = setInterval(() => {
                this.showPopup();
            }, this.popupIntervalTime);
            
            // Show popup once after 10 seconds for demo purposes
            setTimeout(() => {
                this.showPopup();
            }, 10000);
        }

        destroy() {
            if (this.popupInterval) {
                clearInterval(this.popupInterval);
            }
        }
    }

    // Initialize the floating assistant
    new FloatingAssistant();

    // Handle window resize
    window.addEventListener('resize', function() {
        const button = document.getElementById('floatingAssistant');
        if (!button) return;
        
        const rect = button.getBoundingClientRect();
        
        // If button is outside viewport after resize, move it back
        if (rect.right > window.innerWidth || rect.bottom > window.innerHeight) {
            button.style.right = '30px';
            button.style.bottom = '30px';
            button.style.left = 'auto';
            button.style.top = 'auto';
        }
    });
});
</script>