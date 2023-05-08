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




console.log(saved_card)









saved_bouton.addEventListener('click', function() {



    if (!liked.hasAttribute('hidden'))
        liked.toggleAttribute('hidden');
    if (!booked.hasAttribute('hidden'))
        booked.toggleAttribute('hidden');
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
        const temp_card = document.querySelectorAll('.saved_card_eff')
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
        const temp_card = document.querySelectorAll('.saved_card_eff')
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
        const temp_card = document.querySelectorAll('.saved_card_eff')
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
                    const card$p = saved_card.cloneNode(true);
                    Event_name= card$p.querySelector('.descri')

                    Event_name.innerHTML =response[p].name


                    card$p.setAttribute('class','saved_card_eff' )

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
        const temp_card = document.querySelectorAll('.saved_card_eff')
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
