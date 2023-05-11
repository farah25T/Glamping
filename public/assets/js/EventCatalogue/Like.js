const Bookbtns = document.querySelectorAll("button[id^=book]");
const LikeToggles = document.querySelectorAll("input[id^=like]");
const protocol = window.location.origin.split("/")[0].slice(0, -1);

Bookbtns.forEach((btn) => {
  btn.addEventListener("click", (event) => {
    const fullid = event.target.id;
    const id = fullid.split("-")[1];
    window.location.assign(`${protocol}://127.0.0.1:8000/event/${id}`);
  });
});
LikeToggles.forEach((like) => {
  like.addEventListener("click", (event) => {
    const fullid = event.target.id;
    const id = fullid.split("-")[1];
    if (!event.target.checked) {
      fetch(`${protocol}://127.0.0.1:8000/event/${id}/dislike`, {
        method: "POST",
      })
        .then((response) => {
          if (response.redirected) {
            // handle redirection
            event.target.checked = false;
            window.location.assign(
              `${protocol}://127.0.0.1:8000/authentication`
            );
          }
        })
        .catch((err) => {
          console.log(err);
          event.target.checked = false;
        });
    } else {
      fetch(`${protocol}://127.0.0.1:8000/event/${id}/like`, {
        method: "POST",
      })
        .then((response) => {
          if (response.redirected) {
            // handle redirection
            event.target.checked = true;
            window.location.assign(
              `${protocol}://127.0.0.1:8000/authentication`
            );
          }
        })
        .catch((err) => {
          console.log(err);
          event.target.checked = true;
        });
    }
  });
});
