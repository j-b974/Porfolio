// Récupérer les éléments du DOM
const modal = document.getElementById("formModal");
const btn = document.getElementById("openModal");
const span = document.querySelector(".close");
const form = document.getElementById("contactForm");
const checkboxRgpd = document.getElementById("rgpd");
const btnSbumit = document.querySelector("button[type=submit]");

// construction Objet jeton recaptcha
const JetonRecaptcha = {
    jeton: "",
    delay: true,
    valide: false
};
const proxyJeton = new Proxy(JetonRecaptcha, {

    // quant une valeur est modifie
    set(target , prop , value , receiver ) {

        if(prop === 'valide')
        {
            //changeActiviteBtn()
        }
        return Reflect.set(...arguments);
    }
});




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
    const jetonRecaptcha = proxyJeton.jeton;
    // Préparer les données pour l'envoi
    const formData = JSON.stringify({name, email, subject, message, jetonRecaptcha });

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
                showMessage(reponse);
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

// affiche le message
function showMessage(message){
    divMessage = document.querySelector("#alertMessage");


    if(message.Success){
        console.log(message.Success);
        divMessage.innerHTML = `<strong>Succée :</strong> ${message.Success}`
        divMessage.parentElement.classList.remove('alert-error');
        divMessage.parentElement.classList.add('alert-success');
    }else{
        console.log(message.error);
        divMessage.innerHTML = `<strong>Error :</strong> ${message.error}`
        divMessage.parentElement.classList.remove('alert-success');
        divMessage.parentElement.classList.add('alert-error');

    }
    divMessage.parentElement.style.display = "block";

}

// gestion checkbox rgpd
checkboxRgpd.addEventListener('change', function(){
    changeActiviteBtn();
});
function jetonRecaptcha(jeton)
{
    console.log(jeton);
    proxyJeton.jeton = jeton;
    proxyJeton.valide = true;
    changeActiviteBtn();
}
function JetonExpiredRecaptcha()
{
    proxyJeton.valide = false;
    changeActiviteBtn();

}

// gestion btnSubmit contact
function changeActiviteBtn()
{
    if(checkboxRgpd.checked && proxyJeton.valide)
    {
        btnSbumit.disabled = false;
    }else{
        btnSbumit.disabled = true;
    }
}

// gestion scroll top
function goScrollTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.addEventListener('scroll', updateScrollProgress);
window.addEventListener('load', updateScrollProgress);

function updateScrollProgress() {
    const svg = document.getElementById('scrollProgressSvg');
    const circle = svg.querySelector('circle');
    const divContainer = svg.parentElement;

    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollRatio = scrollHeight === 0 ? 0 : scrollTop / scrollHeight;

    if(scrollTop > 800){
        divContainer.classList.remove('est-cacher');
        divContainer.classList.add('est-visible');
    }else{
        divContainer.classList.remove('est-visible');
        divContainer.classList.add('est-cacher');
    }

    const radius = circle.r.baseVal.value;
    const circumference = 2 * Math.PI * radius;
    const offset = circumference * (1 - scrollRatio);

    circle.style.strokeDasharray = `${circumference}`;
    circle.style.strokeDashoffset = `${offset}`;
}