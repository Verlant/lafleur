document.addEventListener("DOMContentLoaded", () => {
  const logoPanier = document.querySelectorAll(".logo-panier");
  console.log(logoPanier);
  logoPanier.forEach((element) => {
    element.addEventListener("click", (event) => {
      console.log(event.target.dataset.id);
      fetch('supprimer-item.php')
        .then((response) => {
            ...
        })...
    });
  });
});
