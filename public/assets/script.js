const loginsec=document.querySelector('.login-section')
const loginlink = document.querySelector(".login-link");
const registerlink = document.querySelector(".register-link");
registerlink.addEventListener('click',(e)=>{
  loginsec.classList.add('active');

})
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