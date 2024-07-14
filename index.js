function OpenPage(a){
    window.location.href = a;
}

document.addEventListener("DOMContentLoaded", function() {
    const options = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("in-view");
                observer.unobserve(entry.target); // Stop observing once the animation is applied
            }
        });
    }, options);

    document.querySelectorAll('.Preview').forEach(section => {
        observer.observe(section);
    });
});
