window.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        document.querySelector('.choice').classList.add('show-choice');
    }, 2000);
});

const booked = document.querySelector('#booked');
const booked_bouton = document.querySelector('#booked_bouton');
const saved = document.querySelector('#saved');
const saved_bouton = document.querySelector('#saved_bouton');
const liked = document.querySelector('#liked');
const liked_bouton = document.querySelector('#liked_bouton');
const saved_card = document.querySelector('#hidden');
const booked_card = document.querySelector('#bookedd');
const liked_card = document.querySelector('.likedd');



console.log(saved_card)

console.log(booked_card)









saved_bouton.addEventListener('click', function() {



    if (!liked.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.liked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        liked.hidden=true;

    }
    if (!booked.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.booked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        booked.hidden=true;

    }
   if(saved.hasAttribute('hidden'))
   {saved.removeAttribute('hidden');
       fetch('/event_saved')
           .then(response => response.json())
           .then(response => {
               p=0;
               while( response[p])
               {
                   const card$p = saved_card.cloneNode(true);
                   Event_name= card$p.querySelector('.descri')

                   Event_name.innerHTML =response[p].name


                   card$p.setAttribute('class','saved_card_eff' )
                   console.log(card$p);
                   card$p.removeAttribute('hidden')
                   saved.appendChild(card$p);
                   p+=1;
               }


           })
           .catch(error => {

                   console.error('Error:', error);
               }
           );
   }
   else
   {
       const temp_card = document.querySelectorAll('.saved_card_eff')
       p=0
    while(temp_card[p])
    {
        temp_card[p].remove();
        p++;
    }
       saved.hidden=true;
   }


});



liked_bouton.addEventListener('click', function() {



    if (!saved.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.saved_card_eff')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        saved.hidden=true;

    }
    if (!booked.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.booked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        booked.hidden=true;

    }

    if(liked.hasAttribute('hidden'))
    {liked.removeAttribute('hidden');
        fetch('/event_liked')
            .then(response => response.json())
            .then(response => {
                     p=0;

                while( response[p])
                {
                    const card$p = liked_card.cloneNode(true);
                    console.log(liked_card)
                    console.log(card$p)
                    Event_name= card$p.querySelector('.descri')

                    Event_name.innerHTML =response[p].name

                    Image_event = card$p.querySelector('.img');
                    console.log(Image_event)
                    Image_event.setAttribute('src', "assets/images/EventPageImages/Events/"+response[p].image+"/1.jpg");
                    Price_event = card$p.querySelector('.price');
                    Price_event.innerHTML="<br>Price Par Personne  =  "+response[p].price+"<br> Date Debut = "+response[p].date+"<br>Place = "+response[p].place;

                    card$p.setAttribute('class','liked' )
                    card$p.removeAttribute('hidden')
                    liked.appendChild(card$p);
                    p+=1;
                }


            })
            .catch(error => {

                    console.error('Error:', error);
                }
            );
    }
    else
    {
        const temp_card = document.querySelectorAll('.liked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        liked.hidden=true;
    }


});









booked_bouton.addEventListener('click', function() {



    if (!liked.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.liked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        liked.hidden=true;

    }
    if (!saved.hasAttribute('hidden'))
    {
        const temp_card = document.querySelectorAll('.saved_card_eff')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        saved.hidden=true;

    }

    if(booked.hasAttribute('hidden'))
    {booked.removeAttribute('hidden');
        fetch('/event_booked')
            .then(response => response.json())
            .then(response => {
                p=0;
                while( response[p])
                {
                    const card$p = booked_card.cloneNode(true);

                    Event_name= card$p.querySelector('.descri')

                    Event_name.innerHTML =response[p].name
                   Price_event = card$p.querySelector('.price');
                   Price_event.innerHTML="Your Guests Number="+response[p].guests_Number+"<br>ToTal Price =  "+response[p].price*response[p].guests_Number+"<br> Date Debut = "+response[p].date;



                    Image_event = card$p.querySelector('.img');
                    Image_event.setAttribute('src', "assets/images/EventPageImages/Events/"+response[p].image+"/1.jpg");

                    card$p.setAttribute('class','booked' )

                    card$p.removeAttribute('hidden')
                    booked.appendChild(card$p);
                    p+=1;
                }


            })
            .catch(error => {

                    console.error('Error:', error);
                }
            );
    }
    else
    {
        const temp_card = document.querySelectorAll('.booked')
        p=0
        while(temp_card[p])
        {
            temp_card[p].remove();
            p++;
        }
        booked.hidden=true;
    }


});














var type = new Typed(".textlin", {
    strings: ["Check  ", "Book  ", "Like  "],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true,
});
