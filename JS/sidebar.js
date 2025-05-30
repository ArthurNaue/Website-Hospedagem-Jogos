function openOrCloseNav() 
{
    if(document.getElementById("button").textContent=="ABRIR")
    {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.getElementById("button").textContent = "FECHAR";
    }
    else
    {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.getElementById("button").textContent = "ABRIR";
    }
}
