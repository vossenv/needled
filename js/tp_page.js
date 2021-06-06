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

    var x = document.getElementsByClassName("flip-card");
    for (i = 0; i < x.length; i++) {
        const r = x[i];
        // console.log(r)
        r.addEventListener("click", function () {
            r.toggleAttribute('flipped');
        });
    }

    var y = document.getElementsByClassName("dept-title");
    for (i = 0; i < y.length; i++) {
        const r = y[i];
        const dn = r.getAttribute("dname");
        console.log(dn)
        r.addEventListener("click", function () {
            document.getElementById(dn).toggleAttribute('xhidden');
            document.getElementById(dn + "-arrow").toggleAttribute('xhidden');
        });
    }

});