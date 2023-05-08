const heartIcon = document.querySelector(".like-button .heart-icon");
const likesAmountLabel = document.querySelector(".like-button .likes-amount");

const likesAmount = document.getElementById("likes");
let likes = parseInt(likesAmount.innerText);

const Path = window.location.pathname;
const ep = Path.split("/");
const event_id = ep[ep.length - 1];


heartIcon.addEventListener("click", async () => {
  if (!heartIcon.classList.contains("liked")) {
    fetch(`http://127.0.0.1:8000/event/${event_id}/like`, {
      method: "POST",
      mode:"no-cors"
    })
      .then((response) => {
        if (response.redirected) {
          // handle redirection
          window.location.replace("http://127.0.0.1:8000/authentication");
        } 
        else{
          likes++;
          heartIcon.classList.toggle("liked");
          likesAmount.innerText = likes;
        }
      });  
  } else {
    fetch(`http://127.0.0.1:8000/event/${event_id}/dislike`, {
      method: "POST"
    })
      .then((response) => {
        if (response.redirected) {
          // handle redirection
          window.location.replace("http://127.0.0.1:8000/authentication");
        } 
        else{
          likes--;
          heartIcon.classList.toggle("liked");
          likesAmount.innerText = likes;
        }
      }); 
  }
});
