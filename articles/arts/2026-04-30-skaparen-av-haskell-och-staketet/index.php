<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Skaparen av Haskell</title>
    <style>
        .timeline-holder {
            margin-left: -60px;
            margin-right: -60px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap; 
            justify-content: space-around; 
            gap: 2em;
        }

        .timeline-item {
            background-color: lightgoldenrodyellow;
            border-radius: 2em;
            padding: 2em;
            width: 24vw;
        }

        .timeline-item-header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .timeline-item-content {
            display: flex;
            flex-direction: row;
        }
        .sidbild{
          style="width:30vw";
        }
    </style>
    <link rel="stylesheet" href="../../artStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Tangerine:wght@400;700&display=swap"
            rel="stylesheet">
</head>

<body>
    <?php
      include("../../header.php")
    ?>
    <div class="main2">
        <div style="display: flex; flex-direction: row;">
            <div>
                <h1>Skaparen av Haskell</h1>
                <p>
                    Länge har mänskligheten funderat, vem var det egentligen som
                    skapade Haskell? Haskell som vi alla vet, är ett funktionellt
                    monad-orienterat programmeringsspråk, som lägger stor vikt vid att
                    även det simplaste programmet ska kräva en master inom både
                    matematik, datavetenskap och filosofi. Vem som skulle kunna vara
                    diaboliskt kreativt galen nog att skapa ett sådant språk har
                    därför länge varit okänt för mänskligheten. I denna
                    forskningsartikel kommer jag reda ut detta en gång för alla.
                </p>

                <h2>Chalmers indoktrinering</h2>
                <p>
                    Medan många rimliga universitet introducerar sina ingenjörer till
                    programmering i trevliga språk som Python, Java och c/c++ har andra
                    valt en annan väg. Linköpings Universitet exempelvis indoktrinerar
                    en stor skala ingenjörer i konsten av Ada då
                    <a href="../saab-mutar-liu/">SAAB i hemlighet mutar LiU</a>
                    med miljontals dollar varje år för att de behöver
                    ingenjörer som kan läsa deras legacy kod. Men ännu mer bisarrt är
                    Chalmers val av första språk, inget mindre än Haskell. 
                    Det är alldeles uppenbart att Chalmers försöker drilla
                    göteborgsbarnen till excellenta haskllare, men frågan är bara
                    varför Chalmers är så måna om att ingenjörer ska kunna hasklla?
                    Vad är det Chalmers döljer för oss? 
                </p>
            </div>
            <img src="../../images/haskell-type-system.png" alt="Haskells typsystem." class="sidbild">
        </div>

        <h2>Transportstyrelsens inblandning</h2>
        <p>
            Efter en noggrann analys av logotyperna för Transportstyrelsens (TS)
            samt Haskells loggor är det uppenbart att dessa 2 entiteter
            är närmare besläktade än vi tidigare trott (se bilaga 67).
            Men anledningen till detta blir snabbt uppenbar när vi börjar
            granska bevisen i mer detalj.
            TS har länge jobbat för Trafikverket men har under den senaste tiden
            fått allt högre krav när det kommer till klimatmålen. Detta gjorde
            onekligen utvecklarna på myndigheten mycket oroliga, då det fram
            tills nu skrivit sina program i C# på svenska. C#, som vi alla vet,
            har ett koldioxidindex på 3,14 som inte görs bättre av att kod
            skriven på svenska har en
            multiplicitets&shy;faktors&shy;skalär&shy;invers&shy;ortogonal&shy;komponents&shy;inpliciterings&shy;fakultets&shy;konstant
            på 915. Detta har alltså gjort att varje rad kod skriven på TS har
            släppt ut totalt 11 ton koldioxid. Men ledningen på TS upptäckte då
            något kritiskt. For-loopar och abstrakta factory factory klasser
            generera höga halter metan, en väldigt potent växthusgas. Men använder
            man istället monader och functorer minskar utsläppen drastiskt då
            dessa enbart släpper ut divätemonoxid. Det är just därför som TS
            valde att skapa Haskell. Enbart för själviska syften att minska sina
            egna klimatutsläpp, utan att tänka på konsekvenserna för de stackars
            programmerarna.
        </p>

        <figure>
            <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                <img src="../../images/haskell.png" alt="Haskells logga" width="269px">
                <img src="../../images/transportstyrelsen.png" alt="Transportstyrelses logga", width="269px">
            </div>
            <figcaption>
                Bilaga 67. Corporate wants you to find the difference between these pictures.
                They're the same picture!
            </figcaption>
        </figure>
        

        <h2>Den fullständiga tidslinjen</h2>
        <div class="timeline-holder" >
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>Henry Ford</h3>
                    <h4>1903</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Henry Ford grundar bolaget Ford Motor Company för att tillverka
                        och sälja bilar.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/henry-ford.png" alt="Henry Ford." width="100px">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>Transportstyrelsen</h3>
                    <h4>1914</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Henry Ford grundar Transportstyrelsen för att öka försäljningen
                        av sina bilar. Till en början går allt bra, men efter ett tag
                        blir klimatpåverkan en alldeles för stor fråga i samhället och
                        Transportstyrelsen tvingas minska sina utsläpp.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/transportstyrelsen.png" alt="Transportstyrelsen." width="100px">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>Chalmers</h3>
                    <h4>1829</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Transportstyrelsen grundar Chalmers som en filial för att kunna
                        utveckla språket Haskell utan att någon misstänker att det
                        är TS som ligger bakom det.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/chalmers.png" alt="Chalmers." width="100px">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>KTH</h3>
                    <h4>Sommaren 1969</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Chalmers ingår ett hemligt samarbete med KTH för att tillsammans
                        regera som de 2 största universiteten i Sverige och jobba mot att
                        förgöra alla andra universitet.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/secret-alliance.png" alt="Chalmers och KTHs allians." width="100px">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>Akademiska Hus</h3>
                    <h4>1993</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Chalmers och 
                        <a href="../akademiska-hus-kth/">KTH grundar tillsammans Akademiska Hus</a>
                        i ett försök att en gång för alla förgöra alla andra universitet i Sverige.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/akademiskahus.jpg" alt="Akademiska hus." width="100px">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-item-header">
                    <h3>Staketet</h3>
                    <h4>2025</h4>
                </div>
                <div class="timeline-item-content">
                    <i>
                        Akademiska hus sätter upp ett staket på Campus Valla för att försöka
                        stoppa studenterna och förinta Linköpings Universitet.
                    </i>
                    <div style="width: 8em;"></div>
                    <img src="../../images/staketet.png" alt="Staketet." width="100px">
                </div>
            </div>
        </div>
        <p>
            Med en så tydlig tidslinje beskriven blir nu många saker tydliga. Dels kan vi fastslå
            att TS och Chalmers jobbat tätt sedan starten för att introducera Haskell som ett
            verktyg för att slutföra sina mer sluga planer. Samarbetet mellan Chalmers och KTH för
            att förgöra LiU med hjälp av ett staket är inte särskilt häpnadsväckande utan har länge
            varit välkänt inom vetenskapen. Det som är riktigt intressant här är att
            vi äntligen kan fastslå hur Henry Ford är inblandad i det hela. Som vi tydligt ser planerade
            Henry Ford att sätta upp staketet på LiU över hundra år innan det faktiskt gjordes. Han
            planerade väl och försökte dölja sina spår med båda Akademiska Hus och Haskell, men efter
            mycket letande är det ändå självklart. Det var Henry Ford som satte upp staketet.
        </p>
    </div>
<?php
  include("../../bottom.php")
?>
</body>
