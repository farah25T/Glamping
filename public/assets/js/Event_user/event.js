const liked = document.querySelector(".liked_continer");
const liked_card = document.querySelector(".liked");
const not_liked = document.querySelector(".not_liked");

fetch("/event_liked")
  .then((response) => response.json())
  .then((response) => {
    p = 0;
    if (response[p])
        while( response[p])
        {
            const card$p = liked_card.cloneNode(true);
            console.log(liked_card)
            console.log(card$p)
            Event_name= card$p.querySelector('.descri')

            Event_name.innerHTML =response[p].name
            const Event_link = card$p.querySelector('a');
            Event_link.setAttribute('href',"http://127.0.0.1:8000/event/"+response[p].image );

            Image_event = card$p.querySelector('.image');
            Image_event.setAttribute('src', "assets/images/EventPageImages/Events/"+response[p].image+"/1.jpg");
            Price_event = card$p.querySelector('.price');
            Price_event.innerHTML="<br>Price Par Personne  =  "+response[p].price+"<br> Date Debut = "+response[p].date+"<br>Place = "+response[p].place;

            card$p.setAttribute('class','liked' )
            card$p.removeAttribute('hidden')
            liked.appendChild(card$p);
            p+=1;
        }
    else
        {
            not_liked.removeAttribute('hidden');
            liked.appendChild(not_liked)
        }


    })
    .catch(error => {

            console.error('Error:', error);
        }
    );








const not_booked = document.querySelector('.not_booked');

const booked=document.querySelector('.booked_continer');
const booked_card = document.querySelector('.booked');
fetch('/event_booked')
    .then(response => response.json())
    .then(response => {
        let p = 0;
       if(response[p])
           while (response[p]) {
               const card$p = booked_card.cloneNode(true);
               card$p.hidden=false;

               const Event_name = card$p.querySelector('.descri');
               Event_name.innerHTML = response[p].name;
               const Event_link = card$p.querySelector('a');
               Event_link.setAttribute('href',"http://127.0.0.1:8000/event/"+response[p].image );


               const Price_event = card$p.querySelector('.price');
               Price_event.innerHTML = "Your Guests Number :   " + response[p].guests_Number + "<br>Total Price :" + response[p].price * response[p].guests_Number + "<br>Date Debut = " + response[p].date;
               console.log(card$p)
               const Image_event = card$p.querySelector('.image');
               Image_event.setAttribute('src', "assets/images/EventPageImages/Events/" + response[p].image + "/1.jpg");

               card$p.setAttribute('class', 'booked');
               card$p.removeAttribute('hidden');
               console.log( booked.appendChild(card$p));
               p += 1;
           }
       else
       {
           not_booked.removeAttribute('hidden');
          
           booked.appendChild(not_booked)
       }
    })
    .catch(error => {
        console.error('Error:', error);
    });





