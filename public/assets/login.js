const loginsec = document.querySelector(".login-section");
const loginlink = document.querySelector(".login-link");
const registerlink = document.querySelector(".register-link");
registerlink.addEventListener("click", (e) => {
  loginsec.classList.add("active");
});
loginlink.addEventListener("click", (e) => {
  loginsec.classList.remove("active");
});

const input = document.getElementById("myInput");
input.addEventListener("input", () => {
  if (input.value !== "") {
    input.classList.add("has-value");
  } else {
    input.classList.remove("has-value");
  }
});
 function togglePasswordVisibility(iconElement, passwordId) {
   const passwordInput = document.getElementById(passwordId);
   const icon = iconElement.querySelector("i");

   if (passwordInput.type === "password") {
     passwordInput.type = "text";
     icon.classList.remove("fa-eye");
     icon.classList.add("fa-eye-slash");
   } else {
     passwordInput.type = "password";
     icon.classList.remove("fa-eye-slash");
     icon.classList.add("fa-eye");
   }
 }

 document.getElementById("icon1").addEventListener("click", () => {
   togglePasswordVisibility(document.getElementById("icon1"), "password1");
 });

 document.getElementById("icon2").addEventListener("click", () => {
   togglePasswordVisibility(document.getElementById("icon2"), "password2");
 });
