day_html = "";
month_html = "";
year_html = "";
// day
for(var x = 1; x <= 31; x++){
  day_html += '<option value="'+x+'">'+x+'</option>'
}

//month
for(var y = 1; y <= 12; y++){
  month_html += '<option value="'+y+'">'+y+'</option>'
}

// year
var myDate = new Date();
var year = myDate.getFullYear();

for(var i = year; i > year-100; i--){
  year_html += '<option value="'+i+'">'+i+'</option>'
  year 
}

document.getElementById("bday_day").innerHTML = day_html;
document.getElementById("bday_month").innerHTML = month_html;
document.getElementById("bday_year").innerHTML = year_html;
document.getElementById("birthday").value = +year_html+'-'+month_html+'-'+day_html;


var year =  document.getElementById("bday_year").value;
var month =  document.getElementById("bday_month").value;
var day =  document.getElementById("bday_day").value;

document.getElementById("birthday").value = +year+'-'+month+'-'+day;

