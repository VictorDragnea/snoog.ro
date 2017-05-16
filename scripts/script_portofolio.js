// SCRIPT //




		function img_circle() {
			$('.img-circle').each(function() {
			$w = $(this).width();
			$(this).height($w);
			});
		}


		$(window).resize(function() {
			img_circle();
		});
		

	function PlaySound(soundobj) {
		    var thissound=document.getElementById(soundobj);
		    thissound.play();
	}

// Generate a  random color from an array //
		var array_culori =["#27ae60","#fb6964","#16a085","#e74c3c","#2c3e50","#bdbb99","#472e32","#73a857","#342224","#f39c12","#9b59b6","#77B1A9"];


function getQuote(){		
	$.ajax({
		  url: 'scripts/proxy.php',
		  async: true,
		  type: "GET",
		  dataType: "json",
		  success: function(result){
		  	var obj = JSON.parse(result);
		  	console.log(obj);

		  	$("#random_quote").html(obj.quoteText);
			$("#quote_author").html(obj.quoteAuthor);
			$("#tweet").attr("href", "https://twitter.com/intent/tweet?hashtags=quotes&text=" + obj.quoteText);
			$("#Quote").css("background-color", array_culori[Math.floor(Math.random()*array_culori.length)]);
		  },
		/*  error: function(xhr, ajaxOptions, thrownError) {
        //console.log(xhr);
    }*/
		});	
	}

/*validare formular (daca ajaxul este setat async=false, sectiunea aceasta nu se executa) */ 

function validareEmail()
      {
         var emailID = document.contactForm.email.value;
         atpos = emailID.indexOf("@");
         dotpos = emailID.lastIndexOf(".");
         
         if (atpos < 1 || ( dotpos - atpos < 2 )) 
         {
            alert("Please enter correct email ID")
            document.contactForm.email.focus() ;
            return false;
         }
         return( true );
      }


function validare() {

         if( document.contactForm.name.value == "" )
         {
            alert( "Please provide your name!" );
            document.contactForm.name.focus() ;
            return false;
         }
         
         if( document.contactForm.email.value == "" )
         {
            alert( "Please provide your Email!" );
            document.contactForm.email.focus() ;
            return false;
         }else {
         	validareEmail();
         }
         
         if( document.contactForm.message.value == "" ||
          document.contactForm.message.value.length > 2000 )
         {
            alert( "Please write your message (<2000 characters)" );
            document.contactForm.message.focus();
            return false;
         }
         
         return( true );
      
};

		$(document).ready(function(){
			img_circle();
			getQuote();
			$('ul li a').click(function(){
				$('li a').removeClass("active");
    			$(this).addClass("active");
			})
		});


