// Récupérer les éléments du DOM
const modal = document.getElementById("formModal");
const btn = document.getElementById("openModal");
const span = document.querySelector(".close");
const form = document.getElementById("contactForm");

// Ouvrir la modale quand on clique sur le bouton
btn.onclick = function() {
    modal.style.display = "block";
}

// Fermer la modale quand on clique sur le X
span.onclick = function() {
    modal.style.display = "none";
}

// Fermer la modale si on clique en dehors
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Traitement du formulaire
form.addEventListener("submit", function(event) {
    event.preventDefault();

    // Récupérer les valeurs du formulaire
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;

    // Ici, vous pourriez envoyer les données à un serveur
    console.log("Formulaire soumis avec succès !");
    console.log({name, email, subject, message});

    // Afficher un message de confirmation
    alert("Votre message a été envoyé avec succès !");

    // Réinitialiser le formulaire et fermer la modale
    form.reset();
    modal.style.display = "none";
});