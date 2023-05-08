 
      var type = new Typed(".textline", {
        strings: ["have Fun !", "Discover Our Country !", "Make Memories !", "Laugh !"],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true,
      });

     function showPopup() {
       var popup = document.getElementById("popup");
       popup.style.display = "block";
     }

     function hidePopup() {
       var popup = document.getElementById("popup");
       popup.style.display = "none";
     }
const fileInput = document.getElementById("user_image");
const submitButton = document.getElementById("submit-btn");

fileInput.addEventListener("change", () => {
  if (fileInput.value) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true;
  }
});