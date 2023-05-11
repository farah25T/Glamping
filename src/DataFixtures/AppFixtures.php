<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $event = new Event();
        $event->setName('Camp Abdelmoula');  
        $datedeb= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-04');
        $datefin= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-09');
        $event->setDateDebut($datedeb);
        $event->setDateFin($datefin);
        $event->setPlace('desert');
        $event->setCity('Douz');
        $event->setCountry('Tunisia');
        $event->setPrice(120);
        $event->setNbrGuestsMax(15);
        $event->setImgPath('assets/images/EventPageImages/Events/');
        $event->setLatitude(32.86060468468186);
        $event->setLongitude(9.122794054431811);
        $manager->persist($event);

        $event2 = new Event();
        $event2->setName('Campement Zmela');  
        $datedeb2= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-02');
        $datefin2= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-04');
        $event2->setDateDebut($datedeb2);
        $event2->setDateFin($datefin2);
        $event2->setPlace('desert');
        $event2->setCity('Douz');
        $event2->setCountry('Tunisia');
        $event2->setPrice(60);
        $event2->setNbrGuestsMax(8);
        $event2->setImgPath('assets/images/EventPageImages/Events/');
        $event2->setLatitude(32.859192811386116);
        $event2->setLongitude(9.569452864305156);
        $manager->persist($event2);


        $event3 = new Event();
        $event3->setName('EL KAHENA: Residence et camping');  
        $datedeb3= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-20');
        $datefin3= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-25');
        $event3->setDateDebut($datedeb3);
        $event3->setDateFin($datefin3);
        $event3->setPlace('beach');
        $event3->setCity('Sfax');
        $event3->setCountry('Tunisia');
        $event3->setPrice(85);
        $event3->setNbrGuestsMax(20);
        $event3->setImgPath('assets/images/EventPageImages/Events/');
        $event3->setLatitude(35.0204208294985);
        $event3->setLongitude(11.006126644178776);
        $manager->persist($event3);




        $event4 = new Event();
        $event4->setName('Camp Mars');  
        $datedeb4= DateTimeImmutable::createFromFormat('Y-m-d','2023-03-17');
        $datefin4= DateTimeImmutable::createFromFormat('Y-m-d','2023-03-20');
        $event4->setDateDebut($datedeb4);
        $event4->setDateFin($datefin4);
        $event4->setPlace('desert');
        $event4->setCity('Jebil National Park');
        $event4->setCountry('Tunisia');
        $event4->setPrice(135);
        $event4->setNbrGuestsMax(15);
        $event4->setImgPath('assets/images/EventPageImages/Events/');
        $event4->setLatitude(32.86371488699911);
        $event4->setLongitude(9.106550393461834);
        $manager->persist($event4);



        
        $event5 = new Event();
        $event5->setName('Campement OASIS Ksar Guilane');  
        $datedeb5= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-23');
        $datefin5= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-26');
        $event5->setDateDebut($datedeb5);
        $event5->setDateFin($datefin5);
        $event5->setPlace('desert');
        $event5->setCity('Kebili');
        $event5->setCountry('Tunisia');
        $event5->setPrice(112);
        $event5->setNbrGuestsMax(17);
        $event5->setImgPath('assets/images/EventPageImages/Events/');
        $event5->setLatitude(32.99058520442253);
        $event5->setLongitude(9.642165622744162);
        $manager->persist($event5);


        
        $event6 = new Event();
        $event6->setName('Camping Testour');  
        $datedeb6= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-5');
        $datefin6= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-11');
        $event6->setDateDebut($datedeb6);
        $event6->setDateFin($datefin6);
        $event6->setPlace('forest');
        $event6->setCity('Testour');
        $event6->setCountry('Tunisia');
        $event6->setPrice(90);
        $event6->setNbrGuestsMax(12);
        $event6->setImgPath('assets/images/EventPageImages/Events/');
        $event6->setLatitude(36.56467903454466);
        $event6->setLongitude(9.437624302522751);
        $manager->persist($event6);




        $event7 = new Event();
        $event7->setName('Camping Welja');  
        $datedeb7= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-12');
        $datefin7= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-16');
        $event7->setDateDebut($datedeb7);
        $event7->setDateFin($datefin7);
        $event7->setPlace('forest');
        $event7->setCity('Ain Draham');
        $event7->setCountry('Tunisia');
        $event7->setPrice(80);
        $event7->setNbrGuestsMax(15);
        $event7->setImgPath('assets/images/EventPageImages/Events/');
        $event7->setLatitude(36.74811751034004);
        $event7->setLongitude(8.727544998828314);
        $manager->persist($event7);


        

        $event8 = new Event();
        $event8->setName('Camping Bellif');  
        $datedeb8= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-01');
        $datefin8= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-04');
        $event8->setDateDebut($datedeb8);
        $event8->setDateFin($datefin8);
        $event8->setPlace('forest');
        $event8->setCity('Nefza');
        $event8->setCountry('Tunisia');
        $event8->setPrice(65);
        $event8->setNbrGuestsMax(13);
        $event8->setImgPath('assets/images/EventPageImages/Events/');
        $event8->setLatitude(37.06198333750465);
        $event8->setLongitude(9.04853045125751);
        $manager->persist($event8);



        $event9 = new Event();
        $event9->setName('Camping Beni MTir');  
        $datedeb9= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-26');
        $datefin9= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-29');
        $event9->setDateDebut($datedeb9);
        $event9->setDateFin($datefin9);
        $event9->setPlace('forest');
        $event9->setCity('Beni MTir');
        $event9->setCountry('Tunisia');
        $event9->setPrice(85);
        $event9->setNbrGuestsMax(17);
        $event9->setImgPath('assets/images/EventPageImages/Events/');
        $event9->setLatitude(36.7447383135521);
        $event9->setLongitude(8.733735012983802);
        $manager->persist($event9);



        
        $event10 = new Event();
        $event10->setName('Camping El-Mrij');  
        $datedeb10= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-13');
        $datefin10= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-15');
        $event10->setDateDebut($datedeb10);
        $event10->setDateFin($datefin10);
        $event10->setPlace('forest');
        $event10->setCity('Aim Drahim');
        $event10->setCountry('Tunisia');
        $event10->setPrice(70);
        $event10->setNbrGuestsMax(10);
        $event10->setImgPath('assets/images/EventPageImages/Events/');
        $event10->setLatitude(36.75596362219091);
        $event10->setLongitude(8.686831466610414);
        $manager->persist($event10);



        $event11 = new Event();
        $event11->setName('ZenCamp');  
        $datedeb11= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-16');
        $datefin11= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-18');
        $event11->setDateDebut($datedeb11);
        $event11->setDateFin($datefin11);
        $event11->setPlace('forest');
        $event11->setCity('Aim Drahim');
        $event11->setCountry('Tunisia');
        $event11->setPrice(60);
        $event11->setNbrGuestsMax(8);
        $event11->setImgPath('assets/images/EventPageImages/Events/');
        $event11->setLatitude(36.80733397623433);
        $event11->setLongitude(8.77687911534302);
        $manager->persist($event11);




        $event12 = new Event();
        $event12->setName('Camping Ain Soltane');  
        $datedeb12= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-19');
        $datefin12= DateTimeImmutable::createFromFormat('Y-m-d','2023-06-21');
        $event12->setDateDebut($datedeb12);
        $event12->setDateFin($datefin12);
        $event12->setPlace('forest');
        $event12->setCity('Jendouba');
        $event12->setCountry('Tunisia');
        $event12->setPrice(110);
        $event12->setNbrGuestsMax(15);
        $event12->setImgPath('assets/images/EventPageImages/Events/');
        $event12->setLatitude(36.52625902584102);
        $event12->setLongitude(8.337336608823147);
        $manager->persist($event12);



        $event13 = new Event();
        $event13->setName('Jazirat Qurayyat');  
        $datedeb13= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-16');
        $datefin13= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-19');
        $event13->setDateDebut($datedeb13);
        $event13->setDateFin($datefin13);
        $event13->setPlace('beach');
        $event13->setCity('Monastir');
        $event13->setCountry('Tunisia');
        $event13->setPrice(280);
        $event13->setNbrGuestsMax(25);
        $event13->setImgPath('assets/images/EventPageImages/Events/');
        $event13->setLatitude(35.79993144118769);
        $event13->setLongitude(11.035579109933803);
        $manager->persist($event13);



        $event14 = new Event();
        $event14->setName('Cap Angela, Bizerte');  
        $datedeb14= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-04');
        $datefin14= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-10');
        $event14->setDateDebut($datedeb14);
        $event14->setDateFin($datefin14);
        $event14->setPlace('beach');
        $event14->setCity('Bizerte');
        $event14->setCountry('Tunisia');
        $event14->setPrice(150);
        $event14->setNbrGuestsMax(17);
        $event14->setImgPath('assets/images/EventPageImages/Events/');
        $event14->setLatitude(37.34694703925487);
        $event14->setLongitude(9.742268334494325);
        $manager->persist($event14);





        $event15 = new Event();
        $event15->setName('Cap Zebib');  
        $datedeb15= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-12');
        $datefin15= DateTimeImmutable::createFromFormat('Y-m-d','2023-08-15');
        $event15->setDateDebut($datedeb15);
        $event15->setDateFin($datefin15);
        $event15->setPlace('beach');
        $event15->setCity('Metline');
        $event15->setCountry('Tunisia');
        $event15->setPrice(130);
        $event15->setNbrGuestsMax(23);
        $event15->setImgPath('assets/images/EventPageImages/Events/');
        $event15->setLatitude(37.265440278616445);
        $event15->setLongitude(10.067959378237292);
        $manager->persist($event15);



        $event16 = new Event();
        $event16->setName('Korbous, Ain Kanassira');  
        $datedeb16= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-09');
        $datefin16= DateTimeImmutable::createFromFormat('Y-m-d','2023-07-11');
        $event16->setDateDebut($datedeb16);
        $event16->setDateFin($datefin16);
        $event16->setPlace('beach');
        $event16->setCity('Korbous');
        $event16->setCountry('Tunisia');
        $event16->setPrice(180);
        $event16->setNbrGuestsMax(15);
        $event16->setImgPath('assets/images/EventPageImages/Events/');
        $event16->setLatitude(36.84037305198067);
        $event16->setLongitude(10.572060547694466);
        $manager->persist($event16);




        
        $event17 = new Event();
        $event17->setName('Oued Zitoun');  
        $datedeb17= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-09');
        $datefin17= DateTimeImmutable::createFromFormat('Y-m-d','2023-05-11');
        $event17->setDateDebut($datedeb17);
        $event17->setDateFin($datefin17);
        $event17->setPlace('forest');
        $event17->setCity('Bizerte');
        $event17->setCountry('Tunisia');
        $event17->setPrice(75);
        $event17->setNbrGuestsMax(12);
        $event17->setImgPath('assets/images/EventPageImages/Events/');
        $event17->setLatitude(37.052375862201494);
        $event17->setLongitude(9.38729097287926);
        $manager->persist($event17);


        $event18 = new Event();
        $event18->setName('Camping Welja');  
        $datedeb18= DateTimeImmutable::createFromFormat('Y-m-d','2022-06-10');
        $datefin18= DateTimeImmutable::createFromFormat('Y-m-d','2022-06-12');
        $event18->setDateDebut($datedeb18);
        $event18->setDateFin($datefin18);
        $event18->setPlace('forest');
        $event18->setCity('Ain Draham');
        $event18->setCountry('Tunisia');
        $event18->setPrice(70);
        $event18->setNbrGuestsMax(17);
        $event18->setImgPath('assets/images/EventPageImages/Events/');
        $event18->setLatitude(36.74811751034004);
        $event18->setLongitude(8.727544998828314);
        $manager->persist($event18);


        $event19 = new Event();
        $event19->setName('Jazirat Qurayyat');  
        $datedeb19= DateTimeImmutable::createFromFormat('Y-m-d','2022-07-12');
        $datefin19= DateTimeImmutable::createFromFormat('Y-m-d','2022-07-16');
        $event19->setDateDebut($datedeb19);
        $event19->setDateFin($datefin19);
        $event19->setPlace('beach');
        $event19->setCity('Monastir');
        $event19->setCountry('Tunisia');
        $event19->setPrice(170);
        $event19->setNbrGuestsMax(28);
        $event19->setImgPath('assets/images/EventPageImages/Events/');
        $event19->setLatitude(35.79993144118769);
        $event19->setLongitude(11.035579109933803);
        $manager->persist($event19);


        $event20 = new Event();
        $event20->setName('Campement OASIS Ksar Guilane');  
        $datedeb20= DateTimeImmutable::createFromFormat('Y-m-d','2022-10-20');
        $datefin20= DateTimeImmutable::createFromFormat('Y-m-d','2022-10-24');
        $event20->setDateDebut($datedeb20);
        $event20->setDateFin($datefin20);
        $event20->setPlace('desert');
        $event20->setCity('Kebili');
        $event20->setCountry('Tunisia');
        $event20->setPrice(110);
        $event20->setNbrGuestsMax(20);
        $event20->setImgPath('assets/images/EventPageImages/Events/');
        $event20->setLatitude(32.99058520442253);
        $event20->setLongitude(9.642165622744162);
        $manager->persist($event20);


        $event21 = new Event();
        $event21->setName('Camp Abdelmoula');  
        $datedeb21= DateTimeImmutable::createFromFormat('Y-m-d','2021-09-04');
        $datefin21= DateTimeImmutable::createFromFormat('Y-m-d','2021-09-09');
        $event21->setDateDebut($datedeb21);
        $event21->setDateFin($datefin21);
        $event21->setPlace('desert');
        $event21->setCity('Douz');
        $event21->setCountry('Tunisia');
        $event21->setPrice(110);
        $event21->setNbrGuestsMax(20);
        $event21->setImgPath('assets/images/EventPageImages/Events/');
        $event21->setLatitude(32.86060468468186);
        $event21->setLongitude(9.122794054431811);
        $manager->persist($event21);



        $event22 = new Event();
        $event22->setName('Cap Zebib');  
        $datedeb22= DateTimeImmutable::createFromFormat('Y-m-d','2021-07-02');
        $datefin22= DateTimeImmutable::createFromFormat('Y-m-d','2021-07-07');
        $event22->setDateDebut($datedeb22);
        $event22->setDateFin($datefin22);
        $event22->setPlace('beach');
        $event22->setCity('Metline');
        $event22->setCountry('Tunisia');
        $event22->setPrice(150);
        $event22->setNbrGuestsMax(16);
        $event22->setImgPath('assets/images/EventPageImages/Events/');
        $event22->setLatitude(37.265440278616445);
        $event22->setLongitude(10.067959378237292);
        $manager->persist($event22);



        $event23 = new Event();
        $event23->setName('EL KAHENA: Residence et camping');  
        $datedeb23= DateTimeImmutable::createFromFormat('Y-m-d','2021-08-13');
        $datefin23= DateTimeImmutable::createFromFormat('Y-m-d','2021-08-15');
        $event23->setDateDebut($datedeb23);
        $event23->setDateFin($datefin23);
        $event23->setPlace('beach');
        $event23->setCity('Sfax');
        $event23->setCountry('Tunisia');
        $event23->setPrice(80);
        $event23->setNbrGuestsMax(20);
        $event23->setImgPath('assets/images/EventPageImages/Events/');
        $event23->setLatitude(35.0204208294985);
        $event23->setLongitude(11.006126644178776);
        $manager->persist($event23);



        $event24 = new Event();
        $event24->setName('Camping El-Mrij');  
        $datedeb24= DateTimeImmutable::createFromFormat('Y-m-d','2023-10-22');
        $datefin24= DateTimeImmutable::createFromFormat('Y-m-d','2023-10-25');
        $event24->setDateDebut($datedeb24);
        $event24->setDateFin($datefin24);
        $event24->setPlace('forest');
        $event24->setCity('Aim Drahim');
        $event24->setCountry('Tunisia');
        $event24->setPrice(60);
        $event24->setNbrGuestsMax(17);
        $event24->setImgPath('assets/images/EventPageImages/Events/');
        $event24->setLatitude(36.75596362219091);
        $event24->setLongitude(8.686831466610414);
        $manager->persist($event24);



        $event25 = new Event();
        $event25->setName('Campement OASIS Ksar Guilane');  
        $datedeb25= DateTimeImmutable::createFromFormat('Y-m-d','2023-10-27');
        $datefin25= DateTimeImmutable::createFromFormat('Y-m-d','2023-10-29');
        $event25->setDateDebut($datedeb25);
        $event25->setDateFin($datefin25);
        $event25->setPlace('desert');
        $event25->setCity('Kebili');
        $event25->setCountry('Tunisia');
        $event25->setPrice(140);
        $event25->setNbrGuestsMax(25);
        $event25->setImgPath('assets/images/EventPageImages/Events/');
        $event25->setLatitude(32.99058520442253);
        $event25->setLongitude(9.642165622744162);
        $manager->persist($event25);

        $manager->flush();
    }
}
