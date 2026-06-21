document.addEventListener('DOMContentLoaded', () => {
    // Dynamic light tracking
    const body = document.body;
    
    document.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        
        // Subtle shift based on mouse position
        body.style.setProperty('--mouse-x', x);
        body.style.setProperty('--mouse-y', y);
    });
});
