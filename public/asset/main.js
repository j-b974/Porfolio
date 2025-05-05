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

    // Préparer les données pour l'envoi
    const formData = JSON.stringify({name, email, subject, message});

    // Créer une requête XHR
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader( "X-Requested-With", "XMLHttpRequest");
    xhr.setRequestHeader("Authorization", "Bearer exampleToken123"); // Exemple de clé pour identification
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let reponse = JSON.parse(xhr.responseText);
                console.log(reponse);
            } else {
                alert("Une erreur est survenue lors de l'envoi du message.");
            }
        }
    };

    // Envoyer la requête avec les données du formulaire
    xhr.send(formData);

    // Réinitialiser le formulaire et fermer la modale
    form.reset();
    modal.style.display = "none";
});