

$.ajax({   
			url: 'https://ipinfo.io',
			dataType: 'json',
			success: function(data){ /*intoarce coordonatele IP-ului*/

				var loc = data.loc.split(',');  /*converteste coord din string in array*/

				/*compune URL-ul pt ajaxul OpenWeather.com*/
				var apiWeather 	= "http://api.openweathermap.org/data/2.5/weather?";
				var lat 		= "lat="+loc[0];
				var lon 		= "&lon="+loc[1];
				var appid 		= "&APPID=2cbe368ce3eb8022fd9bb199832e04a1";
				var unit 		= "&units=Metric";

				$.getJSON(apiWeather+lat+lon+unit+appid,function(json){ 

						/*afiseaza icon-ul aferent vremii*/
						switch (json.weather[0].main){
							case "Clear":
								$('div.clear').removeClass('hidden');
								break;
							case "Rain":
								$('div.rain').removeClass('hidden');
								break;
							case "Snow":
								$('div.snow').removeClass('hidden');
								break;
							case "Thunderstorm":
								$('div.thunderstorm').removeClass('hidden');
								break;	
							case "Clouds":
								$('div.clouds').removeClass('hidden');
								break;
							case "Mist":
								$('div.clouds').removeClass('hidden');
								break;
							case "Drizzle":
								$('div.sun-shower').removeClass('hidden');
								break;	
							case "Extreme":
								$('div.thunderstorm').removeClass('hidden');
								break;	
							default:
								document.body.style.background='#161616';					
						}
					/*populeaza html-ul cu valorile necesare din json-ul vremii*/
				$("#Location").html(json.name+','+json.sys.country);
				$("#Temperature").html(Math.floor(json.main.temp));
				$("#Description").html(json.weather[0].description);
				$("#Icon").attr("src", 'http://openweathermap.org/img/w/'+json.weather[0].icon+'.png');
					});
				},
			error: function(){ 
				$('#Error').text("There was an error trying to get your location")
			}
		});	


/*functia care schimba Celsius/Fahrenheit apelata de onclick*/
		function change(){
			var text = $('#units').text();
			if(text == 'C'){
				$('#units').html('F');
				tempC = document.getElementById('Temperature').innerHTML;
				var tempF = Math.floor(tempC * 9/5 +32);
				$('#Temperature').html(tempF);
			}else{
				$('#units').html('C');
				$('#Temperature').html(tempC);
			}
		}