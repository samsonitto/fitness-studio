# TTMS0900 (Web-palvelinohjelmointi) ja TTMS0500 (Webohjelmointi) Kurssijen yhdistetty harjoitustyö - Fitness Studio

## Tekijä

* Samson Azizyan (M3156)
* M3156 
* Versionumero 0.1
* [Fitness Studio](http://142.93.231.94/)


## Sisällysluettelo 

* [Vaatimusmäärittely](#vaatimusmäärittely)
    * [Sovelluksen yleiskuvaus](#sovelluksen-yleiskuvaus)
    * [Kohdeyleisö](#kohdeyleisö)
    * [Käyttöympäristö ja käytetyt teknologiat](#käyttöympäristö-ja-käytetyt-teknologiat)
    * [Käyttäjäroolit](#käyttäjäroolit)
    * [Ominaisuudet](#ominaisuudet)
    * [Käyttötapaukset](#käyttötapaukset)
    * [Hyväksyntätestit](#hyväksyntätestit)
    * [Käsitemalli](#käsitemalli)
    * [Luokkakaavio](#luokkamalli)
    * [Työnjako](#työnjako)
    * [Työaikasuunnitelma](#työaika-suunnitelma)
* [Loppuraportti](#loppuraportti)
    * [Asennus](#asennus)
    * [Tetoa ohjelmasta](#tietoa-ohjelmasta)
    * [Kuvaruutukaappaukset](#kuvaruutukaappaukset)
    * [Mukana tulevat tiedostot](#mukana-tulevat-tiedostot)
    * [Tietokanta](#tietokanta)
    * [Ongelmat, jatkokehitysideat](#ongelmat-jatkokehitysideat)
    * [Työmäärä](#työmäärä)
    * [Yhteenveto](#yhteenveto)

# Vaatimusmäärittely

## Sovelluksen yleiskuvaus

Tarkoituksena on suunnitella ja toteuttaa websovelluksen imaginääristä liikuntapalveluja tarjoavaa yritystä. Palvelun käyttäjät voisivat tehdä liikuntatuntivarauksia ja palvelun ylläpitäjät/vetäjät pystyisivät poistaamaan köyttäjiä tai antaamaan nille varauskieltoa.

## Kohdeyleisö

Kohdeyleisö on liikuntapalvelua tarjoavat yritykset ja niiden asiakkaat.

## Käyttöympäristö ja käytetyt teknologiat

* Laravel
* React.js
* node.js
* Mysql
* Javascript
* Jquery
* Php
* Visual Studio Code
* notepad++
* putty
* apache
* Digital Ocean
* Ubuntu Linux

## Käyttäjäroolit

### Asiakas

Asiakas käyttää sovellusta varatakseen liikuntatunteja ja nähdäkseen treenikalenterin.

### Admin / Vetäjä

Admin ylläpitää palvelua: lisää/poistaa tulevat liikuntatunnit, antaa varauskieltoa, poistaa käyttäjät

### Master

Master-käyttäjä ylläpitää palvelua: lisää/poistaa tulevat liikuntatunnit, antaa varauskieltoa, poistaa käyttäjät, ylläpitää admin/master/user käyttöoikeuksia

## Ominaisuudet

| Tunnus | Ominaisuus | Prioriteetti | Muuta |
| :-: | :-: | :-: | :-: |
| FT01 | [ Tunnusten luominen ja kirjautuminen](links/f1_login.md) | Pakollinen | |
| FT02 | [ Lisää/poistaa varauksia ](links/f2_bookings.md) | Pakollinen | |
| FT03 | [ Tunnusten poistaminen](links/f3_delete_account.md) | Pakollinen | |
| FT04 | [ Profiilin editointi](links/f4_edit_account.md) | Pakollinen | |
| FT05 | [ Admin/Master ominnaisuudet](links/f5_admin.md) | Nice to Have | |
| FT06 | [ Lisää/poista liikuntatunti ](links/f6_add_a_class.md) | Nice to Have | |


## Käyttötapaukset

### Tunnusten luominen ja kirjautuminen

```plantuml
@startuml
    Käyttäjä --> (Tunnusten luominen)
    Käyttäjä --> (Kirjautuminen)
@enduml
```
**Käyttötapauksen kuvaus**

1. Käyttäjä luo tunnukset
2. Käyttäjä kirjautuu palveluun

**Poikkeukset**
 
* P1 Käyttäjä ei täyttänyt kaikki kentät oikein, saa virheilmoituksen
* P2 Käyttäjä ei muista salasanaa, ottaa yhteyttä ylläpitoon
	
**Lopputulos**	

* Asiakas on luonut tunnukset ja on päässyt kirjautumaan iTool sovellukseen

**Käyttötiheys** 

* Tunnusten luominen: Kerran per sähköposti
* Kirjautuminen: rajaton

### Liikuntatuntien selailu, varaus ja poistaminen

```plantuml
@startuml
    Käyttäjä --> (Liikuntatuntien selailu) : Selaa
    Käyttäjä --> (Liikuntatunnin varaus) : Varaa
    Käyttäjä --> (Omien varausten selailu) : Selaa
    Käyttäjä --> (Omien varausten peruuttaminen) : Peruuttaa
    (varausten peruuttaminen) --> (Fitness Studio tietokanta) : Poistaa
@enduml
```

**Käyttötapauksen kuvaus**

1. Käyttäjä selaa tulevia liikuntatunteja
2. Käyttäjä varaa paikan liikuntatunnilla
3. Käyttäjä selaa omia varauksia
4. Käyttäjä peruuttaa varauksen
6. Sovellus poistaa varauksen tietokannasta

	
**Lopputulos**	

* Käyttäjä on varannut, tai poistanut varauksen

**Käyttötiheys** 

* Varaus: sen verran kun on vapaita paikkoja liikuntatunnilla
* Peruuts: kerran per varaus


### Tunnusten poistaminen

```plantuml
@startuml
    Käyttäjä --> (Tunnusten poistaminen)
    (Tunnusten poistaminen) --> (Fitness Studio tietokanta) : Poistaa
@enduml
```
**Käyttötapauksen kuvaus**

1. Käyttäjä poista tunnukset
2. Tunnukset poistetaan tietokannasta

**Lopputulos**	

* Käyttäjän tunnukset on poistettu tietokkannassa

**Käyttötiheys** 

* Kerran per sähköposti

## Hyväksyntätestit

| TestiID | Kuvaus |								
|:-:|:-:|
| AT01 | [Tunnusten luominen ja sovellukseen kirjautuminen](linkit/at1_tunnusten_luominen.md) |
| AT02 | [Liikuntatunnin varaus/peruutus](linkit/at2_add_class_.md) |
| AT03 | [Tunnusten editointi](linkit/at3_edit_profile.md) |
| AT04 | [Tunnusten poistaminen](linkit/at4_delete.md) |
| AT05 | [Admin/master ominaisuudet](linkit/at5_admin.md) |

## Käsitemalli

### Käsitteet

1. User: Fitness Studio sovelluksen käyttäjä
2. Booking: Liikuntatunnin varaus
3. Class: Liikuntatunnin tyyppi
4. Class_is_available: Tarjolla oleva liikuntatunti
5. Calendar: Liikuntakalenteri
6. Admin: Admin käyttäjä
7. Master: Master käyttäjä
8. Teacher: Admin/Master, joka vetää liikuntatunnin

```plantuml
@startuml
    User --|> Class_is_available
    Booking --|> User
    Booking --|> Class_is_available
    Class_is_available --|> Class
    Calendar --|> Class_is_available
    Calendar --|> Teacher
@enduml
```
## Luokkamalli

```plantuml
@startuml
    class User {
        +userID
        +userEmail
        #userPassword
        +userName
        +userPicture
        +userGroup
        +userStatus
        +addBooking()
        +cancelBooking()
        +addClass()
        +removeClass()
        +makeMaster()
        +makeAdmin()
        +unMaster()
        +unAdmin()
        #editEmail()
        #editPassword()
        +login()
        +logout()
    }
    
    class Booking {
        +bookingID
        +userID
        +classIsAvailableID
    }
    
    class ClassIsAvailable {
        +classIsAvailableID
        +teacherID
        +classID
        +startTime
        +endTime
    }
    
    class Class {
        +classID
        +className
        +classDescription
        +difficulty
        +capacity
    }
    
    class DB {
        GetUsersFromMysql()
        GetClassesFromMysql()
        GetBookingsFromMysql()
        GetCalendarFromMysql()
        AddBookingToMysql()
    }
    
    
    Booking --|> User
    User --> DB
    Booking --|> ClassIsAvailable
    ClassIsAvailable --|> Class
    User --> ClassIsAvaialble
    User --> Comment
    Booking --> DB
    ClassIsAvailable --> DB
@enduml
```

## Työnjako

Samson Azizyan
Suunnittelu, front end, back end, testit, Mysql database, Laravel.

## Työaika

* Viikko 47: Digital Ocean palvelimen setup, Laravel ympäristön asennus, mysql tietokannan
toteutus (20h)
* Viikko 48: Blade näkymät, reititys, tietokannan migratiot ja testidata, itseopiskelu, Reactin asennus Laravel ympäristöön, front end ohjelmointi, back end ohjelmointi (50h)
* Viikko 49: Dokumentointi, testaaminen, bugien korjaus (10h)

# Loppuraportti

## Asennus
* Sovellus on pakattu zip-pakkaukseen, pakkaus pitää purkkaa sellaisenaan
* Hakemistorakenteen pitää olla tasan tarkkaan sellainen kun pakkauksessa, koska sovellus käyttää 'images' - kansiotta kuvien tallentaamiseen ja esittämiseen
* Exe-tiedosto löytyy bin/Debug kansiosta
* Sovelluksen käyttöä varten pitää olla joko kirjautuneena labranetin tietokoneelle tai käyttää labranetin VPN-yhteyttä, koska tietokanta sijaitsee mysql.labranet palvelimella

## Tietoa ohjelmasta

Sovellus on toteutettu suunnitelman mukaan, ei poikennut vaatimusmäärittelystä.

### Toteutetut toiminnalliset vaatimukset

| Tunnus | Ominaisuus | Prioriteetti | Toteuttumisprosentti | Muuta |
| :-: | :-: | :-: | :-: | :-: |
| FT01 | [ Tunnusten luominen ja kirjautuminen](../liitteet/f1_login.md) | Pakollinen | 100% ||
| FT02 | [ Lisää/poistaa työkalu ](../liitteet/f2_tools.md) | Pakollinen | 100% ||
| FT03 | [ Tunnusten poistaminen](../liitteet/f3_delete_account.md) | Pakollinen | 100% ||
| FT04 | [ Mahdollisuus arvioida käyttäjiä ](../liitteet/f4_rating.md) | Nice to Have | 100% ||
| FT05 | [ Työkalujen kommentoiminen ](../liitteet/f5_comment.md) | Nice to Have | 70% | Kommentit ei esinny oikeassa järjestyksessä |
| FT06 | [ Työkalujen vuokraaminen ](../liitteet/f6_rentatool.md) | Pakollinen | 100% ||
| FT07 | [ Työkalujen palautus ](../liitteet/f7_returntool.md) | Pakollinen | 100% ||

### Toteuttamatta jääneet toiminnalliset vaatimukset

Ei jäänyt yhtään toiminnallista ominaisuutta/vaatimusta toteuttamatta, ainoa missä on ongelma on 'kommentit' - ei esinny oikeassa järjestyksessä käyttöliittymässä, muuten toimii.

### Yli alkuperäisten vaatimusten toteutetut toiminnallisuudet

Toteutin piilotetun ikkunan, jossa on toiminnallisuus, joka lisää käyttäjän asettaman määrän satunnaisia työkaluja testaamista varten. Käsiksi siihen ikkunaan pääsee painamalla F1
'AddATool' ikkunan auki ollessa. Sitä ennen 'Register'-ikkunalle tein samantyylisen toiminnallisuuden, joka ei ole niinkään piilotettu. Sieltä löytyy 'Fill'-button, jota klikkamalla
pystyy täyttämään kaikki rekiströintikentät satunnaisilla arvoilla, tämäkin ominaisuus on tehty testaamista varten.

## Kuvaruutukaappaukset

### 'Login'-ikkuna
<img src="images/itool_login.JPG" alt="iTool v1" width="400">

* Login ikkunassa pystyy kirjautumaan iTool-sovellukseen sisään tai siirtymään rekiströintiin.

### 'Register'-ikkuna
<img src="images/itool_register.JPG" alt="iTool v1" width="700">

* Register ikkunassa pystyy rekiströitymään iTool-palveluun, kaikki kentät on pakollisia, paitsi kuva.
* Löytyy myös 'Fill' nappi, jota klikkaamalla voi täyttää kentät satunnaisilla tiedoilla. Nappi on luotu testausta varten.

### 'Main'-ikkuna
<img src="images/itool_main.JPG" alt="iTool v1" width="900">

* Mainissa voi selailla ja vuokrata työkaluja.
* Datagridissa työkalua klikkaamalla voi nähdä työkalun kuvan ja tiedot yksityiskohtaisemmin ikkunan alaosassa.
* Vasemmassa laidassa on suodattimia, jotka suodattaa joko sijainnin tai kategorian mukaan.
* Yläpalkista löytyy 'Etsi'-kenttä, jonka avulla voi etsiä työkaluja nimen tai nimen osan mukaan.
* Profiilikuvaa klikkaamalla pääsee siirtymään 'User profile'-ikkunaan.
* Työkalua valitsemalla ja 'Comment'-nappia painamalla aukee 'Comment'-ikkuna.

### 'Commment'-ikkuna
<img src="images/itool_comment.JPG" alt="iTool v1" width="500">

* Comment ikkunassa voi jättää uusia kommentteja koskien kyseistä työkalua
* Voi myös vastata olemassa oleviin kommenteihin klikkaamalla kommenttia
* Kommentit jätetään painamalla 'Enter'-nappia

### 'Profile'-ikkuna
<img src="images/itool_profile.JPG" alt="iTool v1" width="800">

* Profiili-ikkunassa nähdään 3 listaa: "Omat työkalut", "Omat vuokratut työkalut" ja "Omat transaktiot"
* Työkaluja tai transaktioita valitsemalla pääsee näkemään niiden tiedot iksityiskohtaisemmin
* Valitsemalla työkalu "Omat työkalut" listasta ja painamalla 'Delete' nappia voidaan poistaa työkalu kokonaan
* Valitsemalla työkalu "Omat vuokratut työkalut" listasta ja painamalla 'Space' nappia voidaan palauttaa vuokratun työkalun omistajalleen
* Valitsemalla transaktio "Omat transaktiot" listasta ja painamalla 'Space' nappia voidaan antaa transaktion toiselle osapuolelle arvion
* Vasemassa laidassa on palkki, josta pääsee muokkaamaan omaa profiiliä

### 'Edit Profile'-ikkuna
<img src="images/itool_edit.JPG" alt="iTool v1" width="700">

* Edit profile ikkunassa voi muokata omat profiilitiedot

### 'Add a Tool'-ikkuna
<img src="images/itool_addtool.JPG" alt="iTool v1" width="700">

* Lisää työkalu - ikkunassa voi lisätä uusia työkaluja
* Kaikki kentät työkalun kuvaa lukuunottamatta ovat pakollisia

### Piilotettu 'Add random tools'-ikkuna
<img src="images/itool_addrandomtools.JPG" alt="iTool v1" width="300">

* Add random tools ikkuna on piilotettu ikkuna, johon pääsee käsiksi painamalla 'F1'-nappia "Add a Tool" ikkunan auki ollessa
* Tämä ikkuna oli luotu testaamista varten
* Tämä metodi generoi käyttäjän syöttämän määrän satunnaisia työkaluja kaikkien käyttäjien kesken iTool-tietokantaan

## Mukana tulevat tiedostot

* Mukana tulee [zip-pakkaus](https://student.labranet.jamk.fi/~M3156/iTool/iTool_v0.1.zip)

## Tietokanta

Tietokannan suunnittelin tietokannat opintojakson harjoitustyönä. Tietokannasta on luotu 2 versitota prosessin aikana.

### iTool tietokanta versio 1

<img src="images/iTool.JPG" alt="iTool v1" width="900">

Tässä versiossa tietokannassa oli tr_completion taulu, se taulu oli työkalun palautusta varten. Käyttäjä palauuttaa työkalun, samalla palautustapahtuma tallentuisi
tr_completion tauluun, johon kirjautuu palautus PVM, palautus kunto ja arvio kaupan toisesta osapuolesta. Transaction ja tr_completion taulujen välissä oli
yksi yhteen liitos, joten tr_completion on jätetty kokonaan pois ja transaction tauluun on lisätty palautusPVM (actualEndDate) kenttä, joka transaction käynnistyessä olisi null. 

### iTool tietokanta lopullinen versio 2

<img src="images/iTool_v3_no_captions.JPG" alt="iTool v2" width="900">

Tässä on lopullinen versio iTool tietokannasta, tr_completion taulu on jätetty pois ja tietokantaan on lisätty rating taulu arvioita varten. Rating taululle on tehty [trigger](liitteet/trigger.md),
joka pitää huolta siitä, että käyttäjä joka jättää arvion voi vain ainoastaan arvioida kyseisen transaktion toista osapuolta yhden kerran. Comment taulussa on itseensä liitos,
koska vastaukset kommenteihin vaatii parentID.<br>

[Täältä löytyy tietokannan luontiskripti](liitteet/database_script.md)

[Queryhistoriasta](liitteet/queryhistory.md) löytyy näkymien luonti, testidatan lisäys ja erilaisia hakuja. Piti luoda 2 isoa näkymää (all_tools ja rented_tools) käyttöliittymän
toiminnallisuutta varten.

## Ongelmat, jatkokehitysideat

Tämä sovellus oli vaan hiekkalaatikkoprototyyppi mahdollisesta tulevasta toimivasta sovelluksesta, siihen nähden ei ole esiintynyt hirveän isoja ongelmia.
On olemassa kuitenkin muutamaa kehitysideaa.

### Kommentit

* Kommentit ei esinny oikeassa järjestyksessä
* Täytyy käydä koodi läpi ja parantaa
* Kommentteihin täytyy pystyä päästä käsiksi myös Profiili-ikkunasta (pieni ja helppo päivitys)

### Images kansio

* Images kansio on olemassa vain paikallisesti
* Täytyy siirtää webclietille, jota se päivittyisi kaikilla käyttäjillä dynaamisesti

### Tietokantakyselyt

* Koodissa on vähän liikaa ylimääräisiä yhteydenottoja mysql palvelimelle
* Pitää muuttaa koodia, että otetaan vaan kerran per uusi ikkuna yhteyden palvelimelle
* Täytyy implementoida 'Entity Framework' tulevissa versioissa

### Samanaikainen kirjautuminen

* Täytyy implementoida sellainen toiminnallisuus, jolla sama käyttäjä ei voisi olla kirjautuneena moneella päätelaitteella samanaikaisesti

### Katselmoinnin aikana ilmestyneet bugit

* Lisättäessä uusi työkalu ilmeni ongelma samannimisen kuvatiedoston kanssa (bugi korjattu)
* Käyttäjä pystyi poistamaan oman profiilin vaikka sillä oli auki olevia transaktioita (bugi korjattu)

## Työmäärä

Olen tehnyt kaiken yksin, joten on mennyt paljon aikaa tekemiseen. Täältä löytyy karkea arvio työtunneista:

* XAML ja ulkoasu: 15h
* Code behind: 25h
* Tietokanta: 10h
* Dokumentointi: 5-10h

## Yhteenveto

* Samson Azizyan (M3156)
* Arvosanaehdotus: 5
* Perustelut: Asetin itselleni arvosanaehdotukseksi 5, koska tein tosi paljon hommaa ja siihen kului noin 60h. Saattoi olla vähän liian kunniahimoinen projekti. Lopputulokseen olen tyytyväinen, kaikki toimii niin kuin pitääkin. Ulkoasu olisi voinut olla näyttävämpi, mutta toiminnallisuus oli prioriteettina tässä projektissa. Tietokanta oli monipuolinen ja hyvin toimiva. Tämä on hyvä pohja jatkokehitystä varten.
* Mitä opin: Opin tekemään yksinkertaisia käyttöliittymiä, implementoimaan mysql-tietokantoja, opin syvemmin käsittelemään olioita ja luokkia. Tämän opintojakson aikana minun ohjelmointitaito on kolmenkertaistunut.
* Mitä pitää oppia: Käsittelemään interfaceja, käyttämään webclientia (tallentamaan sinne tiedostoja), Entity Framework
