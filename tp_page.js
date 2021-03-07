

document.addEventListener("DOMContentLoaded", function (e) {
    console.log("ready!");

    const els = document.querySelectorAll(".logo-container img, .center-main-menu");

    const observer = new IntersectionObserver(
        ([e]) => {
            els.forEach(function (v, i) {
                v.toggleAttribute('stuck', e.intersectionRatio < 1);
            })
        },
        {threshold: [1]}
    );
    observer.observe(document.getElementById('intersect'));
});