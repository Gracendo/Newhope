document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Simple validation
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            // Here you would typically send the data to a server
            console.log('Form submitted:', { name, email, password });
            
            // Show success message with animation
            const submitButton = signupForm.querySelector('.btn-signup');
            submitButton.innerHTML = '<i class="fas fa-check"></i> Thank You!';
            submitButton.style.backgroundColor = '#2a9d8f';
            
            // Reset form after delay
            setTimeout(() => {
                signupForm.reset();
                submitButton.innerHTML = 'Join Now <i class="fas fa-arrow-right"></i>';
                submitButton.style.backgroundColor = '';
            }, 3000);
        });
    }
    
    // Add animation to benefit items on hover
    const benefitItems = document.querySelectorAll('.benefit-item');
    benefitItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelector('i').style.transform = 'scale(1.2)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.querySelector('i').style.transform = 'scale(1)';
        });
    });
});