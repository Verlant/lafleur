document.addEventListener("DOMContentLoaded", () => {
  const addPanier = document.querySelectorAll(".add-panier");
  addPanier.forEach((element) => {
    element.addEventListener("click", (event) => {
      fetch("util/fetch.php", {
        method: "POST",
        body: JSON.stringify({
          action: "get_data",
          parameter1: event.target.dataset.id,
        }),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Erreur HTTP, code : " + response.status);
          }
          return response.json();
        })
        .then((message) => {
          console.log(message);
          alert(message);
        })
        .catch((error) => {
          alert(
            "La requête a échoué, veuillez réessayer ou recharger la page."
          );
          console.error(error);
        });
    });
  });

  const passwordInputs = document.querySelectorAll(".password");

  passwordInputs.forEach((passwordInput) => {
    passwordInput.addEventListener("change", () => {
      if (password.value !== password_verify.value) {
        if (
          !password_verify.classList.contains("border-error") &&
          !password.classList.contains("border-error")
        ) {
          password.classList.add("border-error");
          password_verify.classList.add("border-error");
          password.classList.remove("border-validate");
          password_verify.classList.remove("border-validate");
        }
      } else {
        password.classList.remove("border-error");
        password_verify.classList.remove("border-error");
        password.classList.add("border-validate");
        password_verify.classList.add("border-validate");
      }
    });
  });

  // const inputsQuantiteVente = document.querySelectorAll(".quantite_vente");
  // var maxValuesQuantiteVente = [];
  // inputsQuantiteVente.forEach((input) => {
  //   console.log(input.max);
  //   maxValuesQuantiteVente.push(input.max);
  //   console.log(maxValuesQuantiteVente);
  // });
});

// function validFormCommande() {
//   console.log(maxValuesQuantiteVente);
//   return false;
// }
