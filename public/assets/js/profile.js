 
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
