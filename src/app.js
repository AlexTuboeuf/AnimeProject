var navigation = document.getElementsByClassName("navigation");
var btnNavigation = document.getElementsByClassName("btn-navigation");
var mentions = document.getElementsByClassName("mentions");
var mentionsblock = document.getElementsByClassName("mentionsblock");
var politique = document.getElementsByClassName("politique");
var politiqueblock = document.getElementsByClassName("politiqueblock");
    initElement();
    secondElement();
    thirdElement();

//Nav bar

    function initElement(){
        // Ajout d’un événement click
        btnNavigation[0].addEventListener("click", toggleNav);
    };

    function toggleNav()
    {
        // toggle de la classe isOpen sur navigation[0] (comme c’est une classe, navigation est un tableau)
        navigation[0].classList.toggle("isOpen");
    };

//Mentions légales

    function secondElement(){
        mentions[0].addEventListener("click", toggleMentions);
    };

    function toggleMentions()
    {
        mentionsblock[0].classList.toggle("Open");
    };

//Politique de confidentialité

    function thirdElement(){
        politique[0].addEventListener("click", togglePolitique);
    };

    function togglePolitique()
    {
        politiqueblock[0].classList.toggle("Open");
    };