document.addEventListener("DOMContentLoaded", () => {
    const blogCards = document.querySelectorAll(".card");
    const modal = new bootstrap.Modal(document.getElementById("blog-modal"));
    const blogImage = document.getElementById("blog-image");
    const blogTitle = document.getElementById("blog-title");
    const blogDate = document.getElementById("blog-date");
    const blogDescription = document.getElementById("blog-description");
  
    blogCards.forEach((card) => {
      card.addEventListener("click", () => {
        const imageSrc = card.querySelector("img").src;
        const title = card.querySelector(".card-title").textContent;
        const date = card.querySelector(".card-date").textContent;
        const description = card.querySelector(".card-text").textContent;
  
        // Actualiza el contenido del modal
        blogImage.src = imageSrc;
        blogTitle.textContent = title;
        blogDate.textContent = date;
        blogDescription.textContent = description;
  
        // Muestra el modal
        modal.show();
      });
    });
  });