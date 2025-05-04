document.addEventListener("DOMContentLoaded", () => {
    const benefits = document.querySelectorAll(".tarjeta-beneficio");
    const modal = new bootstrap.Modal(document.getElementById("benefit-modal"));
    const benefitIcon = document.getElementById("benefit-icon");
    const benefitTitle = document.getElementById("benefit-title");
    const benefitDescription = document.getElementById("benefit-description");
    benefits.forEach((benefit) => {
        benefit.addEventListener("click", () => {
            const iconClass = benefit.querySelector("i").className;
            const title = benefit.querySelector("span").textContent;
            const description = benefit.querySelector("p").textContent;

            // Actualiza el contenido del modal
            benefitIcon.className = iconClass + " fa-3x mb-3";
            benefitTitle.textContent = title;
            benefitDescription.textContent = description;

            // Muestra el modal
            modal.show();
        });
    });
});