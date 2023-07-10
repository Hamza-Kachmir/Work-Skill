// Dark Mode
const toggleSwitch = document.querySelector('.switch input[type="checkbox"]');
const currentTheme = localStorage.getItem("theme")
  ? localStorage.getItem("theme")
  : null;

function switchTheme(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute("data-theme", "dark");
    localStorage.setItem("theme", "dark");
  } else {
    document.documentElement.setAttribute("data-theme", "light");
    localStorage.setItem("theme", "light");
  }
}

if (currentTheme) {
  document.documentElement.setAttribute("data-theme", currentTheme);
  if (currentTheme === "dark") {
    toggleSwitch.checked = true;
  }
}
toggleSwitch.addEventListener("change", switchTheme);

// Js modal / Popup ------------------

const modal = document.querySelector(".mod");
const modal_container = document.querySelector(".modal_container");
const exit = document.querySelector(".closing");
if (modal) {
  modal.addEventListener("click", () => {
    modal_container.classList.toggle("active");
  });
}

exit.addEventListener("click", () => {
  modal_container.classList.toggle("active");
});

// affichage de la recherche

const addSearch = document.getElementById("search");

if (addSearch) {
  addSearch.addEventListener("keyup", () => {
    setTimeout(() => {
      const results = document.querySelector(".results");
      if (results) {
        results.style.display = "flex";
      }
    }, 400);
  });
}

// display none de la div resultat si on clic a coter

const body = document.querySelector("body");
const results = document.querySelector(".results");

if (results) {
  body.addEventListener("click", (e) => {
    if (!e.target.closest(".results")) {
      results.style.display = "none";
    }
  });
}

// ouverture du menu au clic du bouton index

if (document.querySelector("#bb"))
  document.getElementById("bb").addEventListener("click", (e) => {
    e.preventDefault();
  });

// Apparition des réponses

const more = document.querySelector(".plus");
const response = document.querySelector(".response");

if (more) {
  more.addEventListener("click", (e) => {
    e.preventDefault();
    response.classList.toggle("response-click");
  });
}

const greencheck = document.querySelector(".greencheck");
const yellowcheck = document.querySelector(".yellowcheck");
const redcheck = document.querySelector(".redcheck");
const cadre = document.querySelector(".cardunderskill");

// If the checkbox is checked, display the output text

const radioInputs = document.querySelectorAll(".radio-input");
radioInputs.forEach((i) => {
  i.addEventListener("click", function () {
    const card = this.parentElement.parentElement;

    if (this.classList.contains("greencheck")) {
      card.style.borderTop = "3px solid #8effa7";
    } else if (this.classList.contains("yellowcheck")) {
      card.style.borderTop = "3px solid #ffbb00";
    } else if (this.classList.contains("redcheck")) {
      card.style.borderTop = "3px solid #ff4444";
    }
  });
});

// if Check Box don't check

const nombreskill = document.querySelector(
  ".cardskill-container"
).childElementCount;

console.log(nombreskill);

const btn = document.querySelector(".btn-search");
const radioButtons = document.querySelectorAll(".radio-input");

const inputhidden = document.querySelector("#resultatskillcheck");
console.log(inputhidden);

let x = 0;
btn.addEventListener("click", () => {
  var selectedSize = "/";
  let i = 0;
  for (const radioButton of radioButtons) {
    if (radioButton.checked) {
      selectedSize = selectedSize + radioButton.value;
      // break;
      i++;
    }
  }
  // show the output:
  selectedSize = selectedSize.substring(1);
  
  let nbrchecked = selectedSize.length;
  // Si le nombre de case check et = au nombre de skill alors href
  if (nbrchecked == nombreskill) {
    const buttonfini = document.querySelector(".btn-search").parentElement;
    buttonfini.href = "testevaluation.php?resultatskill="+ selectedSize;
  }
});
