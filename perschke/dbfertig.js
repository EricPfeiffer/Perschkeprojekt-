jQuery(function () {

    //Chaching deaktivieren
    $.ajaxSetup({
        cache: false
    });

    //intialen Inhalt laden
    jQuery('main').load('addList.php');

    //Navigation laden
    loadNavi();
	loadfooter();
});


function loadNavi() {
    jQuery('header').load('navigation.php', function () {
        //Realisierung Navigation
        jQuery('#seite1').click(function () {
            jQuery('main').load('addList.php');
            jQuery('footer').load('footer.php');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('#seite2').click(function () {
            jQuery('main').load('loginformular.html');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('#seite3').click(function () {
            jQuery('main').load('taskfilter.php');
            jQuery('footer').load('footerfilter.php');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('#seite4').click(function () {
            handleLogout();
            jQuery('main').load('addList.php');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
        });
		jQuery('#seite5').click(function () {
            jQuery('main').load('registrierung.html');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
        });
		jQuery('#seite6').click(function () {
            jQuery('main').load('diagramm.php');
           
            jQuery('footer').load('footerleer.php');
            jQuery('main').load('diagramm.php');
            jQuery('a.active').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('main').load('diagramm.php');
        });
		
		 
    });    
}
function loadfooter() {
   jQuery('footer').load('footer.php');
		 
   
}

function handleLogout() {
    jQuery.post(
        'handle_logout.php?',
        {},
        function(data){
            jQuery('main').load('addList.php');
            jQuery('footer').load('footer.php');
            loadNavi();
        },
        'html'
    );
}