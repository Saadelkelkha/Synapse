function blurEmail1(){
  var email = document.getElementById("logemail");
  var emailError = document.getElementById("emailerror");

  var email_patt = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;

  if (!email_patt.test(email.value)) {
      emailError.innerText = "Tapez votre email au format valide.";
      emailError.style.display = "block";
  } else {
    emailError.style.display = "none";
  }
}

function bluryear(){
  var year = document.getElementById("year");
  var yearError = document.getElementById("yearerror");
  var month = document.getElementById("month");

  if(year.value == ""){
    yearError.innerText = "Tapez votre année d'anniversaire dans un format valide.";
    yearError.style.display = "block";
  }else{
    yearError.style.display = "none";
    month.removeAttribute("disabled");
  }
}
function checkmonth(){
var month = document.getElementById("month");
var days = document.getElementById("day");
var year = document.getElementById("year");
var iskabissa = false;

if(month.value == "1" || month.value == "3" || month.value == "5" || month.value == "7" || month.value == "8" || month.value == "10" || month.value == "12"){
  days.setAttribute("max", "31");
}else{
  if(month.value == "4" || month.value == "6" || month.value == "9" || month.value == "11"){
    days.setAttribute("max", "30");
  }else{
    iskabissa = (parseInt(year.value) % 4 === 0 && parseInt(year.value) % 100 !== 0) || (parseInt(year.value) % 400 === 0);

    if(iskabissa){
      days.setAttribute("max", "29");
    }else{
      days.setAttribute("max", "28");
    }
  }
}
days.removeAttribute("disabled");
}

function blurmonth(event){
var month = document.getElementById("month");
var monthError = document.getElementById("montherror");

if(month.value == ""){
  monthError.innerText = "Tapez votre mois d'anniversaire au format valide.";
  monthError.style.display = "block";
} else {
  monthError.style.display = "none";
  checkmonth();
}

event.preventDefault()
}

function handlePrenom(event) {
const logprenom = document.getElementById("logprenom").value;
const prenomerror = document.getElementById("prenomerror");
const prenomPattern = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/;

if (!prenomPattern.test(logprenom)) {
    prenomerror.innerText = "Tapez votre Prenom.";
    prenomerror.style.display = "block";
} else {
    prenomerror.style.display = "none";
}
event.preventDefault();
}

function handleNom(event) {
const lognom = document.getElementById("lognom").value;
const nomerror = document.getElementById("nomerror");
const nomPattern = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/;

if (!nomPattern.test(lognom)) {
    nomerror.innerText = "Tapez votre Nom.";
    nomerror.style.display = "block";
} else {
    nomerror.style.display = "none";
}
event.preventDefault();
}

function handleEmail() {
const logemail = document.getElementById("email");
const email2error = document.getElementById("email2error");
const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

if (!emailPattern.test(logemail.value)) {
    email2error.innerText = "Tapez votre email au format valide.";
    email2error.style.display = "block";
} else {
    email2error.style.display = "none";
}
}


function handlePassword(){
  const logpass = document.getElementById("password").value;
  const pass2error = document.getElementById("pass2error");
  const passwordPattern = /^.{8,}$/;

  if (!passwordPattern.test(logpass)) {
    pass2error.innerText = "Le mot de passe doit contenir au moins 8 caractères."
    pass2error.style.display = "block"
  } else {
    pass2error.style.display = "none"
  }
}
function createcompte(){
  const checkbox = document.getElementById("reg-log");
  checkbox.checked = !checkbox.checked;
}