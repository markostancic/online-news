function post()
{
  var text = document.getElementById("text").value;
  var korisnik = document.getElementById("korisnik").value;
  if(text && korisnik)
  {
    $.ajax
    ({
      type: 'post',
      url: 'comment.php',
      data: 
      {
         text:text,
	     korisnik:korisnik
      },
      success: function (response) 
      {
	    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	    document.getElementById("text").value="";
        document.getElementById("korisnik").value="";
  
      }
    });
  }
  
  return false;
}