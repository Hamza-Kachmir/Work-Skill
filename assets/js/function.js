// Function pour les familles de competences (Disabled)

// functions for no Click element a
function AddDisabledClick(element) {
  element.classList.add("disabledclick");
  element.firstElementChild.classList.add("disabledclick");
}
function RemoveDisabledClick(element) {
  element.classList.remove("disabledclick");
  element.firstElementChild.classList.remove("disabledclick");
}
function ToggleDisabledClick(element) {
  element.classList.toggle("disabledclick");
  element.firstElementChild.classList.toggle("disabledclick");
}

//   Functions for no color
function AddDisabledColor(element) {
  element.classList.add("disabledcolor");
  element.firstElementChild.classList.add("disabledcolor");
}
function RemoveDisabledColor(element) {
  element.classList.remove("disabledcolor");
  element.firstElementChild.classList.remove("disabledcolor");
}
function ToggleDisabledColor(element) {
  element.classList.toggle("disabledcolor");
  element.firstElementChild.classList.toggle("disabledcolor");
}

// Container ou la boucle php creer toute les div pour les familles de competences
const skillcontainer = document.querySelector(".cardskill-container");

// url Get famille before de la famille selectionner
const queryString2 = window.location.search;
const urlParams2 = new URLSearchParams(queryString2);
let famillebefore = urlParams2.get("famille");

var themebefore = document.querySelector("." + famillebefore);

// url Get famille suivante de la famille selectionner
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let famillesuivant = urlParams.get("famillesuivante");

// Premiere famille de competence
first_theme = skillcontainer.firstElementChild;

// Variable qui correspond a la famille suivante de celle selectionner
if (famillesuivant != "" || null) {
  var themesuivant = document.querySelector("." + famillesuivant);
}

if (famillebefore == null) {
  RemoveDisabledClick(skillcontainer.firstElementChild);
  RemoveDisabledColor(skillcontainer.firstElementChild);
} else {
  for (let i = 0; i < skillcontainer.children.length; i++) {
    if ((famillebefore = skillcontainer.children[i].className)) {
      RemoveDisabledColor(themebefore);
      console.log(themesuivant);
      if (themesuivant != undefined) {
        RemoveDisabledClick(themesuivant);
        RemoveDisabledColor(themesuivant);
      }
      if ((i = skillcontainer.children.length)) {
        break;
      }
    }
  }
}
const buttonfini = document.querySelector(".btn-search");

if (famillebefore == skillcontainer.lastElementChild.className) {
  for (let i = 0; i < skillcontainer.children.length; i++) {
    RemoveDisabledColor(skillcontainer.children[i]);
  }
}
if (famillesuivant == "") {
  for (let i = 0; i < skillcontainer.children.length; i++) {
    buttonfini.href = "resultat.php";
    RemoveDisabledColor(skillcontainer.children[i]);
  }
}